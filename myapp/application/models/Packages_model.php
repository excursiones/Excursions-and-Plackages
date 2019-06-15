<?php
 
    class Packages_model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }

        public function create($data)
        {
            $sql = "INSERT INTO packages 
                  (name, price) 
                  VALUES 
                  (?,?)";
            $query = $this->db->query($sql, array(
              $data['name'],
              $data['price']
            ));

            $id = $this->db->insert_id();

            $sql = "INSERT INTO excursions_packages
                    (id_excursions, id_packages)
                    VALUES";
            $data_to_insert = array();
            $count = 0;
            foreach($data['excursions'] as $row){
              $sql.= "(?,?)";
              if(++$count != count($data['excursions'])){
                $sql.= ",";
              }
              array_push($data_to_insert, $row);
              array_push($data_to_insert, $id);
            }
            $query = $this->db->query($sql,$data_to_insert);

            return $id;
        }

        public function edit($data)
        {
            $sql = "UPDATE packages SET
                    name=?,
                    price=?,
                    state=?
                    WHERE id=?";
            $query = $this->db->query($sql, array(
              $data['name'],
              $data['price'],
              $data['state'],
              $data['id']
            ));
        }

        public function delete($id)
        {
            $sql = "DELETE FROM
                    packages WHERE id=?";
            $query = $this->db->query($sql, array($id));
        }

        public function get()
        {
            $sql = "SELECT * FROM packages INNER JOIN 
                    excursions_packages ON packages.id = excursions_packages.id_packages";
            $query = $this->db->query($sql);
            $data = $query->result_array();
            return $data;
        }

        public function get_by_id($id)
        {
            $sql = "SELECT * FROM packages INNER JOIN 
                    excursions_packages ON packages.id = excursions_packages.id_packages
                    WHERE id_packages = ?";
            $query = $this->db->query($sql, array($id));
            $data = $query->result_array();
            return $data;
        }

        public function get_by_price($maximum_price)
        {
          $sql = "SELECT * FROM packages WHERE price <= ?";
          $query = $this->db->query($sql, array($maximum_price));
          $data = $query->result_array();
          return $data;
        }
    }
