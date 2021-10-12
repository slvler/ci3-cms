<?php

class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model(['Category_model','Subcategory_model','Language_model','Media_model','Menu_model','Submenu_model']);

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

        $data["title"] = "Category Listing Page | qwerty - CMS";
        $data["subtitle"] = "Category Listing Page";
        $data["breadcrumb"] = "Category";

        $data["lang"] =  $this->Language_model->select_all();
        $data["result"] =  $this->Category_model->select_all();

        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();


        $this->load->view('back/category/listingpage',$data);

    }

    public function add(){


        $data["title"] = "Category Add Page | qwerty - CMS";
        $data["subtitle"] = "Category Add Page";

        $data["breadcrumb"] = "Category";

        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();

        $data["lang"] =  $this->Language_model->select_all();

        $this->load->view('back/category/addpage',$data);
    }

    public function add_form(){
        if ($_POST){

            $titleArr = array_values($this->input->post('title'));
            $title = current($titleArr);

            $descArr = array_values($this->input->post('desc'));
            $desc = current($descArr);

            $keywordsArr = array_values($this->input->post('keywords'));
            $keywords = current($keywordsArr);

            $selectArr = array_values($this->input->post('select'));
            $select = current($selectArr);

            $langArr = $this->input->post('lang');



            $t = 'title'.'['.$langArr.']';
            $d = 'desc'.'['.$langArr.']';
            $k = 'keywords'.'['.$langArr.']';
            $s = 'select'.'['.$langArr.']';
            $l =  ['.$langArr.'];



            $this->form_validation->set_rules($t, 'Title', 'required');
            $this->form_validation->set_rules($d, 'Desc', 'required');
            $this->form_validation->set_rules($k, 'Keywords', 'required');
            $this->form_validation->set_rules($s, 'Select', 'required');
            $this->form_validation->set_rules($l, 'bakim', 'required');

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

            $lang =  $this->Language_model->select_all();

            $dataLang = [];
            foreach ($lang as $la){
                array_push($dataLang, $la->lang_key);
            }

            $lang_id = base64_encode(random_string('alnum', 16));

            $data = array(
                'a' => $title,
                'b' => $desc,
                'c' => $keywords,
                'd' => $select,
                'e' => $langArr,
                'f' => $lang_id,
                'seo' => seolink($title)
            );


            foreach ($dataLang as $dt){
                if ($dt == $langArr){
                    $stepResult =  $this->Category_model->category_add($data);
                }else{

                    $data = array(
                        'e' => $dt,
                        'f' => $lang_id
                    );

                    $stepResult =  $this->Category_model->category_add_v1($data);
                }
            }

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
    public function active()
    {


        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('select', 'Select', 'required');


        $this->form_validation->set_message('required', '%s not empty.');
        if ($this->form_validation->run() == FALSE)
        {

            $result = [
                'status' => 'Error Form',
                'active' => 'warning',
                'text' => validation_errors()
            ];

            echo json_encode($result);

        }else{


            $id = $this->input->post('id');
            $stepOne = $this->input->post('select');
            $stepTwo = "";
            if ($stepOne == "1"){

                $stepTwo = "0";
            }else{
                $stepTwo = "1";
            }

            $stepOne = $this->Category_model->select_all_nangroup($id);
            $stepLang = $stepOne->lang_id;
            $stepId = $this->Category_model->select_lang_record($stepLang);


            foreach ($stepId as $ite){
                $where = array(
                    'id' => $ite->id
                );
                $data = array(
                    'select' => $stepTwo
                );

                $stepResult  = $this->Category_model->active_edit($where, $data);

            }

            if ($stepResult){
                $result = [
                    'status' => 'Active Form',
                    'active' => 'ok',
                    'text' => "Success Active"
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

    public function edit($id){

        $stepOne = $this->Category_model->category_select_one($id);
        $result = $this->Category_model->category_lang_control($stepOne->lang_id);
        $lang = $this->Language_model->select_all();

        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();

        $data["breadcrumb"] = "Category";
        $data["lang"] = $lang;
        $data["result"] = $result;
        $data["title"] = "Category Update Page | qwerty - CMS";
        $data["subtitle"] = "Category Update Page";

        $this->load->view('back/category/editpage',$data);


    }

    public function edit_form(){
        if ($_POST){

            $titleArr = array_values($this->input->post('title'));
            $title = current($titleArr);

            $descArr = array_values($this->input->post('desc'));
            $desc = current($descArr);

            $keywordsArr = array_values($this->input->post('keywords'));
            $keywords = current($keywordsArr);

            $selectArr = array_values($this->input->post('select'));
            $select = current($selectArr);

            $langArr = $this->input->post('lang');
            $id = $this->input->post('id');



            $t = 'title'.'['.$langArr.']';
            $d = 'desc'.'['.$langArr.']';
            $k = 'keywords'.'['.$langArr.']';
            $s = 'select'.'['.$langArr.']';
            $l =  ['.$langArr.'];



            $this->form_validation->set_rules($t, 'Title', 'required');
            $this->form_validation->set_rules($d, 'Desc', 'required');
            $this->form_validation->set_rules($k, 'Keywords', 'required');
            $this->form_validation->set_rules($s, 'Select', 'required');
            $this->form_validation->set_rules($l, 'bakim', 'required');

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


            $where = array(
                'id' => $id
            );

            $data = array(
                'title' => $title,
                'desc' => $desc,
                'keywords' => $keywords,
                'select' => $select,
                'lang' => $langArr,
                'seo' => seolink($title),
            );


            $stepResult =  $this->Category_model->category_edit($where,$data);


            if ($stepResult){
                $result = [
                    'status' => 'Update Form',
                    'active' => 'ok',
                    'text' => "Success Update"
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

    public function delete(){


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

        $id = $this->input->post('id');

        $data = array(
            'id' => $id
        );

        $stepOne = $this->Category_model->select_all_nangroup($id);
        $stepLang = $stepOne->lang_id;
        $stepId = $this->Category_model->select_lang_record($stepLang);

        foreach ($stepId as $ite){
            $data = array(
                'id' => $ite->id
            );
            $stepResult = $this->Category_model->category_delete($data);
        }
        if ($stepResult){
            $result = [
                'status' => 'Update Form',
                'active' => 'ok',
                'text' => "Success Delete"
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

    public function image($id){

        $media = $this->Media_model->select_media_record($id);

        $stepOne = $this->Category_model->select_all_nangroup($id);
        $result = $this->Category_model->select_lang_record($stepOne->lang_id);
        $lang = $this->Language_model->select_all();
        $category = $this->Category_model->select_all();

        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();
        $data["breadcrumb"] = "Category";
        $data["media"] = $media;
        $data["category"] = $category;
        $data["result"] = $result;
        $data["lang"] = $lang;
        $data["title"] = "Category Image Page | qwerty - CMS";
        $data["subtitle"] = "Category Image Page";
        $data["downtitle"] = "Category Image list";


        $this->load->view('back/category/imagepage',$data);

    }

    public function image_form($id){


        $file_name =   $_FILES['file']['name'];
        $stepOne = explode(".",$file_name);
        $dosyaturu = end($stepOne);
        $stepTwo =  seolink(trim($file_name));
        $ornek = str_replace($dosyaturu, " ", $stepTwo);
        $stepThree =  trim($ornek).".".$dosyaturu;


        $config['upload_path'] = './assets/upload';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $stepThree;
        $config['max_width']            = 6000; // 6000px you can set the value you want
        $config['max_height']           = 6000; // 6000px
        $config['max_size']             = 10024; // 10mb you can set the value you want

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());

            $result = [
                'status' => 'Error Form',
                'active' => 'warning',
                'text' => validation_errors()
            ];

            $stepData = json_encode($result);
            echo $stepData;
            exit;


        }else{

            $data = array('upload_data' => $this->upload->data());
            $filePath =  $data['upload_data']['file_name'];

            $data = array(
                'product_type' => 0,
                'product_id' => $id,
                'madia_name' => $file_name,
                'media_path' => "assets/upload"."/".$filePath,
                'media_active' => "0"
            );

            $stepResult =  $this->Media_model->media_add($data);

            if ($stepResult){
                $result = [
                    'status' => 'Active Form',
                    'active' => 'ok',
                    'text' => "Success Active"
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
            exit;

        }







    }

    public function image_head(){


        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('select', 'Select', 'required');


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

        $id = $this->input->post('id');
        $stepSelect = $this->input->post('select');


        $where = array(
            'id' => $id
        );
        $data = array(
            'media_active' => $stepSelect
        );

        $stepResult = $this->Media_model->media_head($where,$data);

        if ($stepResult){
            $result = [
                'status' => 'Update Active',
                'active' => 'ok',
                'text' => "Success Update"
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

    public function image_delete(){


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

        $id = $this->input->post('id');


        $stepMedia = $this->Media_model->select_media_record_one($id);

        $prev_file_path = $stepMedia->media_path;

        if (file_exists($prev_file_path)){
            unlink($prev_file_path);
        }

        $stepResult = $this->Media_model->delete_media_record($id);

        if ($stepResult){
            $result = [
                'status' => 'Update Form',
                'active' => 'ok',
                'text' => "Success Delete Image"
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


?>