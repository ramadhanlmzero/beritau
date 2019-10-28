<?php defined('BASEPATH') or exit('No direct script access allowed');

class News_model extends CI_Model
{
    private $_table = "news";
    private $_primarykey = "id";

    public function get()
    {
        $this->db->select($this->_table.".*, users.name as name, category.name as category");
        $this->db->from($this->_table);
        $this->db->join("users", "users.id = " . $this->_table . ".created_by", "LEFT");
        $this->db->join("category", "category.id = " . $this->_table . ".category_id", "LEFT");
        $this->db->where("(" . $this->_table . ".status = 1 or " . $this->_table . ".status = 2)");
        $this->db->order_by($this->_table . ".updated_at", "desc");
        return $this->db->get()->result();
    }

    public function getLimit($limit, $category, $id)
    {
        $this->db->select($this->_table.".*, users.name as name, category.name as category");
        $this->db->from($this->_table);
        $this->db->join("users", "users.id = " . $this->_table . ".created_by", "LEFT");
        $this->db->join("category", "category.id = " . $this->_table . ".category_id", "LEFT");
        $this->db->where($this->_table . ".status", 1);
        $this->db->where("category.name", $category);
        $this->db->where_not_in($this->_table . "." . $this->_primarykey, $id);
        $this->db->limit($limit);
        $this->db->order_by($this->_table . ".updated_at", "desc");
        return $this->db->get()->result();
    }

    public function getOnly($id)
    {
        $this->db->select($this->_table.".*, users.name as name, category.name as category");
        $this->db->from($this->_table);
        $this->db->join("users", "users.id = " . $this->_table . ".created_by", "LEFT");
        $this->db->join("category", "category.id = " . $this->_table . ".category_id", "LEFT");
        $this->db->where("(" . $this->_table . ".status = 1 or " . $this->_table . ".status = 2)");
        $this->db->where($this->_table . ".created_by", $id);
        $this->db->order_by($this->_table . ".updated_at", "desc");
        return $this->db->get()->result();
    }

    public function all($slug = null)
    {
        if (func_num_args() == 0)
        {
            $this->db->select($this->_table. ".*, users.name as name, category.name as category");
            $this->db->from($this->_table);
            $this->db->join("users", "users.id = " . $this->_table . ".created_by", "LEFT");
            $this->db->join("category", "category.id = " . $this->_table . ".category_id", "LEFT");
            $this->db->where($this->_table . ".status = 1");
            $this->db->order_by($this->_table . ".updated_at", "desc");
            return $this->db->get()->result();
        }
        if (func_num_args() == 1)
        {
            $this->db->select($this->_table . ".*, users.name as name, category.name as category");
            $this->db->from($this->_table);
            $this->db->join("users", "users.id = " . $this->_table . ".created_by", "LEFT");
            $this->db->join("category", "category.id = " . $this->_table . ".category_id", "LEFT");
            $this->db->where($this->_table . ".slug", $slug);
            $this->db->where($this->_table . ".status", 1);
            return $this->db->get()->row();
        }
    }

    public function getTrash()
    {
        $this->db->select($this->_table.".*, users.name");
        $this->db->from($this->_table);
        $this->db->join("users", "users.id = " . $this->_table . ".created_by");
        $this->db->where($this->_table . ".status = 0");
        $this->db->order_by($this->_table . ".updated_at", "desc");
        return $this->db->get()->result();
    }

    public function getTrashOnly($id)
    {
        $this->db->select($this->_table.".*, users.name");
        $this->db->from($this->_table);
        $this->db->join("users", "users.id = " . $this->_table . ".created_by");
        $this->db->where($this->_table . ".status = 0");
        $this->db->where($this->_table . ".created_by", $id);
        $this->db->order_by($this->_table . ".updated_at", "desc");
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        $this->db->select($this->_table . ".*, category.name as category");
        $this->db->from($this->_table);
        $this->db->join("category", "category.id = " . $this->_table . ".category_id", "LEFT");
        $this->db->where($this->_table . "." . $this->_primarykey, $id);
        return $this->db->get()->row();
    }

    public function find($id, $record)
    {
        return $this->db->select($record)->where($this->_primarykey, $id)->get($this->_table)->result_array();
    }

    public function findCondition($field, $value)
    {
        return $this->db->get_where($this->_table, [$field => $value])->result_array();
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
