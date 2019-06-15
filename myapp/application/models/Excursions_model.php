<?php
 
    class Excursions_model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }

        public function create($data)
        {
            $sql = "INSERT INTO excursions 
                  (name, price, location, description, photo_path, duration) 
                  VALUES 
                  (?,?,?,?,?,?)";
            $query = $this->db->query($sql, array(
              $data['name'],
              $data['price'],
              $data['location'],
              $data['description'],
              $data['photo_path'],
              $data['duration']
            ));

            $id = $this->db->insert_id();
            return $id;
        }

        public function edit($data)
        {
            $sql = "UPDATE excursions SET
                    name=?,
                    price=?,
                    location=?,
                    description=?,
                    photo_path=?,
                    duration=?,
                    state=?
                    WHERE id=?";
            $query = $this->db->query($sql, array(
              $data['name'],
              $data['price'],
              $data['location'],
              $data['description'],
              $data['photo_path'],
              $data['duration'],
              $data['state'],
              $data['id']
            ));
        }

        public function delete($id)
        {

            $sql = "SELECT * FROM excursions WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            $data = $query->result_array();

            $sql = "DELETE FROM
                    excursions WHERE id=?";
            $query = $this->db->query($sql, array($id));
            return $data[0];
        }

        public function get()
        {
            $sql = "SELECT * FROM excursions";
            $query = $this->db->query($sql);
            $data = $query->result_array();
            return $data;
        }

        public function get_by_id($id)
        {
            $sql = "SELECT * FROM excursions WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            $data = $query->result_array();
            return $data[0];
        }

        public function get_by_duration($maximum_duration)
        {
            $sql = "SELECT * FROM excursions WHERE duration <= ?";
            $query = $this->db->query($sql, array($maximum_duration));
            $data = $query->result_array();
            return $data;
        }

        public function get_by_location($location)
        {
            $sql = "SELECT * FROM excursions WHERE location = ?";
            $query = $this->db->query($sql, array($location));
            $data = $query->result_array();
            return $data;
        }

        public function get_by_price($price)
        {
            $sql = "SELECT * FROM excursions WHERE price <= ?";
            $query = $this->db->query($sql, array($price));
            $data = $query->result_array();
            return $data;
        }
    }
