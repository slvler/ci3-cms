<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['form_validation','session']);
        $this->load->model(['Menu_model','Submenu_model']);

        $this->security();

    }


    function security()
    {

        $giris = $this->session->userdata('email');
        if (!$giris) {
            redirect('login');
        }
    }

    public function index()
    {

        $data["title"] = "Index Page | qwerty - CMS";
        $data["subtitle"] = "Index Page";

        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();

        $this->load->view("back/index",$data);

    }
}
