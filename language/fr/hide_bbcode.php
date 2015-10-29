<?php
/** 
*
* simple_hide_bbcode [French]
*
* Translate French by Taka51 (http://webdvdbdhd.com/)
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
	'HIDEBB_HIDDEN_MESSAGE'			=> 'Ce message a été cachée',
	'HIDEBB_MESSAGE_UNHIDE'			=> 'HIDE: OFF',
	'HIDEBB_MESSAGE_HIDDEN'			=> 'HIDE: ON',
	'HIDEBB_TFP_NO_DELETE'			=> 'La suppression de remerciement a était désactive pour ce sujet car il ya un [hide] -BBCode présent dans le poste.',

	'HIDEBB_HIDE_HELPLINE_REPLY'			=> 'Cacher aux membres qui n\' ont pas répondu dans ce sujet: [hide]text[/hide]',
	'HIDEBB_HIDE_HELPLINE_THANK'			=> 'Cacher aux membres qui n\' ont pas rémercier dans ce sujet: [hide]text[/hide]',
	'HIDEBB_HIDE_HELPLINE_REPLY_THANK'		=> 'Cacher aux membres qui n\' ont pas répondu et remercier dans ce sujet: [hide]text[/hide]',

	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY'			=> 'Vous devez répondre à ce sujet avant de pouvoir afficher le message caché',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_THANK'			=> 'vous devez remercier ce sujet avant de pouvoir afficher le message caché',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY_THANK'		=> 'Vous devez répondre à ce sujet et remercier ce message avant de pouvoir voir le message caché',

	'HIDEBB_MESSAGE_HIDDEN_ATTACH'				=> 'Ce message contient des piéces jointes cachées.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY'		=> 'Pour visualiser les piéces jointes, vous devez répondre à ce sujet.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_THANK'		=> 'Pour visualiser les piéces jointes, vous devez remercier ce sujet.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY_THANK'	=> 'Pour visualiser les piéces jointes, vous devez répondre où remercier ce sujet.',
));

