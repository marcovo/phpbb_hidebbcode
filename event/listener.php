<?php
/** 
*
* @package MathJax
* @copyright (c) 2014 Sérgio Faria and Marco van Oort
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
	
	protected $b_hide = true;

	/**
	* Constructor
	*
	* @param \phpbb\db\driver\driver $db Database object
	* @param \phpbb\controller\helper    $helper        Controller helper object
	*/
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\user $user, \phpbb\template\template $template, \phpbb\config\config $config)
	{
		$this->db = $db;
		$this->user = $user;
		$this->template = $template;
		$this->config = $config;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.modify_text_for_display_after'	=> 'parse_bbcodes_after',

			'core.modify_posting_parameters'				=> 'check_user_posted_topic',
			'core.viewtopic_assign_template_vars_before'	=> 'check_user_posted_topic',
			'core.ucp_pm_compose_quotepost_query_after'	=> 'check_user_posted_post',
			
			'core.viewtopic_modify_post_row'	=> 'check_attachment',

			'test.decode_message_after'	=> 'decode_message_after',
		);
	}

	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	public function decode_message_after($event)
	{
		$message = $event['message'];

		if ($this->b_hide == false)
		{
			$message = preg_replace("#\[hide\](.*?)\[/hide\]#ise", "'\\1'", $message);
		}
		else
		{
			$message = preg_replace("#\[hide\].*?\[/hide\]#ise", $this->user->lang['HIDDEN_MESSAGE'], $message);
		}

		$event['message'] = $message;
	}

	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* @param object $event The event object
	*/
	public function check_user_posted_topic($event)
	{
		$topic_id = $event['topic_id'];

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
	public function check_user_posted_post($event)
	{
		$post_id = $event['msg_id'];
		$a_post = $event['post'];

		$sql = "SELECT topic_id 
			FROM " . POSTS_TABLE . "
			WHERE post_id = ".$post_id.""; 

		$result = $this->db->sql_query($sql);
		$topic_id = $db->sql_fetchrow($result);
		$topic_id = $topic_id['topic_id'];
		$this->db->sql_freeresult($result);

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
		$text = $event['text'];

		$text = preg_replace_callback('#<!-- HIDE_BBCODE -->(.*?)<!-- /HIDE_BBCODE -->#s', array($this, 'hidden_pass'), $text);

		$event['text'] = $text;
	}
	
	
	/**
	* Convert Hidden BBCode into its final appearance
	*
	* @param array $matches
	* @return string HTML render of hidden bbcode
	*/
	protected function hidden_pass($matches)
	{
		if ($this->b_hide)
		{
			$replacements = array(
				$this->user->lang('ABBC3_HIDDEN_ON'),
				$this->user->lang('ABBC3_HIDDEN_EXPLAIN'),
				'hidebox_hidden',
			);
		}
		else
		{
			$replacements = array(
				$this->user->lang('ABBC3_HIDDEN_OFF'),
				$matches[1],
				'hidebox_visible',
			);
		}
		return str_replace(
			array('{HIDDEN_TITLE}', '{HIDDEN_CONTENT}', '{HIDDEN_CLASS}'),
			$replacements,
			'<div class="hidebox {HIDDEN_CLASS}"><div class="hidebox_title {HIDDEN_CLASS}">{HIDDEN_TITLE}</div><div class="{HIDDEN_CLASS}">{HIDDEN_CONTENT}</div></div>'
		);
	}

}