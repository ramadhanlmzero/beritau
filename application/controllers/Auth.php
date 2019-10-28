<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Auth_model");
        $this->load->model("User_model");
    }

    public function login()
    {
        if ($this->session->userdata('logged_in') !== TRUE) {
            $this->load->view('auth/login');
        }
        else
        {
            redirect('author/news/index');            
        }
    }

    public function auth()
    {
        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        $validate = $this->Auth_model->validate($email, $password);
        if ($validate->num_rows() > 0) {
            $data  = $validate->row_array();
            $id  = $data['id'];
            $name  = $data['name'];
            $email = $data['email'];
            $role = $data['role'];
            $photo = $data['photo'];
            $sesdata = array(
                'id'  => $id,
                'name'  => $name,
                'email'     => $email,
                'role'     => $role,
                'photo'     => $photo,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($sesdata);
            if ($role === 'Penulis' || $role === 'Admin') {
                redirect('author/news/index');
            }
            else if ($role === 'Pembaca') {
                redirect(base_url());
            }
        } else {
            echo $this->session->set_flashdata('msg', 'Pastikan email / password anda benar !');
            redirect('auth/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function register($role)
    {
        $data['role'] = ucfirst($role);
        $this->load->view('auth/register', $data);
    }

    public function store()
    {
        $data = [
            'name' => $this->input->post("name"),
            'email' => $this->input->post("email"),
            'password' => $this->input->post("password"),
            'role' => $this->input->post("role"),
            'photo' => $_FILES["photo"]["name"],
            'created_at' => timestamp("Y-m-d H:i:s"),
            'updated_at' => timestamp("Y-m-d H:i:s"),
        ];

        $imagepath = FCPATH . "storage\user";

        $config['upload_path'] = $imagepath;
        $config['file_name'] = $_FILES["photo"]["name"];
        $config['allowed_types'] = 'png|gif|jpg|jpeg';
        $config['max_size']    = '10000';
        $config['overwrite'] = true;
        $config['remove_spaces'] = FALSE;
        $this->load->library('upload', $config);
        $this->upload->do_upload("photo");

        $this->User_model->save($data);
        redirect('author/news/index');
    }
}
