<?php

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Language_model','Category_model','Product_model','Subcategory_model','Menu_model','Submenu_model']);

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

        $data["title"] = "Product Listing Page | qwerty - CMS";
        $data["subtitle"] = "Product Listing Page";
        $data["breadcrumb"] = "Product";

        $data["select_all"] = $this->Menu_model->select_join();


        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();

        $data["lang"] =  $this->Language_model->select_all();
        $data["result"] =  $this->Product_model->select_all();


        $this->load->view('back/product/listingpage',$data);

    }

    public function add()
    {
        $data["title"] = "Product Add Page | qwerty - CMS";
        $data["subtitle"] = "Product Add Page";
        $data["breadcrumb"] = "Product";


        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();


        $data["category"] = $this->Category_model->select_all();
        $data["lang"] =  $this->Language_model->select_all();


        $this->load->view('back/product/addpage',$data);
    }

    public function category_select(){
        if ($_POST){

            $id = $this->input->post('id');



            $this->form_validation->set_rules("id", 'Title', 'required');

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

            $stepOne = $this->Subcategory_model->subcategory_where_json($id);

           $stepId = [];
           $stepTitle = [];

           foreach ($stepOne as $step){
               array_push($stepId,$step->id);
           }

            foreach ($stepOne as $stepV){
                array_push($stepTitle,$stepV->title);
            }

            $arr3 = array_combine($stepId, $stepTitle);


         echo json_encode($arr3);

        }

    }

    public function add_form()
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

            $langArr = $this->input->post('lang');

            $categoryArr = $this->input->post('category');
            $category = current($categoryArr);

            $subcategoryArr = $this->input->post('subcategory');
            $subcategory = current($subcategoryArr);




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
                'category_id' => $category,
                'subcategory_id' => $subcategory,
                'title' => $title,
                'desc' => $desc,
                'keywords' => $keywords,
                'select' => $select,
                'lang' => $langArr,
                'lang_key' => $lang_id,
                'seo' => seolink($title)
            );


            foreach ($dataLang as $dt){
                if ($dt == $langArr){
                    $stepResult =  $this->Product_model->product_add($data);
                }else{

                    $data = array(
                        'category_id' => $category,
                        'subcategory_id' => $subcategory,
                        'lang' => $dt,
                        'lang_key' => $lang_id
                    );

                    $stepResult =  $this->Product_model->product_add_v1($data);
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

    public function edit($id){

        $stepOne = $this->Product_model->product_select_one($id);
        $result = $this->Product_model->product_lang_control($stepOne->lang_id);
        $lang = $this->Language_model->select_all();

        $category = $this->Category_model->select_all();
        $subcategory = $this->Subcategory_model->select_all();


        $data["breadcrumb"] = "Product";
        $data["menu"] = $this->Menu_model->select_all();
        $data["select_join"] = $this->Menu_model->select_join();
        $data["submenu"] = $this->Submenu_model->select_all_index();




        $data["subcategory"] = $subcategory;
        $data["category"] = $category;
        $data["lang"] = $lang;
        $data["result"] = $result;
        $data["title"] = "Product Update Page | qwerty - CMS";
        $data["subtitle"] = "Product Update Page";



        $this->load->view('back/product/editpage',$data);


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

            $categoryJson = $this->input->post('category');
            $category = current($categoryJson);

            $subcategoryJson = $this->input->post('subcategory');
            $subcategory = current($subcategoryJson);

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
            $this->form_validation->set_rules('subcategory[]', 'Subcategory', 'required');

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
                'category_id' => $category,
                'subcategory_id' => $subcategory,
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
                    $stepResult =  $this->Product_model->product_edit($where,$data);

                }else{

                    $where = array(
                        "lang" => $dt,
                        'lang_id' => $this->input->post('lang_id')
                    );

                    $data = array(
                        'category_id' =>  $category,
                        'subcategory_id' => $subcategory
                    );

                    $stepResult =  $this->Product_model->product_edit($where,$data);


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

        $stepOne = $this->Product_model->select_all_nangroup($id);
        $stepLang = $stepOne->lang_id;
        $stepId = $this->Product_model->select_lang_record($stepLang);

        foreach ($stepId as $ite){
            $where = array(
                'id' => $ite->id
            );
            $data = array(
                'select' => $stepTwo
            );

            $stepResult = $this->Product_model->product_edit($where,$data);

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

}