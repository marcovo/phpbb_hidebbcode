<?php
/** 
*
* simple_hide_bbcode [Russian]
*
* @package language
* @copyright (c) 2015 Marco van Oort
* @translated by LavIgor (https://github.com/lavigor)
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
	'ACP_HIDEBBCODE_SETTINGS'		=>	'Основные настройки',

	'HIDEBB_SETTINGS'				=>	'Основные настройки [hide] BBCode',
	'HIDEBB_SETTINGS_EXPLAIN'		=>	'Здесь вы можете задать настройки [hide] BBCode.',

	'HIDEBB_REPLY_ENABLE'			=>	'Делать доступным скрытый контент, если пользователь ответил в теме',
	'HIDEBB_REPLY_ENABLE_EXPLAIN'	=>	'Позволяет пользователям просматривать содержимое между тегами [hide] после публикации ответа в теме.',
	'HIDEBB_TFP_ENABLE'				=>	'Делать доступным скрытый контент, если пользователь поблагодарил автора за сообщение',
	'HIDEBB_TFP_ENABLE_EXPLAIN'		=>	'Позволяет пользователям, поблагодарившим автора за сообщение, просматривать содержимое между тегами [hide]. Если пользователь поблагодарил автора за сообщение, в котором содержится [hide] BBCode, этот пользователь больше не сможет удалить данную благодарность.<br />Эта опция действует только при включённом расширении ThanksForPosts.',
	'HIDEBB_HIDE_ATTACH'			=>	'Скрывать также вложения',
	'HIDEBB_HIDE_ATTACH_EXPLAIN'	=>	'Скрывать вложения в сообщении, если в нём присутствует [hide] BBCode.',

));
