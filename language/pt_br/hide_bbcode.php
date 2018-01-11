<?php
/** 
*
* simple_hide_bbcode [Brazilian Portuguese [pt_br]]
* Brazilian Portuguese translation by eunaumtenhoid (c) 2017 [ver 2.0.0] (https://github.com/phpBBTraducoes)
* @package language
* @copyright (c) 2015 Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 

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
	'HIDEBB_HIDDEN_MESSAGE'			=> 'Esta mensagem foi oculta',
	'HIDEBB_MESSAGE_UNHIDE'			=> 'HIDE: DESLIGADO',
	'HIDEBB_MESSAGE_HIDDEN'			=> 'HIDE: LIGADO',
	'HIDEBB_TFP_NO_DELETE'			=> 'A exclusão de agradecimentos está desativada para este post, pois existe um [hide] BBCode presente no post.',

	'HIDEBB_HIDE_HELPLINE_REPLY'			=> 'Ocultar de pessoas que não postaram neste tópico: [hide]texto[/hide]',
	'HIDEBB_HIDE_HELPLINE_THANK'			=> 'Ocultar de pessoas que não agradeceram neste tópico: [hide]text[/hide]',
	'HIDEBB_HIDE_HELPLINE_REPLY_THANK'		=> 'Ocultar de pessoas que não postaram neste tópico e não agradeceram este post: [hide]text[/hide]',

	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY'			=> 'Você precisa responder a este tópico antes de poder visualizar a mensagem oculta',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_THANK'			=> 'Você precisa agradecer esta postagem antes de poder visualizar a mensagem oculta',
	'HIDEBB_MESSAGE_HIDDEN_DESCRIPTION_REPLY_THANK'		=> 'Você precisa responder a este tópico ou agradecer esta postagem antes de poder visualizar a mensagem oculta',

	'HIDEBB_MESSAGE_HIDDEN_ATTACH'				=> 'Este post contém anexos ocultos.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY'		=> 'Para visualizar os anexos, você precisa responder a este tópico.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_THANK'		=> 'Para visualizar os anexos, você precisa agradecer este post.',
	'HIDEBB_MESSAGE_HIDDEN_ATTACH_REPLY_THANK'	=> 'Para visualizar os anexos, você precisa responder a este tópico ou agradecer esta postagem.',
));

