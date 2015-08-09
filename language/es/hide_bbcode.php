<?php
/** 
*
* simple_hide_bbcode [Spanish]
*
* @package language
* @copyright (c) 2015 Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
* Translated to the Spanish for zone_sjm https://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=1497666
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
	'HIDEBB_HIDDEN_MESSAGE'	=>	'Este mensaje a sido oculto.',
	'HIDEBB_MESSAGE_UNHIDE'	=>	'Ya puedes ver el contenido del mensaje oculto.',
	'HIDEBB_MESSAGE_HIDDEN'	=>	'Mensaje oculto',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION'	=>	'Tu necesitas responder a este tema para que puedas ver el mensaje oculto.',
));

