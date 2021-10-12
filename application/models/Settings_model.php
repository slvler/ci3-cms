<?php

class Settings_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Select_all(){
        $this->db->select('*');
        $this->db->where('id',"1");
        $record = $this->db->get('settings');
        return $record->row();
    }

    public function settings_edit($where = array(), $data = array())
    {

        $this->db->where($where);
        $this->db->update('settings',$data);

        return true;
    }



}
    ?>