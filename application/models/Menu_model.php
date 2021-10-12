<?php

class Menu_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function select_all()
    {
        $this->db->select('*');
        $query = $this->db->get('menu');
        return $query->result();
    }

    public function select_join()
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->join('submenu', 'submenu.menu_id = menu.id');
        $query = $this->db->get();
        return $query->result();
    }


    public function menu_add($data = array())
    {
        $this->db->set('name', $data['name']);
        $this->db->set('desc', $data['desc']);
        $this->db->set('select', $data['active']);
        $this->db->insert('menu');

        return true;
    }




}