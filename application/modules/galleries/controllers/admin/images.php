<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CMS Canvas
 *
 * @author      Mark Price
 * @copyright   Copyright (c) 2012
 * @license     MIT License
 * @link        http://cmscanvas.com
 */

class Images extends Admin_Controller 
{
    public $model = 'gallery_images_model';
 
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data = array();
        $gallery_id = $this->uri->segment(5);
        $data['breadcrumb'] = set_crumbs(array('galleries' => 'Galleries', current_url() => 'Images'));
        $this->template->add_package('fancybox');
        $data['Gallery'] = $Gallery = $this->load->model('galleries_model');

        $Gallery->get_by_id($gallery_id);

        if ( ! $Gallery->exists())
        {
            return show_404();
        }

        // Get data from db
        $data['Images'] = $Gallery->images->order_by('sort', 'ASC')->get_by_gallery_id($gallery_id);

        $_SESSION['KCFINDER'] = array();
        $_SESSION['KCFINDER']['disabled'] = false;
        $_SESSION['isLoggedIn'] = true;
        
        $this->template->add_package(array('ckeditor', 'ck_jq_adapter'));
        $this->template->view('admin/images/images', $data);
    }
    
    // -------------------------------------------------------------------

    function add()
    {
        if (is_ajax() && $this->input->post('files') && $this->input->post('gallery_id'))
        {
            $this->load->model('gallery_images_model');

            // Get the max sort number for gallery
            $Gallery_image_sort = new Gallery_images_model();
            $sort = $Gallery_image_sort->select_func('MAX', '@sort', 'max_sort')->where('gallery_id', $this->input->post('gallery_id'))->get()->max_sort;

            // Insert selected images
            foreach($this->input->post('files') as $filename)
            {
                $Gallery_image = new Gallery_images_model();
                $Gallery_image->filename = urldecode($filename);
                $Gallery_image->gallery_id = $this->input->post('gallery_id');

                $info = pathinfo(urldecode($filename));
                $Gallery_image->title = ucwords(str_replace(array('_', '-'), ' ', $info['filename']));

                $sort++;
                $Gallery_image->sort = $sort;
                $Gallery_image->save();
                unset($Gallery_image);
            }
        }
        else
        {
            return show_404();
        }
    }
    
    // -------------------------------------------------------------------

    /**
     * This method is only used by Ajax callers. It attempts to update the image details.
     * 
     * @return  void
     */
    public function edit()
    {
        if(is_ajax())
        {
            $Image = $this->load->model('gallery_images_model');
            
            // Setup our Ajax service for responses
            $result = new Service_result();
            
            // Validate Form
            $this->form_validation->set_rules('id', 'Id', "trim|required");
            $this->form_validation->set_rules('title', 'Title', "trim|required");
            $this->form_validation->set_rules('alt', 'Alternative Text', "trim");
            $this->form_validation->set_rules('description', 'Description', 'trim');
            $this->form_validation->set_rules('credits', 'Credits', 'trim');
            $this->form_validation->set_rules('link', 'Link', 'trim');
            $this->form_validation->set_rules('link_text', 'Link Text', 'trim');
            $this->form_validation->set_rules('filename', 'filename', 'trim|required');
            $this->form_validation->set_rules('hide', 'Hide', 'trim|integer');

            if ($this->form_validation->run() == TRUE)
            {
                $ImageId = ($this->input->post('id') != '') ? $this->input->post('id') : NULL;
                $Image->get_by_id($ImageId);
                
                if ($Image->exists())
                {
                    $Image->from_array($this->input->post()); 
                    $Image->description = ($this->input->post('description') != '') ? $this->input->post('description') : NULL;
                    $Image->credits     = ($this->input->post('credits') != '') ? $this->input->post('credits') : NULL;
                    $Image->link        = ($this->input->post('link') != '') ? $this->input->post('link') : NULL;
                    $Image->link_text   = ($this->input->post('link_text') != '') ? $this->input->post('link_text') : NULL;
                    $Image->alt         = ($this->input->post('alt') != '') ? $this->input->post('alt') : NULL;
                    $Image->hide        = ($this->input->post('hide')) ? 1 : 0;
                    $status             = $Image->save();
                    
                    $result->status     = ($status) ? 'success' : 'error';
                    $result->message    = ($status) ? 'Changes saved successfully' : 'Unable to save changes.';
                    $result->result     = 0;
                    
                    $this->session->set_flashdata('message', 'Image saved successfully');
                    header("Content-Type: application/json");
                    echo json_encode($result);
                }
                else 
                {
                    $result->status      = false;
                    $result->message     = 'Image ID #'. $ImageId .' not found in the database';
                    $result->result      = 0;
                    header("Content-Type: application/json");
                    echo json_encode($result);
                }
            }
        }
        else 
        {
            show_error('As of version 1.3.0 only ajax calls are allowed to this method.');
        }
    }

    // -------------------------------------------------------------------
    
    /**
     * 
     * 
     * @return  void
     */
    public function delete()
    {
        $this->load->model('gallery_images_model');
        
        if(is_ajax())
        {
            // Setup our Ajax service for responses
            $result = new Service_result();

            $image_id = (array) ($this->input->post('image_id')) ? $this->input->post('image_id') : null;
            if ( ! is_null($image_id))
            {
                $Images = new Gallery_images_model();
                $Images->where_in('id', $image_id)->get();
                
                if ($Images->exists())
                {
                    $status = $Images->delete_all();
                }
            
                $message            = ($status) ? 'Images successfully deleted' : 'Unable to delete images';
                $result->message    = $message;
                $result->status     = ($status) ? 'success' : 'error';
                
                $this->session->set_flashdata('message', $message);
            }
            
            header("Content-Type: application/json");
            echo json_encode($result);
        }
        else 
        {
            // show_error('As of version 1.3.0 only ajax calls are allowed to this method.');

            if ($this->input->post('selected'))
            {
                $selected = $this->input->post('selected');
            }
            else
            {
                $selected = (array) $this->uri->segment(5);
            }

            $Images = new Gallery_images_model();
            $Images->where_in('id', $selected)->get();

            if ($Images->exists())
            {
                $Images->delete_all();

                $this->session->set_flashdata('message', '<p class="success">The selected items were successfully deleted.</p>');
            }

            redirect(ADMIN_PATH . '/galleries/images/index/'.$this->uri->segment(5)); 
        }
    }
    
    // -------------------------------------------------------------------

    /**
     * Ajax method to update image sort order 
     * 
     * @return  void
     */
    public function order()
    {
        // Order images
        if (is_ajax())
        {
            $result      = new Service_result(); // Setup our Ajax service for responses
            $data        = [];
            $order       = 1;
            $status      = true;

            $image_order = $this->input->post('image_order');            
            $image_order = explode('&', str_replace('order=', '',$image_order));            
            foreach ($image_order as $id){
                $data[] = ['id' => $id, 'sort' => $order];
                $order++;
            }
            ci()->db->update_batch('gallery_images', $data, 'id'); // 'code' is where key

            $message            = ($status) ? 'Changes saved' : 'Unable to save changes';
            $result->message    = $message;
            $result->result     = json_encode($status);
            $result->status     = ($status) ? 'success' : 'error';

            header("Content-Type: application/json");
            echo json_encode($result);
        }
        else
        {
            show_error('As of version 1.3.0 only ajax calls are allowed to this method.');
        }
    }
    
    // -------------------------------------------------------------------

    /**
     * Thumbnail creation method 
     * 
     * @return  void
     */
    public function create_thumb()
    {
        $width  = segment(5);
        $height = segment(6);
        $width  = ( ! empty(segment(5))) ? segment(5) : 100;
        $height = ( ! empty(segment(5)) && empty(segment(6))) ? $width : segment(6);
        
        if (is_ajax())
        {
           if ($this->input->post('image_path'))
           {
               echo image_thumb($this->input->post('image_path'), $width, $height);
           }
        }
        else
        {
            return show_404();
        }
    }
}

