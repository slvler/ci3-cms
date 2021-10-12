<?php

class Submenu_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }
    public function select_all($id)
    {
        $this->db->select('*');
        $query = $this->db->where('menu_id',$id);
        $query = $this->db->get('submenu');

        return $query->result();
    }

    public function select_all_index()
    {
        $this->db->select('*');
        $query = $this->db->get('submenu');

        return $query->result();
    }


    public function submenu_add($data = array())
    {
        $this->db->set('menu_id',$data['menu_id']);
        $this->db->set('submenu_name', $data['name']);
        $this->db->set('submenu_desc', $data['desc']);
        $this->db->set('submenu_seo', $data['seo']);
        $this->db->set('submenu_select', $data['select']);
        $this->db->insert('submenu');

        return true;
    }

}