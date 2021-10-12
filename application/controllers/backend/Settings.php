<?php

class Settings extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Language_model');
        $this->load->model('Settings_model');
        $this->load->model('Menu_model');
        $this->load->model('Submenu_model');
        $this->load->model('Textsection_model');

        $this->load->helper(["url","form","basic","string"]);
        $this->load->library(['form_validation','session']);


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

        $data["title"] = "Settings Listing Page | qwerty - CMS";
        $data["subtitle"] = "Settings Listing Page";

        $data["breadcrumb"] = "Settings";

        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();

        $data["resultSettings"] = $this->Settings_model->select_all();
        $data["resultLanguage"] =  $this->Language_model->select_all();

        $this->load->view('back/settings/listingpage',$data);

    }

    public function lang_add_form()
    {

        $lang = $this->input->post('language');
        $langKey = $this->input->post('langkey');
        $select = $this->input->post('select');

    if ($lang != "" && $langKey != "" && $select != ""){

        $data = array(
            'language' => $lang,
            'lang_key' => $langKey,
            'select' => $select
        );

       $result = $this->Language_model->settings_add($data);

        if ($result){
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
        //$stepOne =$this->Category_model->category_lang_id_control($res);

        $stepData = json_encode($result);
        echo $stepData;


    }else{
        $result = [
            'status' => 'Error Form',
            'active' => 'warning',
            'text' => "Errors Record"
        ];

        $stepData = json_encode($result);
        echo $stepData;
    }
    }

    public function lang_edit_form()
    {
        $lang = $this->input->post('language');
        $langKey = $this->input->post('langkey');
        $id = $this->input->post('id');

        if ($lang != "" && $langKey != "" && $id != "") {

            $data = array(
                'lang' => $lang,
                'lang_key' => $langKey
            );
            $where = array(
                'id' => $id
            );

            $result = $this->Language_model->settings_edit($where, $data);

            if ($result){
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

        }else{

            $result = [
                'status' => 'Error Form',
                'active' => 'warning',
                'text' => "Errors Record"
            ];

            $stepData = json_encode($result);
            echo $stepData;


        }

    }

    public function gallery_add(){

        //$file = $_FILES['fileName'];
        //$name = $file['name'];
        //$path = $file['tmp_name'];


           $filename = $this->input->post('name');

            $file_name =   $_FILES['fileName']['name'];
            $stepOne = explode(".",$file_name);
            $dosyaturu = end($stepOne);
            $stepTwo =  seolink(trim($file_name));
            $ornek = str_replace($dosyaturu, " ", $stepTwo);
            $stepThree =  trim($ornek).".".$dosyaturu;

        $config['upload_path'] = './assets/back/uploads';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $stepThree;
        $config['max_width']            = 6000; // 6000px you can set the value you want
        $config['max_height']           = 6000; // 6000px
        $config['max_size']             = 10024; // 10mb you can set the value you want

        $this->load->library('upload', $config);


        if ( ! $this->upload->do_upload('fileName'))
        {
            $error = array('error' => $this->upload->display_errors());


            $result = [
                'status' => 'Error Form',
                'active' => 'warning',
                'text' => "Error"
            ];

            $stepData = json_encode($result);
            echo $stepData;

        }
        else
        {


            $data = array('upload_data' => $this->upload->data());
            $filePath =  $data['upload_data']['file_name'];


            if ($this->input->post('select') == "0"){
                $data = array(
                    'logo_name' => $this->input->post('name'),
                    'logo' => "assets/back/uploads"."/".$filePath
                );
            }else if ($this->input->post('select') == "1") {
                $data = array(
                    'logo_banner_name' => $this->input->post('name'),
                    'logo_banner' => "assets/back/uploads"."/".$filePath
                );
            }else{
                $data = array(
                    'fav_icon_name' => $this->input->post('name'),
                    'fav_icon' => "assets/back/uploads"."/".$filePath
                );
            }

            $where = array(
                'id' => $this->input->post('id')
            );

            $stepResult =  $this->Settings_model->settings_edit($where,$data);

            if ($stepResult){
                $result = [
                    'status' => 'Update Form',
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

    public function settings_edit()
    {

        $this->form_validation->set_rules('title', 'Username', 'required');
        $this->form_validation->set_rules('desc', 'Desc', 'required');
        $this->form_validation->set_rules('keywords', 'Keywords', 'required');
        $this->form_validation->set_rules('analytics', 'Analytics', 'required');
        $this->form_validation->set_rules('metrica', 'Metrica', 'required');
        $this->form_validation->set_rules('select', 'Select', 'required');
        $this->form_validation->set_rules('id', 'Id', 'required');

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
        else
        {

            $data = array(
                'title' => $this->input->post('title'),
                'desc' => $this->input->post('desc'),
                'keywords' => $this->input->post('keywords'),
                'analytics' => $this->input->post('analytics'),
                'metrica' => $this->input->post('metrica'),
                'status' => $this->input->post('select'),
                'smtp_host' => $this->input->post('host'),
                'smtp_port' => $this->input->post('port'),
                'smtp_mail' => $this->input->post('mail'),
                'smtp_pass' => $this->input->post('pass')
            );

            $where = array(
              'id' => $this->input->post('id')
            );

          $stepResult =  $this->Settings_model->settings_edit($where,$data);

            if ($stepResult){
                $result = [
                    'status' => 'Update Form',
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
            //$stepOne =$this->Category_model->category_lang_id_control($res);

            $stepData = json_encode($result);
            echo $stepData;


        }



    }


    public function text_section()
    {
        $data["title"] = "Text Section Listing Page | qwerty - CMS";
        $data["subtitle"] = "Text Section Listing Page";

        $data["breadcrumb"] = "Text Section";

        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();

        $data["resultSettings"] = $this->Settings_model->select_all();
        $data["text"] = $this->Textsection_model->select_all();
        $data["resultLanguage"] =  $this->Language_model->select_all();

        $this->load->view('back/settings/textsection',$data);

    }


}


?>