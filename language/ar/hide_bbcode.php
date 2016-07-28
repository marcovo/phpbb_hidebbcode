<?php
/** 
*
* simple_hide_bbcode [Arabic]
*
* @package language
* @copyright (c) 2015 Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
* Translated By : Bassel Taha Alhitary - www.alhitary.net
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
	'HIDEBB_HIDDEN_MESSAGE'			=> 'تم إخفاء محتوى هذه الرسالة',
	'HIDEBB_MESSAGE_UNHIDE'			=> 'إخفاء: تعطيل',
	'HIDEBB_MESSAGE_HIDDEN'			=> 'إخفاء: تفعيل',
	'HIDEBB_TFP_NO_DELETE'			=> 'الغاء الشكر مُعطل في هذه المشاركة بسبب احتوائها على الـ BBCode : إخفاء المحتوى.',

	'HIDEBB_HIDE_HELPLINE_REPLY'			=> 'إخفاء المحتوى من الأعضاء الذين لم يردوا على هذا الموضوع : [hide]النص[/hide]',
	'HIDEBB_HIDE_HELPLINE_THANK'			=> 'إخفاء المحتوى من الأعضاء الذين لم يشكروا هذه المشاركة : [hide]النص[/hide]',
	'HIDEBB_HIDE_HELPLINE_REPLY_THANK'		=> 'إخفاء المحتوى من الأعضاء الذين لم يردوا على هذا الموضوع ولم يشكروا هذه المشاركة : [hide]النص[/hide]',

	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY'			=> 'يجب عليك الرد على هذا الموضوع لمُشاهدة محتوى هذه الرسالة المخفية',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_THANK'			=> 'يجب أن تشكر هذه المشاركة لمُشاهدة محتوى هذه الرسالة المخفية',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY_THANK'		=> 'يجب عليك الرد على هذا الموضوع أو أن تشكر هذه المشاركة لمُشاهدة محتوى هذه الرسالة المخفية',

	'HIDEBB_MESSAGE_HIDDEN_ATTACH'				=> 'هذه المُشاركة تحتوي على مرفقات مخفية.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY'		=> 'يجب عليك الرد على هذا الموضوع لمُشاهدة المرفقات المخفية.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_THANK'		=> 'يجب أن تشكر هذه المشاركة لمُشاهدة المرفقات المخفية.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY_THANK'	=> 'يجب عليك الرد على هذا الموضوع أو أن تشكر هذه المشاركة لمُشاهدة المرفقات المخفية.',
));

