<?php
/**
*
* Hide_BBcode
*
* @copyright (c) 2015 Marco van Oort
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace marcovo\hideBBcode\migrations;

class install_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['hide_bbcode_version']) && version_compare($this->config['hide_bbcode_version'], '0.4.0', '>=');
	}

	static public function depends_on()
	{
		return array();
	}

	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'install_bbcodes'))),

			array('config.add', array('hide_bbcode_version', '0.4.0')),
		);
	}

	public function install_bbcodes()
	{
		$bbcode_data = array(
			'hidden' => array(
				'bbcode_helpline'	=> 'ABBC3_HIDDEN_HELPLINE',
				'bbcode_match'		=> '[hide]{TEXT}[/hide]',
				'bbcode_tpl'		=> '<!-- HIDE_BBCODE -->{TEXT}<!-- /HIDE_BBCODE -->',
			),
		);

		global $db, $request, $user;
		$acp_manager = new \marcovo\hideBBcode\includes\acp_manager($db, $request, $user, $this->phpbb_root_path, $this->php_ext);
		$acp_manager->install_bbcodes($bbcode_data);
	}
}
