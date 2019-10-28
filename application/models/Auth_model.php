<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    private $_table = "users";

    public function validate($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        return $this->db->get($this->_table);
    }
}
