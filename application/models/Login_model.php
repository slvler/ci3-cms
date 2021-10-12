<?php

class Login_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function Select_all(){
        $this->db->select('*');
        $this->db->where('active',"1");
        $record = $this->db->get('login');
        return $record->result();
    }



}