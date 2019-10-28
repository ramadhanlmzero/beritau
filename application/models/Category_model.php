<?php defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    private $_table = "category";
    private $_primarykey = "id";

    public function get()
    {
        return $this->db->from($this->_table)->order_by("updated_at", "desc")->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, [$this->_primarykey => $id])->row();
    }

    public function save($data)
    {
        $this->db->set($this->_primarykey, 'UUID()', FALSE);
        $this->db->insert($this->_table, $data);
    }

    public function update($data, $id)
    {
        $this->db->update($this->_table, $data, [$this->_primarykey => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, [$this->_primarykey => $id]);
    }
}
