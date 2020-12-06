<?php

require_once(__DIR__."/../DB/database.php");

class Establishment {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function store($data) {
        $this->db->query("INSERT INTO establishment (name, address, created_at) VALUES(:name, :address, NOW())");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address', $data['address']);
        $this->executeQuery();
    }

    public function edit($data) {
        $this->db->query("UPDATE establishment SET name = :name, address = :address WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address', $data['address']);
        $this->executeQuery();
    }

    public function destroy($id) {
        $this->db->query("DELETE FROM establishment WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->executeQuery();
    }

    public function getAll() {
        $this->db->query("SELECT establishment.*, COUNT(people.id) AS 'numberOfPeople' FROM establishment 
            LEFT JOIN people ON people.establishment_id = establishment.id GROUP BY establishment.id");
        return $this->db->resultSet();
    }

    public function getCount() {
        $this->db->query("SELECT count(id) AS 'noOfEstablishment' FROM establishment");
        return $this->db->single();
    }

    public function getById($id) {
        $this->db->query("SELECT * FROM establishment WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    private function executeQuery() {
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>