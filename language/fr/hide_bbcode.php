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
	'HIDEBB_HIDDEN_MESSAGE'			=> 'Ce message a été masqué',
	'HIDEBB_MESSAGE_UNHIDE'			=> 'BBCode [hide] : désactivé',
	'HIDEBB_MESSAGE_HIDDEN'			=> 'BBCode [hide] : activé',
	'HIDEBB_TFP_NO_DELETE'			=> 'La suppression du remerciement a été désactivée pour ce sujet car le BBCode [hide] est présent dans le message.',

	'HIDEBB_HIDE_HELPLINE_REPLY'			=> 'Masquer aux membres qui n’ont pas répondu au sujet : [hide]Contenu texte, etc..[/hide]',
	'HIDEBB_HIDE_HELPLINE_THANK'			=> 'Masquer aux membres qui n’ont pas rémercié le sujet : [hide]Contenu texte, etc..[/hide]',
	'HIDEBB_HIDE_HELPLINE_REPLY_THANK'		=> 'Masquer aux membres qui n’ont pas répondu et remercié le sujet : [hide]Contenu texte, etc..[/hide]',

	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY'			=> 'Vous devez répondre à ce sujet afin afficher le contenu masqué.',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_THANK'			=> 'Vous devez remercier ce sujet afin afficher le contenu masqué.',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY_THANK'		=> 'Vous devez répondre à ce sujet et le remercier afin afficher le contenu masqué.',

	'HIDEBB_MESSAGE_HIDDEN_ATTACH'				=> 'Ce message contient des pièces jointes masquées.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY'		=> 'Afin de voir les piéces jointes, vous devez répondre à ce sujet.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_THANK'		=> 'Afin de voir les piéces jointes, vous devez remercier ce sujet.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY_THANK'	=> 'Afin de voir les piéces jointes, vous devez répondre et remercier ce sujet.',
));

