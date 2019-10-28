<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "users";
    private $_primarykey = "id";

    public function get()
    {
        return $this->db->from($this->_table)->order_by("updated_at", "desc")->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, [$this->_primarykey => $id])->row();
    }

    public function find($id, $record)
    {
        return $this->db->select($record)->where($this->_primarykey, $id)->get($this->_table)->result_array();
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
