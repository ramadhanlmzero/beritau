<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Category_model");
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('auth/login');
        }
        if ($this->session->userdata('role') != "Admin") {
            show_404();
        }
    }

    public function index()
    {
        $data['categories'] = $this->Category_model->get();
        $this->load->view('category/index', $data);
    }

    public function create()
    {
        $this->load->view('category/create');
    }

    public function store()
    {
        $data = [
            'name' => $this->input->post("name"),
            'created_at' => timestamp("Y-m-d H:i:s"),
            'updated_at' => timestamp("Y-m-d H:i:s"),
        ];
        $this->Category_model->save($data);
        redirect('author/category/index');
    }
    
    public function edit($id)
    {
        $data['category'] = $this->Category_model->getById($id);
        $this->load->view('category/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'name' => $this->input->post("name"),
            'updated_at' => timestamp("Y-m-d H:i:s"),
        ];
        $this->Category_model->update($data, $id);
        redirect('author/category/index');
    }

    public function delete($id)
    {
        $this->Category_model->delete($id);
        redirect('author/category/index');
    }
}
