<?php
class Category_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function all()
    {
        $this->db->select('*');
        $query = $this->db->get('category');
        return $query->result();

    }

    public function select_all()
    {
        $this->db->select('*');
        $query = $this->db->group_by("lang_id");
        $query = $this->db->get('category');
        return $query->result();
    }

    public function select_all_nangroup($id)
    {
        $this->db->select('lang_id');
        $query = $this->db->where('id',$id);
        $query = $this->db->get('category');
        return $query->row();
    }



    public function select_lang_record($lang)
    {
        $this->db->select('*');
        $query = $this->db->where('lang_id',$lang);
        $query = $this->db->get('category');
        return $query->result();
    }

    public function category_delete($data = array())
    {
        $this->db->where($data);
        $this->db->delete('category');

        return true;
    }






    public function category_add($data = array())
    {
        $this->db->set('title', $data['a']);
        $this->db->set('desc', $data['b']);
        $this->db->set('keywords', $data['c']);
        $this->db->set('select', $data['d']);
        $this->db->set('lang', $data['e']);
        $this->db->set('lang_id', $data['f']);
        $this->db->set('seo', $data['seo']);

        $this->db->insert('category');

        return true;
    }


    public function category_add_v1($data = array())
    {

        $this->db->set('lang', $data['e']);
        $this->db->set('lang_id', $data['f']);

        $this->db->insert('category');

        return true;
    }

    public function active_edit($where = array(), $data= array())
    {

        $this->db->where($where);
        $this->db->update('category',$data);

        return true;
    }

    public function category_select_one($id)
    {
        $this->db->select('lang_id');
        $this->db->where('id',$id);
        $record = $this->db->get('category');
        return $record->row();
    }

    public function category_lang_control($lang_id)
    {
        $this->db->select('*');
        $this->db->where('lang_id',$lang_id);
        $record = $this->db->get('category');
        return $record->result();
    }



    public function category_lang_id_control($lang_id)
    {
        $this->db->select('*');
        $this->db->where('lang_id',$lang_id);
        $record = $this->db->get('category');
        return $record->row();
    }

    public function category_edit($where = array(), $data = array())
    {

        $this->db->where($where);
        $this->db->update('category',$data);

        return true;
    }



    public function edit_record($real_url, $seo_url)
    {
        $data = array( 'seo_url' =>	$seo_url );
        $this->db->where('real_url',$real_url);
        $this->db->update('routes',$data);

        return true;
    }

    public function delete_seo_url_record($real_url)
    {
        $this->db->where('real_url', $real_url);
        $this->db->delete('routes');

        return true;
    }

    public function get_seo_url_record($real_url)
    {
        $this->db->select('*');
        $this->db->where('real_url',$real_url);
        $record = $this->db->get('routes');
        return $record->row();
    }

    public function get_real_url_record($seo_url)
    {
        $this->db->select('*');
        $this->db->where('seo_url',$seo_url);
        $record = $this->db->get('routes');
        return $record->row();
    }
}