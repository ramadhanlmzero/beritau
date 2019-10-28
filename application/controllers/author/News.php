<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("News_model");
        $this->load->model("Category_model");
        $this->load->helper("slug");
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('auth/login');
        }
        if ($this->session->userdata('role') == "Pembaca") {
            show_404();
        }
    }

    public function index()
    {
        if ($this->session->userdata('role') == "Admin") {
            $data['news'] = $this->News_model->get();
            $this->load->view('news/index', $data);
        }
        else if ($this->session->userdata('role') == "Penulis") {
            $data['news'] = $this->News_model->getOnly($this->session->userdata('id'));
            $this->load->view('news/index', $data);
        }
    }

    public function trash()
    {
        if ($this->session->userdata('role') == "Admin") {
            $data['news'] = $this->News_model->getTrash();
            $this->load->view('news/trash', $data);
        } else if ($this->session->userdata('role') == "Penulis") {
            $data['news'] = $this->News_model->getTrashOnly($this->session->userdata('id'));
            $this->load->view('news/trash', $data);
        }
    }

    public function create()
    {
        $data['categories'] = $this->Category_model->get();
        $this->load->view('news/create', $data);
    }

    public function store()
    {
        $data = [
            'title' => $this->input->post("title"),
            'slug' => slug($this->input->post("title")),
            'content' => $this->input->post("content"),
            'image' => $_FILES["image"]["name"],
            'status' => $this->input->post("status"),
            'category_id' => $this->input->post("category_id"),
            'visitor_count' => 0,
            'created_by' => $this->session->userdata('id'),
            'created_at' => timestamp("Y-m-d H:i:s"),
            'updated_at' => timestamp("Y-m-d H:i:s"),
        ];

        $imagepath = FCPATH . "storage/news";

        $config['upload_path'] = $imagepath;
        $config['file_name'] = $_FILES["image"]["name"];
        $config['allowed_types'] = 'png|gif|jpg|jpeg';
        $config['max_size']    = '10000';
        $config['overwrite'] = true;
        $config['remove_spaces'] = FALSE;
        $this->load->library('upload', $config);
        $this->upload->do_upload("image");

        $this->News_model->save($data);
        redirect('author/news/index');
    }

    public function edit($id)
    {
        $data['categories'] = $this->Category_model->get();
        $data['news'] = $this->News_model->getById($id);
        $this->load->view('news/edit', $data);
    }

    public function update($id)
    {
        if (empty($_FILES["image"]["name"])) {
            $data = [
                'title' => $this->input->post("title"),
                'slug' => slug($this->input->post("title")),
                'content' => $this->input->post("content"),
                'status' => $this->input->post("status"),
                'category_id' => $this->input->post("category_id"),
                'visitor_count' => 0,
                'created_by' => $this->session->userdata('id'),
                'updated_at' => timestamp("Y-m-d H:i:s"),
            ];
        } 
        else {
            $data = [
                'title' => $this->input->post("title"),
                'slug' => slug($this->input->post("title")),
                'content' => $this->input->post("content"),
                'image' => $_FILES["image"]["name"],
                'status' => $this->input->post("status"),
                'category_id' => $this->input->post("category_id"),
                'visitor_count' => 0,
                'created_by' => $this->session->userdata('id'),
                'updated_at' => timestamp("Y-m-d H:i:s"),
            ];
            $imagepath = FCPATH . "storage/news";
            unlink($imagepath . "/" . $this->input->post("filename"));
            $config['upload_path'] = $imagepath;
            $config['file_name'] = $_FILES["image"]["name"];
            $config['allowed_types'] = 'png|gif|jpg|jpeg';
            $config['max_size']    = '50000';
            $config['overwrite'] = true;
            $config['remove_spaces'] = FALSE;
            $this->load->library('upload', $config);
            $this->upload->do_upload("image");
        }

        $this->News_model->update($data, $id);
        redirect('author/news/index');
    }

    public function delete($id)
    {
        $data['file'] = $this->News_model->getById($id);
        $filename = $data['file']->image;
        $imagepath = FCPATH . "storage/news";
        unlink($imagepath . "/" . $filename);
        $this->News_model->delete($id);
        redirect('author/news/index');
    }

    public function softdelete($id)
    {
        $data['status'] = 0;
        $data['updated_at'] = timestamp("Y-m-d H:i:s");
        $this->News_model->update($data, $id);
        redirect('author/news/index');
    }

    public function restore($id)
    {
        $data['status'] = 2;
        $data['updated_at'] = timestamp("Y-m-d H:i:s");
        $this->News_model->update($data, $id);
        redirect('author/news/trash');
    }
}
