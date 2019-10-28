<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Front extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("News_model");
    }

    public function index()
    {
        $data['news'] = $this->News_model->all();
        $this->load->view('index', $data);
    }

    function detail($slug)
    {
        $exist = $this->News_model->all($slug);
        if ($exist)
        {
            $data['news'] = $exist;
            $category = $data['news']->category;
            $id = $data['news']->id;
            $data['relatednews'] = $this->News_model->getLimit(3, $category, $id);
            $this->load->view('detail', $data);
        }
        else {
            show_404();
        }
    }
}
