<?php

class Subcategory extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model(['Subcategory_model','Language_model','Category_model','Media_model','Menu_model','Submenu_model']);

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
        $data["title"] = "Subategory Listing Page | qwerty - CMS";
        $data["subtitle"] = "Subategory Listing Page";

        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();


        $data["breadcrumb"] = "Subategory";

        $data["lang"] =  $this->Language_model->select_all();
        $data["result"] =  $this->Subcategory_model->select_all();




        $this->load->view('back/subcategory/listingpage',$data);
    }

    public function add()
    {
        $data["title"] = "Subategory Add Page | qwerty - CMS";
        $data["subtitle"] = "Subategory Add Page";
        $data["breadcrumb"] = "Subategory";
        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();



        $data["category"] = $this->Category_model->select_all();
        $data["lang"] =  $this->Language_model->select_all();


        $this->load->view('back/subcategory/addpage',$data);
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

            $categoryJson = $this->input->post('category');
            $category = json_encode($categoryJson);




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
            $this->form_validation->set_rules('category[]', 'Category', 'required');

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

            $cat = implode(",",$categoryJson);
            $stuff = array('id' => $cat);
            $catArr =  json_encode($stuff);
            $data = array(
                'a' => $title,
                'b' => $desc,
                'c' => $keywords,
                'd' => $select,
                'e' => $langArr,
                'f' => $lang_id,
                'g' => $catArr,
                'seo' => seolink($title)
            );


            foreach ($dataLang as $dt){
                if ($dt == $langArr){
                    $stepResult =  $this->Subcategory_model->subcategory_add($data);
                }else{

                    $data = array(
                        'e' => $dt,
                        'f' => $lang_id,
                        'g' => $catArr
                    );

                    $stepResult =  $this->Subcategory_model->subcategory_add_v1($data);
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

    public function edit($id)
    {

        $stepOne = $this->Subcategory_model->subcategory_select_one($id);
        $result = $this->Subcategory_model->subcategory_lang_control($stepOne->lang_id);
        $lang = $this->Language_model->select_all();
        $category = $this->Category_model->select_all();

        $data["breadcrumb"] = "Subategory";
        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();

        $data["category"] = $category;
        $data["result"] = $result;
        $data["lang"] = $lang;
        $data["title"] = "Subcategory Update Page | qwerty - CMS";
        $data["subtitle"] = "Subcategory Update Page";


        $this->load->view('back/subcategory/editpage',$data);

    }

    public function edit_form()
    {

        if ($_POST){

            $titleArr = array_values($this->input->post('title'));
            $title = current($titleArr);

            $descArr = array_values($this->input->post('desc'));
            $desc = current($descArr);

            $keywordsArr = array_values($this->input->post('keywords'));
            $keywords = current($keywordsArr);

            $selectArr = array_values($this->input->post('select'));
            $select = current($selectArr);

            $categoryJson = $this->input->post('category');
            $category = json_encode($categoryJson);

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
            $this->form_validation->set_rules('category[]', 'Category', 'required');

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



            $cat = implode(",",$categoryJson);
            $stuff = array('id' => $cat);
            $catArr =  json_encode($stuff);

            $data = array(
                'title' => $title,
                'category_id' => $catArr,
                'desc' => $desc,
                'keywords' => $keywords,
                'select' => $select,
                'lang' => $langArr,
                'seo' => seolink($title),
            );




            $lang =  $this->Language_model->select_all();

            $dataLang = [];
            foreach ($lang as $la){
                array_push($dataLang, $la->lang_key);
            }



            foreach ($dataLang as $dt){
                if ($dt == $langArr){
                    $stepResult =  $this->Subcategory_model->subcategory_edit($where,$data);




                }else{

                        $where = array(
                            "lang" => $dt,
                            'lang_id' => $this->input->post('lang_id')
                        );

                        $data = array(
                            'category_id' =>  $catArr
                        );

                        $stepResult =  $this->Subcategory_model->subcategory_edit($where,$data);


                }
            }


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

        $stepOne = $this->Subcategory_model->select_all_nangroup($id);
        $stepLang = $stepOne->lang_id;
        $stepId = $this->Subcategory_model->select_lang_record($stepLang);

        foreach ($stepId as $ite){
            $data = array(
                'id' => $ite->id
            );
            $stepResult = $this->Subcategory_model->subcategory_delete($data);
        }
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

    public function active(){


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
        $stepTwo = "";
        if ($stepSelect == "1"){

            $stepTwo = "0";
        }else{
            $stepTwo = "1";
        }

        $stepOne = $this->Subcategory_model->select_all_nangroup($id);
        $stepLang = $stepOne->lang_id;
        $stepId = $this->Subcategory_model->select_lang_record($stepLang);

        foreach ($stepId as $ite){
            $where = array(
                'id' => $ite->id
            );
            $data = array(
              'select' => $stepTwo
            );

            $stepResult = $this->Subcategory_model->subcategory_active($where,$data);

        }

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

    public function image($id){


        $media = $this->Media_model->select_media_record($id);

        $stepOne = $this->Subcategory_model->subcategory_select_one($id);
        $result = $this->Subcategory_model->subcategory_lang_control($stepOne->lang_id);
        $lang = $this->Language_model->select_all();
        $category = $this->Category_model->select_all();

        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();

        $data["breadcrumb"] = "Subategory";

        $data["media"] = $media;
        $data["category"] = $category;
        $data["result"] = $result;
        $data["lang"] = $lang;
        $data["title"] = "Subcategory Image Page | qwerty - CMS";
        $data["subtitle"] = "Subcategory Image Page";
        $data["downtitle"] = "Subcategory Image list";


        $this->load->view('back/subcategory/imagepage',$data);
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
                'product_type' => 1,
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