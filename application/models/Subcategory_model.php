<?php

class Subcategory_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function select_all()
    {
        $this->db->select('*');
        $query = $this->db->group_by("lang_id");
        $query = $this->db->get('subcategory');

        return $query->result();
    }

    public function select_all_nangroup($id)
    {
        $this->db->select('lang_id');
        $query = $this->db->where('id',$id);
        $query = $this->db->get('subcategory');
        return $query->row();
    }


    public function subcategory_where_json($id)
    {

        $SQL = "SELECT id,title,lang_id FROM subcategory WHERE JSON_EXTRACT(category_id, '$.id') = ".$id." GROUP BY lang_id";
        $query = $this->db->query($SQL);

        return $query->result();
    }

    public function select_all_where($id)
    {
        $this->db->select('*');
        $query = $this->db->where('category_id',$id);
        $query = $this->db->get('subcategory');
        return $query->result();
    }


    public function select_lang_record($lang)
    {
        $this->db->select('*');
        $query = $this->db->where('lang_id',$lang);
        $query = $this->db->get('subcategory');
        return $query->result();
    }

    public function subcategory_add($data = array())
    {
        $this->db->set('title', @$data['a']);
        $this->db->set('desc', @$data['b']);
        $this->db->set('keywords', @$data['c']);
        $this->db->set('select', @$data['d']);
        $this->db->set('lang', @$data['e']);
        $this->db->set('lang_id', @$data['f']);
        $this->db->set('category_id', @$data['g']);
        $this->db->set('seo', @$data['seo']);

        $this->db->insert('subcategory');

        return $data;
    }

    public function subcategory_add_v1($data = array())
    {

        $this->db->set('lang', $data['e']);
        $this->db->set('lang_id', $data['f']);
        $this->db->set('category_id', $data['g']);
        $this->db->insert('subcategory');

        return $data;
    }

    public function subcategory_select_one($id)
    {
        $this->db->select('lang_id');
        $this->db->where('id',$id);
        $record = $this->db->get('subcategory');
        return $record->row();
    }

    public function subcategory_lang_control($lang_id)
    {
        $this->db->select('*');
        $this->db->where('lang_id',$lang_id);
        $record = $this->db->get('subcategory');
        return $record->result();
    }

    public function subcategory_edit($where = array(), $data = array())
    {

        $this->db->where($where);
        $this->db->update('subcategory',$data);

        return true;
    }



    public function subcategory_delete($data = array())
    {
        $this->db->where($data);
        $this->db->delete('subcategory');

        return true;
    }

    public function subcategory_active($where = array(), $data = array())
    {

        $this->db->where($where);
        $this->db->update('subcategory',$data);

        return true;
    }



}