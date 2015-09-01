<?php
/** 
*
* @package Hide_BBcode
* @copyright (c) 2015 Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

namespace marcovo\hideBBcode\acp;

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * @ignore
 */

/**
* @package acp
*/
class acp_hidebbcode_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $request, $phpbb_log;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		// Set up general vars
		$action	= $request->variable('action', '');
        $submit = isset($_POST['submit']) ? true : false;
		
		$this->tpl_name = 'acp_hidebbcode';
		
		$form_key = 'acp_hidebbcode';
		add_form_key($form_key);

		switch ($mode) {
			case 'settings':
				$display_vars = array(
					'title'	=> 'HIDEBB_SETTINGS',
					'vars'	=> array(
						'legend1'					=> 'GENERAL_SETTINGS',
						'hidebbcode_unhide_reply'	=> array('lang' => 'HIDEBB_REPLY_ENABLE',	'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true),
						'hidebbcode_unhide_tfp'		=> array('lang' => 'HIDEBB_TFP_ENABLE',		'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true),
						'hidebbcode_hide_attach'	=> array('lang' => 'HIDEBB_HIDE_ATTACH',		'validate' => 'bool',	'type' => 'radio:enabled_disabled',	'explain' => true),
						
						'legend2'					=> 'ACP_SUBMIT_CHANGES',
					),
				);
			break;

			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}

		if (isset($display_vars['lang']))
		{
			$user->add_lang($display_vars['lang']);
		}
		
		$this->new_config = $config;
		
		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc($request->variable('config', array('' => ''), true)) : $this->new_config;
		$error = array();

		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);

		// Lets check if the path entered isn't valid and if we're gonna complain
		if ($submit && $mode == 'settings')
		{
			// Checks
		}
		
		if ($submit && !check_form_key($form_key))
		{
			$error[] = $user->lang['FORM_INVALID'];
		}
		
		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}
		
		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}
			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

			if ($submit)
			{
				$config->set($config_name, $config_value);
			}
		}
		
		if (sizeof($error))
		{
			$submit = false;
		}

		if ($submit)
		{
			$phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'LOG_CONFIG_HIDEBBCODE');
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}

		$this->page_title = $display_vars['title'];
		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang[$display_vars['title']],
			'L_TITLE_EXPLAIN'	=> $user->lang[$display_vars['title'] . '_EXPLAIN'],

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),
		));
		
		$template->assign_var('U_ACTION', $this->u_action);
		
		// Output relevant page set in $display_vars
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars
				));

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}

			$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);

			if (empty($content))
			{
				continue;
			}

			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> $content,
				)
			);

			unset($display_vars['vars'][$config_key]);
		}
	}

}
