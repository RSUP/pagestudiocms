<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CMS Canvas
 *
 * @author      Mark Price
 * @copyright   Copyright (c) 2012
 * @license     MIT License
 * @link        http://cmscanvas.com
 */

class Galleries extends Admin_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data = array();
        $data['breadcrumb'] = set_crumbs(array(current_url() => 'Galleries'));
        $Galleries = $this->load->model('galleries_model');

        // Get data from db
        $data['Galleries'] = $Galleries->get();

        $this->template->view('admin/galleries/galleries', $data);
    }

    /**
     * Methd to create and update a photo album
     * 
     * @return  void
     */
    public function edit()
    {
        if(is_ajax())
        {
            $Gallery    = $this->load->model('galleries_model');
            $edit_mode  = FALSE;
            $gallery_id = ($this->input->post('id') !== '') ? $this->input->post('id') : NULL;
            
            // Setup our Ajax service for responses
            $result = new Service_result();
            
            // Set Mode
            if ( ! is_null($gallery_id))
            {
                $edit_mode = TRUE;
                $Gallery->get_by_id($gallery_id);

                if ( ! $Gallery->exists()) 
                {
                    $result->message    = 'Unable to find album';
                    header("Content-Type: application/json");
                    echo json_encode($result);
                    exit;
                }
            }
            
            // Validate Form
            $this->form_validation->set_rules('title', 'Title', "trim|required");

            if ($this->form_validation->run() == TRUE)
            {
                $posts = $this->input->post();
                if (is_null($gallery_id)) {
                    unset($posts['id']);
                }
                
                $Gallery->from_array($posts);
                $status = $Gallery->save();

                if ($edit_mode)
                {
                    $message         = ($status) ? 'Changes saved successfully' : 'Unable to save changes';
                    $result->message = $message;
                    $result->status  = ($status) ? 'success' : 'error';
                    $result->result  = ['redirect' => site_url(ADMIN_PATH . '/galleries')];
                    $this->session->set_flashdata('message', $message);
                }
                else
                {
                    if ($status) 
                    {
                        $message         = 'Please add images to your album';
                        $result->message = $message;
                        $result->status  = 'success';
                        $result->result  = ['redirect' => site_url(ADMIN_PATH . '/galleries/images/index/' . $Gallery->id)];
                        $this->session->set_flashdata('message', $message);
                    }
                    else 
                    {
                        $message         = 'Unable to save changes';
                        $result->message = $message;
                        $this->session->set_flashdata('message', $message);
                    }
                }
            }
            
            header("Content-Type: application/json");
            echo json_encode($result);
            exit;
        }
        else 
        {
            show_error('As of version 1.3.0 only ajax calls are allowed to this method.');
        }
    }

    public function delete()
    {
        if ($this->input->post('selected'))
        {
            $selected = $this->input->post('selected');
        }
        else
        {
            $selected = (array) $this->uri->segment(4);
        }

        $this->load->model('galleries_model');
        $Galleries = $this->galleries_model->where_in('id', $selected)->get();

        if ($Galleries->exists())
        {
            foreach($Galleries as $Gallery)
            {
                $Gallery->images->get()->delete_all();
                $Gallery->delete();
            }

            $this->session->set_flashdata('message', '<p class="success">Gallery was deleted successfully.</p>');

            if(is_ajax())
            {
                // Setup our Ajax service for responses
                $result = new Service_result();
                
                $message         = 'Album was deleted successfully';
                $result->message = $message;
                $result->status  = 'success';
                $result->result  = ['redirect' => site_url(ADMIN_PATH . '/galleries')];
                $this->session->set_flashdata('message', $message);
                
                header("Content-Type: application/json");
                echo json_encode($result);
                exit;
            }
        }
        
        redirect(ADMIN_PATH . '/galleries'); 
    }
}

