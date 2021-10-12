<?php

class Submenu extends CI_Controller
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


    public function index($id){
        $data["title"] = "Submenu Listing Page | qwerty - CMS";
        $data["subtitle"] = "Submenu Listing Page";

        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();
        $data["breadcrumb"] = "Menu";

        $data["result"] =  $this->Submenu_model->select_all($id);


        $this->load->view('back/submenu/listingpage',$data);
    }


    public function add($id)
    {
        $data["title"] = "Submenu Add Page | qwerty - CMS";
        $data["subtitle"] = "Submenu Add Page";
        $data["breadcrumb"] = "Menu";

        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();




        $this->load->view('back/submenu/addpage',$data);
    }

    public function add_form()
    {
        if ($_POST){



            $this->form_validation->set_rules('name', 'Title', 'required');
            $this->form_validation->set_rules('desc', 'Desc', 'required');
            $this->form_validation->set_rules('active', 'Active', 'required');
            $this->form_validation->set_rules('menu_id', 'Menu Id', 'required');

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


            $menu_id = $this->input->post('menu_id');
            $title = $this->input->post('name');
            $desc = $this->input->post('desc');
            $active = $this->input->post('active');


            $data = array(
                'menu_id' => $menu_id,
                'name' => $title,
                'desc' => $desc,
                'seo' => seolink($title),
                'select' => $active,
            );



            $stepResult =  $this->Submenu_model->submenu_add($data);

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