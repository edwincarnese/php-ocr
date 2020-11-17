<?php

require_once(__DIR__."/../DB/database.php");

class People {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addPeople($data) {
        $this->db->query("INSERT INTO people (fullname, address, file_path, brgy_id, created_at) VALUES(:fullname, :address, :file_path, :brgy_id, NOW())");
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':file_path', $data['file_path']);
        $this->db->bind(':brgy_id', $data['brgyId']);
        $this->executeQuery();
    }

    public function updatePeople($data) {
        $this->db->query("UPDATE people SET fullname = :fullname, address = :address WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':address', $data['address']);
        $this->executeQuery();
    }

    public function deletePeople($id) {
        $this->db->query("DELETE FROM people WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->executeQuery();
    }

    public function getPeople() {
        $this->db->query("SELECT people.*, barangay.name AS 'brgyName' FROM people LEFT JOIN barangay ON barangay.id = people.brgy_id");
        return $this->db->resultSet();
    }

    public function getNumberOfPeople() {
        $this->db->query("SELECT count(id) AS 'noOfPeople' FROM people");
        return $this->db->single();
    }

    public function getPeopleById($id) {
        $this->db->query("SELECT * FROM people WHERE id = :id");
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