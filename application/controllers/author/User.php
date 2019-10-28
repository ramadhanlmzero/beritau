<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        if ($this->session->userdata('role') != "Admin") {
            show_404();
        }
        else {
            $data['users'] = $this->User_model->get();
            $this->load->view('user/index', $data);            
        }
    }

    public function create()
    {
        if ($this->session->userdata('role') != "Admin") {
            show_404();
        }
        else {
            $this->load->view('user/create');
        }
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
        redirect('author/user/index');
    }

    public function edit($id)
    {
        $data['user'] = $this->User_model->getById($id);
        $this->load->view('user/edit', $data);
    }

    public function update($id)
    {
        if (empty($_FILES["photo"]["name"])) {
            $data = [
                'name' => $this->input->post("name"),
                'email' => $this->input->post("email"),
                'password' => $this->input->post("password"),
                'role' => $this->input->post("role"),
                'updated_at' => timestamp("Y-m-d H:i:s"),
            ];
        } else {
            $data = [
                'name' => $this->input->post("name"),
                'email' => $this->input->post("email"),
                'password' => $this->input->post("password"),
                'photo' => $_FILES["photo"]["name"],
                'role' => $this->input->post("role"),
                'updated_at' => timestamp("Y-m-d H:i:s"),
            ];
            $imagepath = FCPATH . "storage\user";
            unlink($imagepath . "/" . $this->input->post("filename"));
            $config['upload_path'] = $imagepath;
            $config['file_name'] = $_FILES["photo"]["name"];
            $config['allowed_types'] = 'png|gif|jpg|jpeg';
            $config['max_size']    = '10000';
            $config['overwrite'] = true;
            $config['remove_spaces'] = FALSE;
            $this->load->library('upload', $config);
            $this->upload->do_upload("photo");
        }

        $this->User_model->update($data, $id);
        redirect('author/user/index');
    }

    public function delete($id)
    {
        $data['file'] = $this->User_model->getById($id);
        $filename = $data['file']->photo;
        $imagepath = FCPATH . "storage\user";
        unlink($imagepath . "/" . $filename);
        $this->User_model->delete($id);
        redirect('author/user/index');
    }
}