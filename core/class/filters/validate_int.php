<?php
/**
 * Name: validate_string.php
 * Description:
 *
 * @package : Xoosla Modules
 * @Module :
 * @subpackage :
 * @since : v1.0.0
 * @author John Neill <catzwolf@xoosla.com> Neill <catzwolf@xoosla.com>
 * @copyright : Copyright (C) 2010 Xoosla. All rights reserved.
 * @license : GNU/LGPL, see docs/license.php
 * @version : $Id: validate_string.php 0000 02/04/2009 22:21:06:000 Catzwolf $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * XooslaFilter_Validate_Int
 *
 * @package
 * @author John Neill <catzwolf@xoosla.com>
 * @copyright Copyright (c) 2010
 * @version $Id$
 * @access public
 */
class XooslaFilter_Validate_Int extends XooslaRequest {
    /**
     * XooslaFilter_Validate_String::render()
     *
     * @param mixed $value
     * @return
     */
    function doRender( $value = null ) {
        if ( filter_var( $value, FILTER_VALIDATE_INT ) === false ) {
            return false;
        } else {
            return true;
        }
    }
}

?>