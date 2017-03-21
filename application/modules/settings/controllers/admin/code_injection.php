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

class Code_injection extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
        // Init
        $data = [];
        $data['breadcrumb'] = set_crumbs([current_url() => 'Settings', 'settings/code-injection' => 'Code Injection']);
        $this->load->model('settings/settings_model');
        
        // Load CodeMirror Scripts
        $this->template->add_stylesheet('/application/modules/settings/assets/css/theme_editor.css'); 
        $this->template->add_package('codemirror');

        // Build object with current settings
        $Settings_table = $this->settings_model->get();

        $data['Settings'] = new stdClass();

        foreach ($Settings_table as $Setting)
        {
            $data['Settings']->{$Setting->slug} = new stdClass();
            $data['Settings']->{$Setting->slug}->value = $Setting->value;
            $data['Settings']->{$Setting->slug}->module = $Setting->module;
        }

        // Form Validation Rules
        // $this->form_validation->set_rules('notification_email', 'Notification Email', 'trim|required|valid_email');

        // Form Processing
        if ($this->form_validation->run() == TRUE)
        {
            foreach ($_POST as $slug => $value)
            {
                if (is_array($value))
                {
                    // Value is an array so save it as a module setting
                    foreach ($value as $module_slug => $module_value)
                    {
                        $Settings_m = new Settings_model();
                        $Settings_m->where('slug', $module_slug)->where('module', $slug)->update('value', $module_value);
                    }
                }
                else
                {
                    $Settings_m = new Settings_model();
                    $Settings_m->where('slug', $slug)->where('module IS NULL')->update('value', $value);
                }
                unset($Settings_m);
            }

            $this->load->library('cache');
            $this->cache->delete_all('settings');

            $this->session->set_flashdata('message', '<p class="success">Settings Saved.</p>');
            redirect(uri_string());
        }
        
        $this->template->view('admin/code_injection', $data);
	}
    
}
