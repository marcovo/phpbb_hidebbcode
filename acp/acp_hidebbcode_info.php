<?php
/** 
*
* @package Hide_BBcode
* @copyright (c) 2015 Marco van Oort
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2 
*
*/

namespace marcovo\hideBBcode\acp;
/**
* @package module_install
*/
class acp_hidebbcode_info
{
    function module()
    {
    return array(
        'filename'    => '\marcovo\hideBBcode\acp\acp_mathjax_module',
        'title'        => 'ACP_HIDEBBCODE',
        'modes'        => array(
            'settings'		=> array('title' => 'ACP_HIDEBBCODE_SETTINGS', 'auth' => 'acl_a_bbcode', 'cat' => array('ACP_HIDEBBCODE_CAT')),
            ),
        );
        
    }

    function install()
    {
    }

    function uninstall()
    {
    }

}
