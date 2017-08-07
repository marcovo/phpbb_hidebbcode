<?php
/** 
*
* [hide] BBcode extension for the phpBB Forum Software package.
* French translation by Taka51 (http://webdvdbdhd.com/) & Galixte (http://www.galixte.com)
*
* @copyright (c) 2015 Marco van Oort
* @license GNU General Public License, version 2 (GPL-2.0)
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
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_HIDEBBCODE_CAT'			=>	'BBCode [hide]',
	'ACP_HIDEBBCODE_SETTINGS'		=>	'Paramètres',

	'HIDEBB_SETTINGS'				=>	'Paramètres généraux du BBCode [hide]',
	'HIDEBB_SETTINGS_EXPLAIN'		=>	'Sur cette page, il est possible de configurer la manière dont le BBCode [hide] se comporte.',

	'HIDEBB_REPLY_ENABLE'			=>	'Répondre au sujet pour voir le contenu masqué',
	'HIDEBB_REPLY_ENABLE_EXPLAIN'	=>	'Permet aux utilisateurs de voir le contenu placé entre les balises du BBCode [hide] en publiant une réponse dans le sujet.',
	'HIDEBB_TFP_ENABLE'				=>	'Remercier l’auteur du sujet pour voir le contenu masqué',
	'HIDEBB_TFP_ENABLE_EXPLAIN'		=>	'Permet aux utilisateurs de voir le contenu placé entre les balises du BBCode [hide] en remerciant l’auteur du sujet. Si un utilisateur a remercié un message contenant le BBCode [hide] il ne peut plus supprimer son remerciement effectué.<br />Cette option est effective uniquement si l’extension « Thanks For Posts » est installée.',
	'HIDEBB_HIDE_ATTACH'			=>	'Masquer les fichiers joints',
	'HIDEBB_HIDE_ATTACH_EXPLAIN'	=>	'Permet de masquer les fichiers joints placés entre les balises du BBCode [hide] dans un message. Auquel cas contraire, elles seront affichées.',

));

