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

class v100_install_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['hide_bbcode_version']) && version_compare($this->config['hide_bbcode_version'], '1.0.0', '>=');
	}

	static public function depends_on()
	{
		return array('\marcovo\hideBBcode\migrations\install_data');
	}

	public function update_data()
	{
		return array(
			array('config.update', array('hide_bbcode_version', '1.0.0')),
		);
	}

}
