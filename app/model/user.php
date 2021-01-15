<?php
require_once(__DIR__."/../DB/database.php");

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function login($username) {
        $this->db->query("SELECT users.*, establishment.name AS 'establishment', establishment.id AS 'establishment_id' FROM users 
            LEFT JOIN establishment ON establishment.id = users.establishment_id 
            WHERE username = :username");
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    public function store($data) {
        $this->db->query("INSERT INTO users (username, password, name, user_type, establishment_id, created_at) 
                                      VALUES(:username, :password, :name, :user_type, :establishment_id, NOW())");
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':user_type', $data['user_type']);
        $this->db->bind(':establishment_id', $data['establishment']);
        $this->executeQuery();
    }

    public function getAll() {
        $this->db->query("SELECT users.*, establishment.id AS 'establishment_id', establishment.name AS 'establishment_name' FROM users 
            LEFT JOIN establishment ON establishment.id = users.establishment_id");
        return $this->db->resultSet();
    }

    public function destroy($id) {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->executeQuery();
    }

    public function edit($data) {
        $this->db->query("UPDATE users SET name = :name, password = :password WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->executeQuery();
    }

    public function getByUsername($data) {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $data['username']);
        return $this->db->single();
    }

    public function getCount() {
        $this->db->query("SELECT count(id) AS 'noOfUser' FROM users");
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