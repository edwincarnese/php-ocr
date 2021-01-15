<?php
require_once(__DIR__."/../model/user.php");
require_once(__DIR__."/../__helpers/HeaderLocation.php");
require_once(__DIR__."/../__helpers/Toast.php");

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = new User();
    $result = $user->login($username);

    if($result) {
        if (password_verify($password, $result->password)) {
            session_start();
            $_SESSION["userID"] = $result->id;
            $_SESSION["userFullname"] = $result->name;
            $_SESSION["userName"] = $result->username;
            $_SESSION["userType"] = $result->user_type;
            $_SESSION["userEstablishmentId"] = $result->establishment_id;
            $_SESSION["userEstablishment"] = $result->establishment;
            
            Toast::setToast("Welcome, {$result->name}!", "success");
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