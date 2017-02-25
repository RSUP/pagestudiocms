<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * PageStudio
 *
 * A web application for managing website content. For use with PHP 5.4+
 * 
 * This application is based on CMS Canvas, a CodeIgniter based application, 
 * http://cmscanvas.com/. It has been greatly altered to work for the 
 * purposes of our development team. Additional resources and concepts have 
 * been borrowed from PyroCMS http://pyrocms.com, for further improvement
 * and reliability. 
 *
 * @package     PageStudio
 * @author      Cosmo Mathieu <cosmo@cosmointeractive.co>
 * @copyright   Copyright (c) 2015, Cosmo Interactive, LLC
 * @license     MIT License
 * @link        http://pagestudiocms.com
 */

// ------------------------------------------------------------------------

/**
 * Generates a thumbnail or a placeholder
 *
 * @param string $source
 * @return string
 */
if ( ! function_exists('gallery_image_thumb'))
{
    function gallery_image_thumb($source = NULL)
    {
        if ( ( ! is_null($source) && $source !== site_url()))
        {
            return image_thumb($source, 215, 170, true);
        }
        else 
        {
            return image_thumb(ADMIN_NO_IMAGE_2, 215, 170, true);
        }
    }
}