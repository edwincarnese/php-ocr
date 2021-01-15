<?php

require_once(__DIR__."/../DB/database.php");

class Barangay {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function store($data) {
        $this->db->query("INSERT INTO barangay (name, created_at) VALUES(:name, NOW())");
        $this->db->bind(':name', $data['name']);
        $this->executeQuery();
    }

    public function edit($data) {
        $this->db->query("UPDATE barangay SET name = :name WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->executeQuery();
    }

    public function destroy($id) {
        $this->db->query("DELETE FROM barangay WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->executeQuery();
    }

    public function getAll() {
        $this->db->query("SELECT barangay.*, COUNT(people.id) AS 'numberOfCases' FROM barangay LEFT JOIN people ON people.brgy_id = barangay.id GROUP BY barangay.id");
        return $this->db->resultSet();
    }

    public function getCount() {
        $this->db->query("SELECT count(id) AS 'noOfBrgy' FROM barangay");
        return $this->db->single();
    }

    public function getById($id) {
        $this->db->query("SELECT * FROM barangay WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getByName($data) {
        $this->db->query("SELECT * FROM barangay WHERE name = :name");
        $this->db->bind(':name', $data['name']);
        return $this->db->single();
    }

    public function searchBarangayFromImage($search) {
        $this->db->query('SELECT * FROM barangay WHERE MATCH(name) AGAINST (:search)');
        $this->db->bind(':search', $search);
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