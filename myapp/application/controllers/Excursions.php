<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Excursions extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function create()
        {
            $this->load->model('excursions_model');

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = file_get_contents('php://input');
                $_POST = json_decode($_POST, true);

                $data['name'] = $_POST['name'];
                $data['price'] = $_POST['price'];
                $data['location'] = $_POST['location'];
                $data['description'] = $_POST['description'];
                $data['photo_path'] = $_POST['photo_path'];
                $data['duration'] = $_POST['duration'];
                $id = $this->excursions_model->create($data);
                $data['id'] = $id;

                echo json_encode($data);
            }
        }

        public function edit($excursionId)
        {
            $this->load->model('excursions_model');

            if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
                $_PUT = file_get_contents('php://input');
                $_PUT = json_decode($_PUT, true);
                $data['name'] = $_PUT['name'];
                $data['price'] = $_PUT['price'];
                $data['location'] = $_PUT['location'];
                $data['description'] = $_PUT['description'];
                $data['photo_path'] = $_PUT['photo_path'];
                $data['duration'] = $_PUT['duration'];
                $data['state'] = $_PUT['state'];
                $data['id'] = $excursionId;
                $this->excursions_model->edit($data);
                echo json_encode($data);
            }

        }

        public function delete($excursionId)
        {
            $this->load->model('excursions_model');

            if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
                $data = $this->excursions_model->delete($excursionId);
                echo json_encode($data);
            }
        }

        public function get()
        {
            $this->load->model('excursions_model');
            $data = $this->excursions_model->get();
            echo json_encode($data);
        }

        public function get_by_id($excursionId)
        {
            $this->load->model('excursions_model');
            $data = $this->excursions_model->get_by_id($excursionId);
            echo json_encode($data);
        }

        
        public function get_filtered_by_duration()
        {
            $this->load->model('excursions_model');
            $data = $this->excursions_model->get_by_duration($_GET['maximum_duration']);
            echo json_encode($data);
        }

        public function get_filtered_by_location()
        {
            $this->load->model('excursions_model');
            $data = $this->excursions_model->get_by_location($_GET['location']);
            echo json_encode($data);
        }

        public function get_filtered_by_price()
        {
            $this->load->model('excursions_model');
            $data = $this->excursions_model->get_by_price($_GET['maximum_price']);
            echo json_encode($data);
        }
    }
