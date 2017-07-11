<?php
/**
 * Name: class.rss.php
 * Description:
 *
 * @package : Xoosla Modules
 * @Module :
 * @subpackage :
 * @since : v1.0.0
 * @author John Neill <catzwolf@xoosla.com> Neill <catzwolf@xoosla.com>
 * @copyright : Copyright (C) 2010 Xoosla. All rights reserved.
 * @license : GNU/LGPL, see docs/license.php
 * @version : $Id: class.rss.php 0000 02/04/2009 05:46:40:000 Catzwolf $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * wpp_Rss
 *
 * @package
 * @author John Neill <catzwolf@xoosla.com>
 * @copyright Copyright (c) 2010
 * @version $Id$
 * @access public
 */
class XooslaRss {
    var $channel = array();
    var $values;

    /**
     * XooslaRss::__construct()
     */
    function __construct() {
        xoops_load( 'XoopsLocal' );
    }

    /**
     * wpp_Rss::basics()
     *
     * @return
     */
    function basics( $image, $path ) {
        $this->channel['channel_title'] = self::setEncoding( self::getChannelTitle() );
        $this->channel['channel_link'] = self::getChannelLink();
        $this->channel['channel_desc'] = self::setEncoding( $GLOBALS['xoopsConfig']['slogan'] );
        $this->channel['channel_lastbuild'] = formatTimestamp( time(), 'rss' );
        $this->channel['channel_webmaster'] = self::checkEmail( $GLOBALS['xoopsConfig']['adminmail'] );
        $this->channel['channel_editor'] = self::checkEmail( $GLOBALS['xoopsConfig']['adminmail'] );
        $this->channel['channel_editor_name'] = self::setEncoding( $GLOBALS['xoopsConfig']['sitename'] );
        $this->channel['channel_category'] = self::setEncoding( $GLOBALS['xoopsModule']->getVar( 'name' ) ) ;
        $this->channel['channel_generator'] = 'PHP';
        $this->channel['channel_language'] = _LANGCODE;
        self::getChannelImage( $image, $path );
    }

    /**
     * wpp_Rss::getChannelTitle()
     *
     * @return
     */
    function getChannelTitle() {
        return ( is_object( $GLOBALS['xoopsModule'] ) ) ? $GLOBALS['xoopsConfig']['sitename'] . ' - ' . $GLOBALS['xoopsModule']->getVar( 'name', 'e' ) : $GLOBALS['xoopsConfig']['sitename'];
    }

    /**
     * wpp_Rss::getChannelLink()
     *
     * @return
     */
    function getChannelLink() {
        $moduleUrl = XOOPS_URL;
        if ( is_object( $GLOBALS['xoopsModule'] ) ) {
            $moduleUrl .= '/modules/' . $GLOBALS['xoopsModule']->getVar( 'dirname' );
        }
        return $moduleUrl;
        unset( $moduleUrl );
    }

    /**
     * wpp_Rss::getChannelImage()
     *
     * @return
     */
    function getChannelImage( $image, $path = '' ) {
        // image_url
        if ( file_exists( $file = XOOPS_ROOT_PATH . '/' . $path . '/' . $image ) ) {
            $dimention = getimagesize( $file );
            $width = ( empty( $dimention[0] ) ) ? 88 : ( $dimention[0] > 144 ) ? 144 : $dimention[0];
            $height = ( empty( $dimention[0] ) ) ? 31 : ( $dimention[0] > 400 ) ? 400 : $dimention[1];
            /**
             */
            $this->channel['image_url'] = XOOPS_URL . '/' . $path . '/' . $image;
            $this->channel['image_width'] = ( int )$width;
            $this->channel['image_height'] = ( int )$height;
        }
    }

    /**
     * wpp_Rss::setEncoding()
     *
     * @return
     */
    function setEncoding( $value ) {
        return XoopsLocal::convert_encoding( htmlspecialchars( $value, ENT_QUOTES ) );
    }

    /**
     * wpp_Rss::CheckEmail()
     *
     * @return
     */
    function checkEmail( $value ) {
        return checkEmail( $value );
    }

    /**
     * wpp_Rss::setRssValue()
     *
     * @param mixed $name
     * @param mixed $value
     * @param mixed $special
     * @return
     */
    function setChannelValue( $name, $value, $special = true ) {
        $this->channel[$name] = ( $special ) ? htmlspecialchars( $value, ENT_QUOTES ): $value;
    }

    /**
     * XooslaRss::render()
     *
     * @return
     */
    function render() {
        return $this->channel;
    }
}

?>