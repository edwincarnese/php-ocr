<?php

require_once(__DIR__."/../DB/database.php");

class People {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function store($data) {
        $this->db->query("INSERT INTO people (fullname, address, front_id, back_id, brgy_id, establishment_id, status, created_at) 
            VALUES(:fullname, :address, :front_id, :back_id, :brgy_id, :establishment_id, :status, NOW())");
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':front_id', $data['front_id']);
        $this->db->bind(':back_id', $data['back_id']);
        $this->db->bind(':brgy_id', $data['brgyId']);
        $this->db->bind(':establishment_id', $data['establishment_id']);
        $this->db->bind(':status', $data['status']);
        $this->executeQuery();
    }

    public function edit($data) {
        $this->db->query("UPDATE people SET fullname = :fullname, address = :address WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':address', $data['address']);
        $this->executeQuery();
    }

    public function destroy($id) {
        $this->db->query("DELETE FROM people WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->executeQuery();
    }

    public function getAll($establishment_id = null, $barangay_id) {
        $this->db->query("SELECT people.*, barangay.name AS 'brgyName', establishment.name 'establishmentName' FROM people 
            LEFT JOIN barangay ON barangay.id = people.brgy_id
            LEFT JOIN establishment ON establishment.id = people.establishment_id
            WHERE 1" . $this->whereEstablishment($establishment_id) . $this->whereBarangay($barangay_id));
            $this->bindEstablishment($establishment_id);
            $this->bindBarangay($barangay_id);
        return $this->db->resultSet();
    }

    public function getCount() {
        $this->db->query("SELECT count(id) AS 'noOfPeople' FROM people");
        return $this->db->single();
    }

    public function getCountWithEstablishment($establiment_id) {
        $this->db->query("SELECT count(id) AS 'noOfPeople' FROM people WHERE establishment_id = :establishment_id");
        $this->db->bind(':establishment_id', $establiment_id);
        return $this->db->single();
    }

    public function getById($id) {
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

    private function whereEstablishment($establishment_id) {
        if($establishment_id) {
            return " AND people.establishment_id = :establishment_id";
        }
        return null;
    }
    
    private function bindEstablishment($establishment_id) {
        if($establishment_id) {
            return $this->db->bind(':establishment_id', $establishment_id);
        }
        return null;
    }

    private function whereBarangay($brgy_id) {
        if($brgy_id) {
            return " AND people.brgy_id = :barangay_id";
        }
        return null;
    }
    
    private function bindBarangay($brgy_id) {
        if($brgy_id) {
            return $this->db->bind(':barangay_id', $brgy_id);
        }
        return null;
    }
}

?>