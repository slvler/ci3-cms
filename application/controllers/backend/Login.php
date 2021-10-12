<?php

class Login extends CI_Controller {



    public function __construct()
    {
        parent::__construct();

        $this->load->model("Login_model");

        $this->load->helper(["url","form","basic","string"]);
        $this->load->library(['form_validation','session']);
    }

    public function index() {


        $this->load->view('back/login');

    }

    public function accept(){
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


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
        }else{

            $email =$this->input->post('email');
            $password = $this->input->post('password');

           $result = $this->Login_model->select_all();

           foreach ($result as $item){
               if ($item->email == $email && $item->password == md5($password)){


                   $newdata = array(
                       'email'  => $item->email,
                       'username'     => $item->name,
                       'active' => $item->active
                   );



                   $this->session->set_userdata($newdata);

                       $result = [
                           'status' => $item->email,
                           'active' => 'yes',
                           'text' => "Errors Record",
                           'url' => 'admin'
                       ];
                   $stepData = json_encode($result);
                   echo $stepData;
                   exit;

               }
           }

            $result = [
                'status' => 'Error Form',
                'active' => 'no',
                'text' => "Errors Record"
            ];


            $stepData = json_encode($result);
            echo $stepData;
            exit;

        }

    }


    public function logout(){
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();

        redirect('login');
    }


}


?>