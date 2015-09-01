<?php
/** 
*
* simple_hide_bbcode [Dutch]
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
	'ACP_HIDEBBCODE_SETTINGS'		=>	'Algemene instellingen',

	'HIDEBB_SETTINGS'				=>	'[hide] BBCode algemene instellingen',
	'HIDEBB_SETTINGS_EXPLAIN'		=>	'Hier kun je configureren hoe de [hide] BBCode zich moet gedragen.',

	'HIDEBB_REPLY_ENABLE'			=>	'De [hide] code wordt onthuld zodra het lid een reactie plaatst in het topic',
	'HIDEBB_REPLY_ENABLE_EXPLAIN'	=>	'Dit stelt het lid in staat om de inhoud van de [hide] BBCode te bekijken door in het topic een reactie te plaatsen.',
	'HIDEBB_TFP_ENABLE'				=>	'De [hide] code wordt onthuld zodra het lid het bericht bedankt',
	'HIDEBB_TFP_ENABLE_EXPLAIN'		=>	'Dit stelt het lid in staat om de inhoud van de [hide] BBCode te bekijken door de plaatser van het bericht te bedanken. Als een lid een bericht heeft bedankt dat een [hide] BBCode bevat, zal het lid dat bedankje niet meer kunnen verwijderen.<br />Deze optie heeft alleen effect als de ThanksForPosts extensie geïnstalleerd is.',
	'HIDEBB_HIDE_ATTACH'			=>	'Verberg ook bijlagen',
	'HIDEBB_HIDE_ATTACH_EXPLAIN'	=>	'Verberg bijlagen in een bericht, als er een [hide] BBCode aanwezig is.',

));

