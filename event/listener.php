<?php
/** 
*
* @package Hide_BBcode
* @copyright (c) 2015 Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

namespace marcovo\hideBBcode\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	protected $db;
	protected $user;
	protected $template;
	protected $config;
	protected $helper;
	
	protected $b_forceUnhide = false;
	private $a_TFP_topic_posts_thanked = array();
	private $b_topic_replied = false;
	
	private $hbuid; // Hide Bbcode UID (Unique Identification Digit)

	/**
	* Constructor
	*
	* @param \phpbb\db\driver\driver $db Database object
	* @param \phpbb\controller\helper    $helper        Controller helper object
	*/
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\user $user, \phpbb\template\template $template, \phpbb\config\config $config, \phpbb\controller\helper $helper)
	{
		$this->db = $db;
		$this->user = $user;
		$this->template = $template;
		$this->config = $config;
		$this->helper = $helper;
		
		$this->hbuid = substr(md5(mt_rand()), 0, 10);
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'		=> 'load_language_on_setup',

			'core.modify_posting_parameters'				=> 'check_user_posted_posting',
			'core.viewtopic_assign_template_vars_before'	=> 'check_user_posted_viewtopic',
			'core.ucp_pm_compose_quotepost_query_after'		=> 'check_user_posted_pm',

			'core.viewtopic_post_rowset_data'		=> 'viewtopic_post_rowset_data',

			'core.topic_review_modify_row'			=> 'topic_review_modify_row',
			'core.posting_modify_template_vars'		=> 'posting_modify_template_vars',

			'core.modify_text_for_display_after'	=> 'parse_bbcodes_after',
			'core.modify_format_display_text_after'	=> 'parse_bbcodes_topicPreview',

			'core.viewtopic_modify_post_row'		=> 'viewtopic_modify_post_row',
			
			'gfksx.thanksforposts.delete_thanks_before'	=> 'TFP_delete_thanks_before',

			'core.search_modify_rowset'		=> 'search_modify_rowset',
		);
	}

	/**
	* Load common files during user setup
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function load_language_on_setup($event)
	{

		$this->user->add_lang_ext('marcovo/hideBBcode', 'hide_bbcode');
		
		$s_helpline = '';
		$s_hidden_desc = '';
		$s_hidden_attach = $this->user->lang['HIDEBB_MESSAGE_HIDDEN_ATTACH'];
		

		if($this->config['hidebbcode_unhide_reply'] && $this->config['hidebbcode_unhide_tfp'])
		{
			$s_helpline			 = $this->user->lang['HIDEBB_HIDE_HELPLINE_REPLY_THANK'];
			$s_hidden_desc		 = $this->user->lang['HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY_THANK'];
			$s_hidden_attach	.= ' '.$this->user->lang['HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY_THANK'];
		}
		
		else if($this->config['hidebbcode_unhide_reply'])
		{
			$s_helpline			 = $this->user->lang['HIDEBB_HIDE_HELPLINE_REPLY'];
			$s_hidden_desc		 = $this->user->lang['HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY'];
			$s_hidden_attach	.= ' '.$this->user->lang['HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY'];
		}
		
		else if($this->config['hidebbcode_unhide_tfp'])
		{
			$s_helpline			 = $this->user->lang['HIDEBB_HIDE_HELPLINE_THANK'];
			$s_hidden_desc		 = $this->user->lang['HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_THANK'];
			$s_hidden_attach	.= ' '.$this->user->lang['HIDEBB_MESSAGE_HIDDEN_ATTACH_THANK'];
		}
		
		$this->user->lang['HIDEBB_HIDE_HELPLINE'] = $s_helpline;
		$this->user->lang['HIDEBB_MESSAGE_HIDDEN_DESCRIPTION'] = $s_hidden_desc;
		$this->user->lang['HIDEBB_MESSAGE_HIDDEN_ATTACH'] = $s_hidden_attach;
		
	}

	################################################################################
	#			Functions for checking topics for replies, and posts for thanks
	################################################################################

	/**
	* Check whether texts need to be hidden for the topic
	*
	* @param object $event The event object
	*/
	public function check_user_posted_viewtopic($event)
	{
		$topic_id = $event['topic_id'];
		
		$this->check_user_posted_by_topicId($topic_id);
		$this->check_posts_thanked_by_topicId($topic_id);
	}

	/**
	* Check whether texts need to be hidden for the post/topic
	*
	* @param object $event The event object
	*/
	public function check_user_posted_posting($event)
	{
		if($event['mode'] == 'post') {
			// When just posting a new topic, there should be no risk, so we hide nothing.
			// This is needed when one submits a form which produces an error.
			// In this case, we need to prevent the [hide]-text from being hidden, which is done here.
			$this->b_forceUnhide = true;
			return;
		}
		
		if($event['post_id'] != 0) {
			$this->check_user_posted_by_postId($event['post_id']);
			$this->check_posts_thanked_by_postId($event['post_id']);
		}
		else if($event['topic_id'] != 0) {
			$this->check_user_posted_by_topicId($event['topic_id']);
			$this->check_posts_thanked_by_topicId($event['topic_id']);
		}
	}

	/**
	* Check whether the user has posted in the topic where $post_id is posted in
	*
	* @param object $event The event object
	*/
	private function check_user_posted_by_postId($post_id)
	{
		$sql = "SELECT topic_id 
			FROM " . POSTS_TABLE . "
			WHERE post_id = ".$post_id.""; 

		$result = $this->db->sql_query($sql);
		$topic_id = $this->db->sql_fetchrow($result);
		$topic_id = $topic_id['topic_id'];
		$this->db->sql_freeresult($result);
		
		$this->check_user_posted_by_topicId($topic_id);
	}

	/**
	* Check whether the user has posted in a topic
	*
	* @param int $topic_id The topic id
	*/
	private function check_user_posted_by_topicId($topic_id)
	{
		global $auth;
		
		$sql = "SELECT forum_id 
				FROM " . TOPICS_TABLE . "
				WHERE topic_id = ".$topic_id." "; 
		$result = $this->db->sql_query($sql);
		$forum_id = $this->db->sql_fetchrow($result);
		$forum_id = $forum_id['forum_id'];
		$this->db->sql_freeresult($result);
		
		if ($auth->acl_get('m_', $forum_id))
		{
			// If moderator or admin, skip reply check, auto unhide
			$this->b_forceUnhide = true;
		}
		else if ($this->user->data['user_id'] != ANONYMOUS)
		{
			// Check if the topic viewer has posted in the topic
			$sql = "SELECT poster_id, topic_id 
				FROM " . POSTS_TABLE . "
				WHERE topic_id = $topic_id 
				AND poster_id = " . $this->user->data['user_id']; 

			$result = $this->db->sql_query($sql);
			$this->b_topic_replied = $this->db->sql_affectedrows($result) ? true : false;
			$this->db->sql_freeresult($result);
		}

		$this->template->assign_var('S_HIDE_REFRESH_ON_QR', $this->config['hidebbcode_unhide_reply'] && !$this->b_topic_replied && !$this->b_forceUnhide);
	}

	/**
	* Check whether the user has posted in topics
	*
	* @param array(int) $topic_ids The topic ids
	*/
	private function check_user_posted_by_topicIds($topic_ids)
	{
		global $auth;
		
		$a_topic_replied = array();
		foreach($topic_ids as $topic_id)
		{
			$a_topic_replied[$topic_id] = false;
		}
		
		// Check if the topic viewer has posted in the topic
		$sql = "SELECT poster_id, topic_id 
			FROM " . POSTS_TABLE . "
			WHERE " . $this->db->sql_in_set('topic_id', $topic_ids) . " 
			AND poster_id = " . $this->user->data['user_id']; 
		$result = $this->db->sql_query($sql);
		while($row = $this->db->sql_fetchrow($result))
		{
			$a_topic_replied[$row['topic_id']] = true;
		}
		$this->db->sql_freeresult($result);
		
		// Obtain topic_id -> forum_id relations
		$forum_ids = array();
		$sql = "SELECT topic_id, forum_id 
				FROM " . TOPICS_TABLE . "
				WHERE " . $this->db->sql_in_set('topic_id', $topic_ids) . " ";
		$result = $this->db->sql_query($sql);
		while($row = $this->db->sql_fetchrow($result))
		{
			$forum_ids[$row['topic_id']] = $row['forum_id'];
		}
		$this->db->sql_freeresult($result);
		
		// Check moderator privileges
		foreach($topic_ids as $topic_id)
		{
			if ($auth->acl_get('m_', $forum_ids[$topic_id]))
			{
				// If moderator or admin, skip reply check, auto unhide
				$a_topic_replied[$topic_id] = true;
			}
		}
		
		return $a_topic_replied;
	}


	/**
	* TFP: Retrieve which posts in the given topic are thanked by current user
	*
	* @param int $topic_id The topic id (or array of topic ids)
	*/
	private function check_posts_thanked_by_topicId($topic_id)
	{
		$this->check_posts_thanked_by('topic_id', $topic_id);
	}

	/**
	* TFP: Retrieve whether a post is thanked by current user
	*
	* @param int $post_id The post id (or array of post ids)
	*/
	private function check_posts_thanked_by_postId($post_id)
	{
		$this->check_posts_thanked_by('post_id', $post_id);
	}

	/**
	* TFP: Retrieve which posts are thanked by current user
	*
	* @param string $s_field Either 'post_id' or 'topic_id'
	* @param int $i_value The post id or topic id (or array of those)
	*/
	private function check_posts_thanked_by($s_field, $i_value)
	{
		
		if($this->user->data['user_id'] != ANONYMOUS && $this->config['hidebbcode_unhide_tfp'])
		{
			if(!is_array($i_value)) $i_value = array($i_value);
			
			$thanks_table = str_replace('config', '', CONFIG_TABLE).'thanks';
			
			$sql = "SELECT post_id 
				FROM " . $thanks_table . "
				WHERE " . $this->db->sql_in_set($s_field, $i_value) . " AND user_id = ".$this->user->data['user_id']." "; 
			$result = $this->db->sql_query($sql);
			while($row = $this->db->sql_fetchrow($result))
			{
				$this->a_TFP_topic_posts_thanked[] = $row['post_id'];
			}
			$this->db->sql_freeresult($result);
		}
	}

	
	#################################################################
	#			Mark some posts to unhide the hide-codes
	#################################################################
	
	/**
	* Unhide some codes on the search page
	*
	* @param object $event The event object
	*/
	public function search_modify_rowset($event)
	{
		$a_postIds = array();
		$a_topicIds = array();
		
		$rowset = $event['rowset'];
		foreach($rowset as $row)
		{
			$a_postIds[$row['post_id']] = 1;
			$a_topicIds[$row['topic_id']] = 1;
		}
		
		$a_postIds = array_keys($a_postIds);
		$a_topicIds = array_keys($a_topicIds);
		
		$a_topic_replied = $this->check_user_posted_by_topicIds($a_topicIds);
		$this->check_posts_thanked_by_postId($a_postIds);
		
		foreach($rowset as $key => $row)
		{
			$post_id = $row['post_id'];
			$topic_id = $row['topic_id'];
			
			if(in_array($post_id, $this->a_TFP_topic_posts_thanked) || $a_topic_replied[$topic_id] === true)
			{
				$uid = $row['bbcode_uid'];
				
				$rowset[$key]['post_text'] = str_replace('[hide:'.$uid.']', '[hide:'.$uid.']'.'{unhide:'.$this->hbuid.'}', $row['post_text']);
			}
		}
		$event['rowset'] = $rowset;
	}

	/**
	* TFP: See whether we should unhide some text because of thanks
	*
	* @param object $event The event object
	*/
	public function viewtopic_post_rowset_data($event)
	{
		if($this->user->data['user_id'] != ANONYMOUS && $this->config['hidebbcode_unhide_tfp'])
		{
			$rowset_data = $event['rowset_data'];
			$post_id = $rowset_data['post_id'];
			
			if(in_array($post_id, $this->a_TFP_topic_posts_thanked))
			{
				$uid = $rowset_data['bbcode_uid'];
				
				$rowset_data['post_text'] = str_replace('[hide:'.$uid.']', '[hide:'.$uid.']'.'{unhide:'.$this->hbuid.'}', $rowset_data['post_text']);
				
				$event['rowset_data'] = $rowset_data;
			}
		}
	}

	#################################################################
	#			Functions for hiding text in textareas
	#################################################################


	/**
	* Hide the hidden texts in the textarea on pm page, if quoting from a topic post
	*
	* @param object $event The event object
	*/
	public function check_user_posted_pm($event)
	{
		$post_id = $event['msg_id'];

		$this->check_user_posted_by_postId($post_id);
		$this->check_posts_thanked_by_postId($post_id);
		
		$post = $event['post'];
		$bbcode_uid = $post['bbcode_uid'];
		if(!$this->unhide_in_post($post_id))
		{
			$post['message_text'] = preg_replace('#\[hide:'.$bbcode_uid.'\].*?\[/hide:'.$bbcode_uid.'\]#is', '{{'.$this->user->lang('HIDEBB_HIDDEN_MESSAGE')."}}\n", $post['message_text']);
		}
		else
		{
			// The [hide]-tags aren't useful in pm's, so replace them if present
			$post['message_text'] = str_replace(array('[hide:'.$bbcode_uid.']', '[/hide:'.$bbcode_uid.']'), array('{hide}', '{/hide}'), $post['message_text']);
		}
		$event['post'] = $post;
	}

	/**
	* Hide the hidden texts when clicking on the 'quote'-button in the post listing on posting.php
	*
	* @param object $event The event object
	*/
	public function topic_review_modify_row($event)
	{
		if (!$this->unhide_in_post($event['row']['post_id']))
		{
			$post_row = $event['post_row'];
			$post_row['DECODED_MESSAGE'] = preg_replace("#\[hide\].*?\[/hide\]#is", '{{'.$this->user->lang('HIDEBB_HIDDEN_MESSAGE')."}}\n", $post_row['DECODED_MESSAGE']);
			$event['post_row'] = $post_row;
		}

	}

	/**
	* Hide the hidden texts in the textarea on posting.php
	*
	* @param object $event The event object
	*/
	public function posting_modify_template_vars($event)
	{
		if(isset($event['draft_id'])) // >= phpBB 3.1.6 ?
		{
			$draft_id = $event['draft_id'];
		}
		else // <= phpBB 3.1.5. Code taken from posting.php. This does not include edits on $draft_id from other extensions!
		{
			global $auth, $request;
			$draft_id	= $request->variable('d', 0);
			$mode = $event['mode'];
			
			// Load requested Draft
			if ($draft_id && ($mode == 'reply' || $mode == 'quote' || $mode == 'post') && $this->user->data['is_registered'] && $auth->acl_get('u_savedrafts'))
			{
				$sql = 'SELECT draft_subject, draft_message
					FROM ' . DRAFTS_TABLE . "
					WHERE draft_id = $draft_id
						AND user_id = " . $this->user->data['user_id'];
				$result = $this->db->sql_query_limit($sql, 1);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				if(!$row)
				{
					$draft_id = 0;
				}
			}
		}
		
		if (!$this->unhide_in_post($event['post_id']) && in_array($event['mode'], array('reply', 'quote')) && !$event['preview'] && $draft_id == 0)
		{
			$page_data = $event['page_data'];
			$page_data['MESSAGE'] = preg_replace("#\[hide\].*?\[/hide\]#is", '{{'.$this->user->lang('HIDEBB_HIDDEN_MESSAGE')."}}\n", $page_data['MESSAGE']);
			$event['page_data'] = $page_data;
		}

	}


	#################################################################
	#			Functions for hiding text in display
	#################################################################


	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	public function parse_bbcodes_after($event)
	{

		$event['text'] = preg_replace_callback('#<!-- HIDE_BBCODE -->(.*?)<!-- /HIDE_BBCODE -->#s', array($this, 'hidden_pass'), $event['text']);

	}

	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	public function parse_bbcodes_topicPreview($event)
	{

		$event['text'] = preg_replace_callback('#<!-- HIDE_BBCODE -->(.*?)<!-- /HIDE_BBCODE -->#s', array($this, 'hidden_pass_topicPreview'), $event['text']);

	}
	
	
	/**
	* Convert Hidden BBCode into its final appearance
	*
	* @param array $matches
	* @return string HTML render of hidden bbcode
	*/
	protected function hidden_pass($matches)
	{
		$this->template->set_style(array('styles', 'ext/marcovo/hideBBcode/styles'));

		$bbcode = new \bbcode();
		$bbcode->template_filename = $this->template->get_source_file_for_handle('hide_bbcode.html');

		if (strpos($matches[1], '{unhide:'.$this->hbuid.'}') === 0)
		{
			return $bbcode->bbcode_tpl('unhide_open') . str_replace('{unhide:'.$this->hbuid.'}', '', $matches[1]) . $bbcode->bbcode_tpl('unhide_close');
		}
		else if (($this->config['hidebbcode_unhide_reply'] && $this->b_topic_replied) || $this->b_forceUnhide)
		{
			return $bbcode->bbcode_tpl('unhide_open') . $matches[1] . $bbcode->bbcode_tpl('unhide_close');
		}
		else
		{
			return $bbcode->bbcode_tpl('hide');
		}

	}
	
	/**
	* Convert Hidden BBCode into its final appearance
	*
	* @param array $matches
	* @return string HTML render of hidden bbcode
	*/
	protected function hidden_pass_topicPreview($matches)
	{
		$this->template->set_style(array('styles', 'ext/marcovo/hideBBcode/styles'));

		$bbcode = new \bbcode();
		$bbcode->template_filename = $this->template->get_source_file_for_handle('hide_bbcode.html');

		
		return $bbcode->bbcode_tpl('unhide_open') . $matches[1] . $bbcode->bbcode_tpl('unhide_close');

	}
	
	#################################################################
	#			Functions for hiding attachments
	#################################################################

	/**
	* Display a notification if we are hiding attachments
	*
	* @param object $event The event object
	*/
	public function viewtopic_modify_post_row($event)
	{
		if($this->config['hidebbcode_hide_attach'] && !$this->unhide_in_post($event['row']['post_id']) && 
			$event['row']['post_attachment'] && strpos($event['row']['post_text'], '[hide:') !== false)
		{
			$attachments = $event['attachments'];

			if(count($attachments[$event['row']['post_id']]) > 0)
			{
				$post_row = $event['post_row'];
				$post_row['S_HAS_ATTACHMENTS'] = false;
				$post_row['S_HIDEBBCODE_HIDDEN_ATTACH'] = true;
				$event['post_row'] = $post_row;
			}
			
			$attachments[$event['row']['post_id']] = array();
			$event['attachments'] = $attachments;
		}
	}

	
	#################################################################
	#			Other...
	#################################################################

	/**
	* TFP: Make sure posts are not un-thanked when there is a [hide] code present
	*
	* @param object $event The event object
	*/
	public function TFP_delete_thanks_before($event)
	{
		if(!$this->config['hidebbcode_unhide_tfp'])
		{
			return;
		}
		
		$post_id = $event['post_id'];
		$forum_id = $event['forum_id'];

		$sql = "SELECT post_text 
			FROM " . POSTS_TABLE . "
			WHERE post_id = ".$post_id.""; 

		$result = $this->db->sql_query($sql);
		$post_row = $this->db->sql_fetchrow($result);
		$post_text = $post_row['post_text'];
		$this->db->sql_freeresult($result);
		
		if(strpos($post_text, '[hide:') !== false)
		{
			global $phpbb_root_path, $phpEx;
			trigger_error($this->user->lang['HIDEBB_TFP_NO_DELETE'] . '<br /><br />' . $this->user->lang('RETURN_POST', '<a href="' . append_sid($phpbb_root_path."viewtopic.".$phpEx, "f=$forum_id&amp;p=$post_id#p$post_id") . '">', '</a>'));
		}
		
	}

	/**
	* Shorthand function to check whether to show or hide the hide-codes in a post
	*
	* @param int $post_id The post id
	*/
	private function unhide_in_post($post_id)
	{
		return	($this->config['hidebbcode_unhide_reply'] && $this->b_topic_replied) ||
				($this->config['hidebbcode_unhide_tfp'] && in_array($post_id, $this->a_TFP_topic_posts_thanked) ) || 
				$this->b_forceUnhide;
	}

}
