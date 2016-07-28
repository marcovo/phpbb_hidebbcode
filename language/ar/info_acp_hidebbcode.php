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
	'ACP_HIDEBBCODE_CAT'			=>	'إخفاء المحتوى BBCode',
	'ACP_HIDEBBCODE_SETTINGS'		=>	'الإعدادات',

	'HIDEBB_SETTINGS'				=>	'إعدادات إخفاء المحتوى BBCode',
	'HIDEBB_SETTINGS_EXPLAIN'		=>	'من هنا تستطيع ضبط الإعدادات الخاصة بالإضافة : إخفاء المحتوى BBCode.',

	'HIDEBB_REPLY_ENABLE'			=>	'عرض المحتوى المخفي عند الرد ',
	'HIDEBB_REPLY_ENABLE_EXPLAIN'	=>	'السماح للأعضاء بُمشاهدة المحتوى المخفي عند الرد على الموضوع.',
	'HIDEBB_TFP_ENABLE'				=>	'عرض المحتوى المخفي عند الشكر ',
	'HIDEBB_TFP_ENABLE_EXPLAIN'		=>	'السماح للأعضاء بُمشاهدة المحتوى المخفي عندما يشكرون صاحب المُشاركة. قد لا يستطيع العضو الغاء الشكر لو المشاركة تحتوي على الـ BBCode : إخفاء المحتوى.<br />هذا الخيار يعمل فقط عند تثبيت الإضافة "شكراً للمُشاركات" في منتداك.',
	'HIDEBB_HIDE_ATTACH'			=>	'إخفاء المرفقات ',
	'HIDEBB_HIDE_ATTACH_EXPLAIN'	=>	'اختيارك "نعم" يعني إخفاء المرفقات في المشاركة التي تحتوي على الـ BBCode : إخفاء المحتوى. يستطيع الأعضاء مُشاهدة المرفقات ضمن المشاركة إذا لم يتم ادخالها بين الأوسمة [hide] الخاصة بالـ BBCode : إخفاء المحتوى. ',

));

