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

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = file_get_contents('php://input');
                $_POST = json_decode($_POST, true);

                $data['name'] = $_POST['name'];
                $data['price'] = $_POST['price'];
                $data['excursions'] = $_POST['excursions'];
                $id_package = $this->packages_model->create($data);
                $data['id'] = $id_package;
                echo json_encode($data);
            }
        }

        public function edit($packageId)
        {
            $this->load->model('packages_model');

            if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
                $_PUT = file_get_contents('php://input');
                $_PUT = json_decode($_PUT, true);
                $data['name'] = $_PUT['name'];
                $data['price'] = $_PUT['price'];
                $data['state'] = $_PUT['state'];
                $data['id'] = $packageId;
                $this->packages_model->edit($data);
                echo json_encode($data);
            }
        }

        public function delete($packageId)
        {
            $this->load->model('packages_model');

            if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
                $data = $this->packages_model->delete($packageId);
                echo json_encode($data);
            }
        }

        public function get()
        {
            $this->load->model('packages_model');
            $data = $this->packages_model->get();
            echo json_encode($data);
        }

        public function get_by_id($packageId)
        {
            $this->load->model('packages_model');
            $data = $this->packages_model->get_by_id($packageId);
            echo json_encode($data);
        }

        public function get_filtered_by_price()
        {
            $this->load->model('packages_model');
            $data = $this->packages_model->get_by_price($_GET['maximum_price']);
            echo json_encode($data);
        }
    }
