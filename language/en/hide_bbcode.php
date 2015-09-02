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
	'HIDEBB_HIDDEN_MESSAGE'			=> 'This message has been hidden',
	'HIDEBB_MESSAGE_UNHIDE'			=> 'HIDE: OFF',
	'HIDEBB_MESSAGE_HIDDEN'			=> 'HIDE: ON',
	'HIDEBB_TFP_NO_DELETE'			=> 'Deleting thanks is disabled for this post as there is a [hide]-BBCode present in the post.',

	'HIDEBB_HIDE_HELPLINE_REPLY'			=> 'Hide from people that have not posted in this topic: [hide]text[/hide]',
	'HIDEBB_HIDE_HELPLINE_THANK'			=> 'Hide from people that have not thanked this post: [hide]text[/hide]',
	'HIDEBB_HIDE_HELPLINE_REPLY_THANK'		=> 'Hide from people that have not posted in this topic and have not thanked this post: [hide]text[/hide]',

	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY'			=> 'You need to reply to this topic before you can view the hidden message',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_THANK'			=> 'You need to thank this post before you can view the hidden message',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY_THANK'		=> 'You need to reply to this topic or thank this post before you can view the hidden message',

	'HIDEBB_MESSAGE_HIDDEN_ATTACH'				=> 'This post contains hidden attachments.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY'		=> 'To view the attachments, you need to reply to this topic.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_THANK'		=> 'To view the attachments, you need to thank this post.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY_THANK'	=> 'To view the attachments, you need to reply to this topic or thank this post.',
));

