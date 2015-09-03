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

class v101_install_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['hide_bbcode_version']) && version_compare($this->config['hide_bbcode_version'], '1.0.1', '>=');
	}

	static public function depends_on()
	{
		return array('\marcovo\hideBBcode\migrations\v100_install_data');
	}

	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'update_bbcode'))),
			array('config.update', array('hide_bbcode_version', '1.0.1')),
		);
	}

	public function update_bbcode()
	{
		global $db;
		
		// Wrong title had slipped in by copy/paste...
		$sql = "UPDATE ".BBCODES_TABLE."
			SET bbcode_helpline = 'HIDEBB_HIDE_HELPLINE', bbcode_tag = 'hide'
			WHERE bbcode_match = '[hide]{TEXT}[/hide]' AND (bbcode_helpline = 'ABBC3_HIDDEN_HELPLINE' OR bbcode_tag = 'hidden')";
		$db->sql_query($sql);
		
	}

}
