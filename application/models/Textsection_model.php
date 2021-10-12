<?php

class Textsection_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function select_all()
    {
        $this->db->select('*');
        $query = $this->db->get('text_section');

        return $query->result();
    }


}