<?php

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Language_model','Category_model','Product_model','Subcategory_model','Menu_model','Submenu_model','Settings_model']);
        $this->load->helper(["url","form","basic","string","text"]);
        $this->load->library(['form_validation','session']);

    }

    public function index()
    {


        $data["language"] = $this->Language_model->select_all();
        $data["settings"] = $this->Settings_model->select_all();
        $data["category"] = $this->Category_model->select_all();
        $data["product"] = $this->Product_model->select_all_lang();

        $this->load->view('front/index',$data);
    }








}