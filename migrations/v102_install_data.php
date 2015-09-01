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

class v102_install_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['hide_bbcode_version']) && version_compare($this->config['hide_bbcode_version'], '1.0.2', '>=');
	}

	static public function depends_on()
	{
		return array('\marcovo\hideBBcode\migrations\v101_install_data');
	}

	public function update_data()
	{
		return array(
			array('config.update', array('hide_bbcode_version', '1.0.2')),
			array('config.add', array('hidebbcode_unhide_reply', true)),
			array('config.add', array('hidebbcode_unhide_tfp', false)),
			array('config.add', array('hidebbcode_hide_attach', true)),

			// Add ACP module
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_HIDEBBCODE_CAT'
			)),
			array('module.add', array(
				'acp',
				'ACP_HIDEBBCODE_CAT',
				array(
					'module_basename'	=> '\marcovo\hideBBcode\acp\acp_hidebbcode_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}

}
