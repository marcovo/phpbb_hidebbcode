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
	'HIDEBB_HIDDEN_MESSAGE'				=> 'Это сообщение скрыто',
	'HIDEBB_MESSAGE_UNHIDE'				=> 'Сообщение доступно для просмотра',
	'HIDEBB_MESSAGE_HIDDEN'				=> 'Скрытый контент',
	'HIDEBB_TFP_NO_DELETE'				=> 'Удаление благодарностей недоступно для этого сообщения в связи с наличием в нём [hide]-BBCode.',

	'HIDEBB_HIDE_HELPLINE_REPLY'			=> 'Скрыть от пользователей, не ответивших в этой теме: [hide]текст[/hide]',
	'HIDEBB_HIDE_HELPLINE_THANK'			=> 'Скрыть от пользователей, не оставивших благодарность за это сообщение: [hide]текст[/hide]',
	'HIDEBB_HIDE_HELPLINE_REPLY_THANK'		=> 'Скрыть от пользователей, не ответивших в этой теме и не оставивших благодарность за это сообщение: [hide]текст[/hide]',

	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY'			=> 'Вам нужно ответить в этой теме, после чего вы сможете посмотреть скрытый контент',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_THANK'			=> 'Вам нужно поблагодарить автора за это сообщение, после чего вы сможете посмотреть скрытый контент',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY_THANK'		=> 'Вам нужно ответить в этой теме или поблагодарить автора за это сообщение, после чего вы сможете посмотреть скрытый контент',

	'HIDEBB_MESSAGE_HIDDEN_ATTACH'				=> 'Это сообщение содержит скрытые вложения.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY'		=> 'Чтобы посмотреть вложения, вам нужно ответить в этой теме.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_THANK'		=> 'Чтобы посмотреть вложения, вам нужно поблагодарить автора за это сообщение.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY_THANK'	=> 'Чтобы посмотреть вложения, вам нужно ответить в этой теме или поблагодарить автора за это сообщение.',
));
