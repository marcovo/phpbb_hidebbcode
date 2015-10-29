<?php
/** 
*
* simple_hide_bbcode [French]
* Translate French By Taka51 (http://webdvdbdhd.com/)
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
	'ACP_HIDEBBCODE_SETTINGS'		=>	'Paramétres Générales',

	'HIDEBB_SETTINGS'				=>	'Paramétres Générales [hide] BBCode',
	'HIDEBB_SETTINGS_EXPLAIN'		=>	'Ici vous pouvez configurer la manière dont le [hide] BBCode se comporte.',

	'HIDEBB_REPLY_ENABLE'			=>	'Le code [hide] est affiché quand un utilisateur a répondu dans le sujet',
	'HIDEBB_REPLY_ENABLE_EXPLAIN'	=>	'Cela permet aux utilisateurs de visualiser le contenu de la [hide] BBCode en postant une réponse dans le sujet.',
	'HIDEBB_TFP_ENABLE'				=>	'Le code [hide] est affiché quand un membre à remercier le sujet',
	'HIDEBB_TFP_ENABLE_EXPLAIN'		=>	'Cela permet aux utilisateurs de visualiser le contenu de la [hide] BBCode lorsqu\'ils ont remercier l\'auteur du sujet. Si un utilisateur a remercié a un message qui contient une [hide] BBCode, le membre ne peut plus supprimer le remerciement effectuer.<br />Cette option n\'a d\'effet que si l\'extension de ThanksForPosts est installé.',
	'HIDEBB_HIDE_ATTACH'			=>	'Cacher aussi les pièces jointes',
	'HIDEBB_HIDE_ATTACH_EXPLAIN'	=>	'Cacher les pièces jointes dans un message, Si un [hide] BBCode est présent. Les piéces jointes affichés sont cacher si elles sont à l\'intérieur de la balise [hide] BBcode, sinon elles seront affichés. Les Autres pièces jointes seront cachées si elles sont cachés dans la balise [hide] BBCode si celui-ci est présent dans le poste.',

));

