<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');

        // Load MongoDB library instead of native db driver if required
        $this->config->item('use_mongodb', 'ion_auth') ?
                        $this->load->library('mongo_db') :
                        $this->load->database();

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    public function index() {
        $data = array(
            'checked' => $this->ion_auth->logged_in(),
            'message' => '',
'review'=>false,
'complete'=>false,
'review_get'=>'',
        );
        $this->load->view('welcome_message', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */