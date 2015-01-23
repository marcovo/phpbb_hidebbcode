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

			'core.modify_posting_parameters'				=> 'check_user_posted_posting',
			'core.viewtopic_assign_template_vars_before'	=> 'check_user_posted_viewtopic',
			'core.ucp_pm_compose_quotepost_query_after'	=> 'check_user_posted_pm',
			
			'core.viewtopic_modify_post_row'	=> 'check_attachment',

			'test.decode_message_after'	=> 'decode_message_after',
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
	public function decode_message_after($event)
	{
		if ($this->b_hide)
		{
			$event['message'] = preg_replace("#\[hide\].*?\[/hide\]#is", '{{'.$this->user->lang('HIDDEN_MESSAGE').'}}', $event['message']);
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
		$post_id = $event['post_id'];

		$this->check_user_posted_by_postId($post_id);
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
		
		// The [hide]-tags aren't useful in pm's, so remove them if present
		$post = $event['post'];
		$post['message_text'] = str_replace(array('[hide]', '[/hide]'), '', $post['message_text']);
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

		// Check if the topic viewer has posted in a topic
		$b_hide = true; 
		if ($this->user->data['user_id'] != ANONYMOUS)
		{
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
		$post_row = $event['post_row'];
		$attachments = $event['attachments'];
		$row = $event['row'];

		$post_row['S_HAS_ATTACHMENTS'] = ($post_row['S_HAS_ATTACHMENTS'] && $this->b_hide == false) ? true : false;

		$event['post_row'] = $post_row;
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

}
