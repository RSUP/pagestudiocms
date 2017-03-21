<?php  defined('BASEPATH') OR exit('No direct script access allowed');
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

class Theme extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
        // Init
        $data = [];
        $data['breadcrumb'] = set_crumbs(array(current_url() => 'Theme Settings'));

        
        $this->template->view('admin/site_preview', $data);
	}
    
}
