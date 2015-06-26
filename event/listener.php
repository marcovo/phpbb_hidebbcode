<?php
/** 
*
* @package Hide_BBcode
* @copyright (c) 2015 Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

namespace marcovo\hide_bbcode\event;

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
	
	protected $b_hide = true;

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
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'	=> 'load_language_on_setup',

			'core.modify_text_for_display_after'	=> 'parse_bbcodes_after',
			'core.modify_format_display_text_after'	=> 'parse_bbcodes_topicPreview',

			'core.modify_posting_parameters'				=> 'check_user_posted_posting',
			'core.viewtopic_assign_template_vars_before'	=> 'check_user_posted_viewtopic',
			'core.ucp_pm_compose_quotepost_query_after'	=> 'check_user_posted_pm',
			
			'core.parse_attachments_modify_template_data'	=> 'check_attachment',

			'test.topic_review_modify_template_vars'	=> 'topic_review_modify_template_vars',
			'core.posting_modify_template_vars'	=> 'posting_modify_template_vars',

			'core.viewtopic_modify_post_row'	=> 'viewtopic_modify_post_row',
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
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'marcovo/hide_bbcode',
			'lang_set' => 'hide_bbcode',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	public function topic_review_modify_template_vars($event)
	{
		if ($this->b_hide)
		{
			$event['decoded_message'] = preg_replace("#\[hide\].*?\[/hide\]#is", '{{'.$this->user->lang('HIDEBB_HIDDEN_MESSAGE')."}}\n", $event['decoded_message']);
		}

	}
	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	public function posting_modify_template_vars($event)
	{
		if ($this->b_hide && in_array($event['mode'], array('reply', 'quote')) && !$event['preview'] && $event['draft_id'] == 0)
		{
			$page_data = $event['page_data'];
			$page_data['MESSAGE'] = preg_replace("#\[hide\].*?\[/hide\]#is", '{{'.$this->user->lang('HIDEBB_HIDDEN_MESSAGE')."}}\n", $page_data['MESSAGE']);
			$event['page_data'] = $page_data;
		}

	}

	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	public function check_user_posted_viewtopic($event)
	{
		$topic_id = $event['topic_id'];
		
		$this->check_user_posted_by_topicId($topic_id);
	}

	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	public function check_user_posted_posting($event)
	{
		if($event['mode'] == 'post') {
			// When just posting a new topic, there should be no risk, so we hide nothing.
			// This is needed when one submits a form which produces an error.
			// In this case, we need to prevent the [hide]-text from being hidden, which is done here.
			$this->b_hide = false;
			return;
		}
		
		if($event['post_id'] != 0) {
			$this->check_user_posted_by_postId($event['post_id']);
		}
		else if($event['topic_id'] != 0) {
			$this->check_user_posted_by_topicId($event['topic_id']);
		}
	}

	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	public function check_user_posted_pm($event)
	{
		$post_id = $event['msg_id'];

		$this->check_user_posted_by_postId($post_id);
		
		$post = $event['post'];
		$bbcode_uid = $post['bbcode_uid'];
		if($this->b_hide)
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
	* Alter BBCodes after they are processed by phpBB
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
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	private function check_user_posted_by_topicId($topic_id)
	{
		$b_hide = true;
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
			$b_hide = false;
		}
		else if ($this->user->data['user_id'] != ANONYMOUS)
		{
			// Check if the topic viewer has posted in the topic
			$sql = "SELECT poster_id, topic_id 
				FROM " . POSTS_TABLE . "
				WHERE topic_id = $topic_id 
				AND poster_id = " . $this->user->data['user_id']; 

			$result = $this->db->sql_query($sql);
			$b_hide = $this->db->sql_affectedrows($result) ? false : true;
			$this->db->sql_freeresult($result);
		}
		
		$this->b_hide = $b_hide;
	}

	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	public function check_attachment($event)
	{
		if($this->b_hide && $event['forum_id'] !== false)
		{
			$event['attachment'] = array();
			$event['block_array'] = array();
			$event['download_link'] = '';
		}
	}

	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	public function viewtopic_modify_post_row($event)
	{
		if($this->b_hide && $event['row']['post_attachment'])
		{
			$post_row = $event['post_row'];
			$post_row['S_DISPLAY_NOTICE'] = true;
			$event['post_row'] = $post_row;
		}
	}

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
		$this->template->set_style(array('styles', 'ext/marcovo/hide_bbcode/styles'));

		$bbcode = new \bbcode();
		$bbcode->template_filename = $this->template->get_source_file_for_handle('hide_bbcode.html');

		
		if ($this->b_hide == false)
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
		$this->template->set_style(array('styles', 'ext/marcovo/hide_bbcode/styles'));

		$bbcode = new \bbcode();
		$bbcode->template_filename = $this->template->get_source_file_for_handle('hide_bbcode.html');

		
		return $bbcode->bbcode_tpl('unhide_open') . $matches[1] . $bbcode->bbcode_tpl('unhide_close');

	}

}
