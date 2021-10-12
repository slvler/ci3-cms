<?php

class Product_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function select_all()
    {
        $this->db->select('*');
        $query = $this->db->group_by("lang_id");
        $query = $this->db->get('product');
        return $query->result();
    }

    public function select_all_lang()
    {
        $this->db->select('*');
        $this->db->where('lang',$this->session->userdata('lang'));
        $query = $this->db->group_by("lang_id");
        $query = $this->db->get('product');
        return $query->result();
    }




    public function product_add($data = array())
    {
        $this->db->set('category_id', @$data['category_id']);
        $this->db->set('subcategory_id', @$data['subcategory_id']);
        $this->db->set('title', @$data['title']);
        $this->db->set('desc', @$data['desc']);
        $this->db->set('keywords', @$data['keywords']);
        $this->db->set('select', @$data['select']);
        $this->db->set('lang', @$data['lang']);
        $this->db->set('lang_id', @$data['lang_key']);
        $this->db->set('seo', @$data['seo']);

        $this->db->insert('product');

        return $data;
    }

    public function product_add_v1($data = array())
    {

        $this->db->set('category_id', @$data['category_id']);
        $this->db->set('subcategory_id', @$data['subcategory_id']);
        $this->db->set('lang', @$data['lang']);
        $this->db->set('lang_id', @$data['lang_key']);

        $this->db->insert('product');

        return $data;
    }

    public function product_select_one($id)
    {
        $this->db->select('lang_id');
        $this->db->where('id',$id);
        $record = $this->db->get('product');
        return $record->row();
    }

    public function product_lang_control($lang_id)
    {
        $this->db->select('*');
        $this->db->where('lang_id',$lang_id);
        $record = $this->db->get('product');
        return $record->result();
    }

    public function product_edit($where = array(), $data = array())
    {

        $this->db->where($where);
        $this->db->update('product',$data);

        return true;
    }

    public function select_all_nangroup($id)
    {
        $this->db->select('lang_id');
        $query = $this->db->where('id',$id);
        $query = $this->db->get('product');
        return $query->row();
    }

    public function select_lang_record($lang)
    {
        $this->db->select('*');
        $query = $this->db->where('lang_id',$lang);
        $query = $this->db->get('product');
        return $query->result();
    }




}