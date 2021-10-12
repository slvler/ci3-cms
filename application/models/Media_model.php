<?php

class Media_model extends CI_Model
{
    public function media_add($data = array())
    {
        $this->db->set('product_type', @$data['product_type']);
        $this->db->set('product_id', @$data['product_id']);
        $this->db->set('madia_name', @$data['madia_name']);
        $this->db->set('media_path', @$data['media_path']);
        $this->db->set('media_active', @$data['media_active']);

        $this->db->insert('media');

        return true;
    }

    public function select_media_record($id)
    {
        $this->db->select('*');
        $query = $this->db->where('product_id',$id);
        $query = $this->db->get('media');
        return $query->result();
    }

    public function select_media_record_one($id)
    {
        $this->db->select('*');
        $query = $this->db->where('id',$id);
        $query = $this->db->get('media');
        return $query->row();
    }

    public function delete_media_record($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('media');

        return true;
    }

    public function media_head($where = array(), $data = array())
    {

        $this->db->where($where);
        $this->db->update('media',$data);

        return true;
    }


}