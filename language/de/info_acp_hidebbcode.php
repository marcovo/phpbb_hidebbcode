<?php
/** 
*
* simple_hide_bbcode [German]
*
* @package language
* @copyright Marco van Oort https://github.com/marcovo/ , Miri4ever
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
	'ACP_HIDEBBCODE_CAT'         =>   '[hide] BBCode',
	'ACP_HIDEBBCODE_SETTINGS'      =>   'Allgemeine Einstellungen',

	'HIDEBB_SETTINGS'            =>   '[hide] BBCode Allgemeine Einstellungen',
	'HIDEBB_SETTINGS_EXPLAIN'      =>   'Hier können Sie das Verhalten von [hide] BBCode festlegen.',

	'HIDEBB_REPLY_ENABLE'         =>   'Der [hide] Befehl wird nicht versteckt wenn ein Benutzer auf den Beitrag antwortet.',
	'HIDEBB_REPLY_ENABLE_EXPLAIN'   =>   'Dies erlaubt den Benutzern den Inhalt von [hide] BBCode durch antworten im Beitrag zu sehen.',
	'HIDEBB_TFP_ENABLE'            =>   'Der [hide] Befehl wird nicht versteckt wenn ein Benutzer sich für Beitrag bedankt.',
	'HIDEBB_TFP_ENABLE_EXPLAIN'      =>   'Dies erlaubt den Benutzern den Inhalt von [hide] BBCode durch bedanken im Beitrag zu sehen. Wenn sich ein Benutzer für einen Beitrag bedankt hat, welcher [hide] BBCode enthält, so kann er diese Bedankung nicht mehr löschen.<br />Diese Funktion beeinflußt nur die ThanksForPosts Erweiterung wenn diese installiert ist.',
	'HIDEBB_HIDE_ATTACH'         =>   'Auch Dateianhänge verstecken',
	'HIDEBB_HIDE_ATTACH_EXPLAIN'   =>   'Versteckt Dateianhänge in Beiträgen wenn [hide] BBCode aktiv ist. Inline Dateianhänge sind versteckt wenn sie innerhalb von [hide] stehen, ansonsten werden sie angezeigt. Andere Dateianhänge werden versteckt wenn [hide] bbcode im Beitrag aktiv ist.',
));

