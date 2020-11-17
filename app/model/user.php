<?php
require_once(__DIR__."/../DB/database.php");

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function userLogin($username) {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    public function addUser($data) {
        $this->db->query("INSERT INTO people (username, password) VALUES(:username, :password)");
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->executeQuery();
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