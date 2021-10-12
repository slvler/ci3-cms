<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

     function __construct()
    {
        // $this->load does not exist until after you call this
        parent::__construct(); // Construct CI's core so that you can use it
        $this->load->library(['form_validation','session']);
        $this->lang();

    }


    protected function lang() {

        if ($this->uri->segment(1) == 'en' || $this->uri->segment(1) == 'fr'|| $this->uri->segment(1) == 'tr') {
            $this->session->set_userdata("lang", $this->uri->segment(1));
            redirect($this->session->flashdata('redirectToCurrent'));
        }
    }



}