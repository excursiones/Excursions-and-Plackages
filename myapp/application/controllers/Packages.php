<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Packages extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function create()
        {
            $this->load->model('packages_model');

            if (!empty($_POST)) {
                $data['name'] = $_POST['name'];
                $data['price'] = $_POST['price'];
                $data['excursions'] = $_POST['excursions'];
                $this->packages_model->create($data);
            }
        }

        public function edit()
        {
            $this->load->model('packages_model');

            if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
                $_PUT = file_get_contents('php://input');
                $_PUT = json_decode($_PUT, true);
                $data['name'] = $_PUT['name'];
                $data['price'] = $_PUT['price'];
                $data['state'] = $_PUT['state'];
                $data['id'] = $_PUT['id'];
                $this->packages_model->edit($data);
            }
        }

        public function delete()
        {
            $this->load->model('packages_model');

            if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
                $_DELETE = file_get_contents('php://input');
                $_DELETE = json_decode($_DELETE, true);
                $this->packages_model->delete($_DELETE['id']);
            }
        }

        public function get()
        {
            $this->load->model('packages_model');
            $data = $this->packages_model->get();
            echo json_encode($data);
        }

        public function get_by_id()
        {
            $this->load->model('packages_model');
            $data = $this->packages_model->get_by_id($_GET['id']);
            echo json_encode($data);
        }

        public function get_filtered_by_price()
        {
            $this->load->model('packages_model');
            $data = $this->packages_model->get_by_price($_GET['maximum_price']);
            echo json_encode($data);
        }
    }
