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
	'ACP_HIDEBBCODE_CAT'			=>	'[hide] BBCode',
	'ACP_HIDEBBCODE_SETTINGS'		=>	'Configurações Gerais',

	'HIDEBB_SETTINGS'				=>	'[hide] BBCode configurações gerais',
	'HIDEBB_SETTINGS_EXPLAIN'		=>	'Aqui você pode configurar como o [hide] BBCode se comporta.',

	'HIDEBB_REPLY_ENABLE'			=>	'O [hide] code é desativado quando um usuário responder no tópico',
	'HIDEBB_REPLY_ENABLE_EXPLAIN'	=>	'Isso permite aos usuários visualizar o conteúdo do [hide] BBCode postando uma resposta no tópico.',
	'HIDEBB_TFP_ENABLE'				=>	'O [hide] code é desativado quando um usuário agradece o post',
	'HIDEBB_TFP_ENABLE_EXPLAIN'		=>	'Isso permite aos usuários visualizar o conteúdo do [hide] BBCode, agradecendo a um usuário. Se um usuário agradeceu um post que contém um [hide] BBCode, o usuário não pode excluir isso, agradecer mais. <br /> Esta opção só tem efeito se a extensão ThanksForPosts estiver instalada.',
	'HIDEBB_HIDE_ATTACH'			=>	'Também ocultar anexos',
	'HIDEBB_HIDE_ATTACH_EXPLAIN'	=>	'Oculta anexos em uma postagem, se um [hide] BBCode estiver presente. Os anexos em linha estão escondidos se estiverem dentro das tags [hide], caso contrário, elas são mostradas. Outros anexos serão ocultos se um [hide] bbcode estiver presente no post.',

));

