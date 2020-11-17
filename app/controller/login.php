<?php
require_once(__DIR__."/../model/user.php");
require_once(__DIR__."/../__helpers/HeaderLocation.php");
require_once(__DIR__."/../__helpers/Toast.php");

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = new User();
    $result = $user->userLogin($username);

    if($result) {
        if (password_verify($password, $result->password)) {
            session_start();
            $_SESSION["adminID"] = $result->id;
            $_SESSION["adminName"] = $result->username;
            
            Toast::setToast("Welcome, Admin!", "success");
            HeaderLocation::setLocation('../../dashboard');
        } 
        else {
            Toast::setToast("Incorrect username or password.", "error");
        }
    }
    else {
        Toast::setToast("Incorrect username or password.", "error");
    }
    HeaderLocation::setLocation('../../dashboard');
}

?>