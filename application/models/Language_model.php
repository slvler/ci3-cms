<?php
class Language_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function select_all()
    {
        $this->db->select('*');
        $query = $this->db->get('language');
        return $query->result();

    }


    public function settings_add($data = array())
    {
        $this->db->set('lang', $data['language']);
        $this->db->set('lang_key', $data['lang_key']);
        $this->db->set('select', $data['select']);
        $this->db->insert('language');

        return true;
    }

    public function settings_edit($where = array(), $data = array())
    {

        $this->db->where($where);
        $this->db->update('language',$data);

        return true;
    }


}