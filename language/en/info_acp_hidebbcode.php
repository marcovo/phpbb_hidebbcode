<?php
/** 
*
* simple_hide_bbcode [English]
*
* @package language
* @copyright (c) 2015 Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

/**
* NOTE: Most of the language items are used in javascript
* If you want to use quotes or other chars that need escaped, be sure you escape them double 
* (Especially for ', you must use \\\' instead of \'. For " you only need to use \".
*/
/**
 * @TODO:Change this to uppercase things.
 */ 
$lang = array_merge($lang, array(
	'ACP_HIDEBBCODE_CAT'			=>	'[hide] BBCode',
	'ACP_HIDEBBCODE_SETTINGS'		=>	'General settings',

	'HIDEBB_SETTINGS'				=>	'[hide] BBCode general settings',
	'HIDEBB_SETTINGS_EXPLAIN'		=>	'Here you can configure how the [hide] BBCode behaves.',

	'HIDEBB_REPLY_ENABLE'			=>	'The [hide] code is unhidden when a user has replied in the topic',
	'HIDEBB_REPLY_ENABLE_EXPLAIN'	=>	'This allows users to view the contents of the [hide] BBCode by posting a reply in the topic.',
	'HIDEBB_TFP_ENABLE'				=>	'The [hide] code is unhidden when a user thanks the post',
	'HIDEBB_TFP_ENABLE_EXPLAIN'		=>	'This allows users to view the contents of the [hide] BBCode by thanking a user. If a user has thanked a post that contains a [hide] BBCode, the user may not delete this thank any more.<br />This option only has effect if the ThanksForPosts extension is installed.',
	'HIDEBB_HIDE_ATTACH'			=>	'Also hide attachments',
	'HIDEBB_HIDE_ATTACH_EXPLAIN'	=>	'Hide attachments in a post, if a [hide] BBCode is present.',

));

