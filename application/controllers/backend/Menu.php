<?php

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(["url","form","basic","string"]);
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


    public function index(){
        $data["title"] = "Menu Listing Page | qwerty - CMS";
        $data["subtitle"] = "Menu Listing Page";
        $data["breadcrumb"] = "Menu";


        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();


        $data["result"] =  $this->Menu_model->select_all();

        $this->load->view('back/menu/listingpage',$data);
    }

    public function add(){

        $data["title"] = "Menu Add Page | qwerty - CMS";
        $data["subtitle"] = "Menu Add Page";
        $data["breadcrumb"] = "Menu";

        $data["menu"] = $this->Menu_model->select_all();
        $data["submenu"] = $this->Submenu_model->select_all_index();

        $this->load->view('back/menu/addpage',$data);
    }
    public function add_form()
    {
        if ($_POST){


            $this->form_validation->set_rules('name', 'Title', 'required');
            $this->form_validation->set_rules('desc', 'Desc', 'required');
            $this->form_validation->set_rules('active', 'Active', 'required');

            $this->form_validation->set_message('required', '%s not empty.');
            if ($this->form_validation->run() == FALSE)
            {

                $result = [
                    'status' => 'Error Form',
                    'active' => 'warning',
                    'text' => validation_errors()
                ];

                $v =  json_encode($result);
                echo $v;
                exit();
            }


            $title = $this->input->post('name');
            $desc = $this->input->post('desc');
            $active = $this->input->post('active');


            $data = array(
                'name' => $title,
                'desc' => $desc,
                'active' => $active,
            );

            $stepResult =  $this->Menu_model->menu_add($data);

            if ($stepResult){
                $result = [
                    'status' => 'Accept Form',
                    'active' => 'ok',
                    'text' => "Success Record"
                ];
            }else{
                $result = [
                    'status' => 'Error Form',
                    'active' => 'no',
                    'text' => "Errors Record"
                ];

            }

            $stepData = json_encode($result);
            echo $stepData;

        }
    }

}