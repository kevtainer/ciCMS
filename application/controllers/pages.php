<?php

class Pages extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('engine_model', '', true);
    }
    
    public function view($page = 'home', $extra = NULL)
    {
        $this->output->enable_profiler(TRUE);
        if (!file_exists('application/views/pages/'.$page.'.php'))
        {
            show_404();
        }
        $content_array = $this->engine_model->load_block(null, null, $page);
        
        foreach ($content_array as $each)
        {
            $data[$each['id']] = $this->engine_model->display_block(null, null, $each);
        }
        $data['title'] = ucfirst($page);
        $data['site_resources'] = SITE_RESOURCES;
        
        $this->load->view('templates/public_header', $data);
        $this->load->view('templates/public_nav', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/public_footer', $data);
    }
}