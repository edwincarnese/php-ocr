<?php
require_once(__DIR__."/../model/user.php");
require_once(__DIR__."/../__helpers/Toast.php");
require_once(__DIR__."/../__helpers/HeaderLocation.php");

if(isset($_POST["create"])) {
    $data = [
        'name' => $_POST["name"], 
        'username' => $_POST["username"], 
        'password' => $_POST["password"], 
        'user_type' => $_POST["user_type"], 
        'establishment' => $_POST["establishment"], 
    ];

    $user = new User();

    $isExists = $user->getByUsername($data);
    if($isExists) {
        Toast::setToast("Username is already exist.", "error");
        HeaderLocation::setLocation('../../users');
    } 
    
    $user->store($data);

    Toast::setToast("New data successfully saved.", "success");
    HeaderLocation::setLocation('../../users');
}

if(isset($_POST["update"])) {
    $data = [
        'id' => $_POST["editId"], 
        'name' => $_POST["name"], 
        'password' => $_POST["password"], 
    ];
    $user = new User();
    $user->edit($data);

    Toast::setToast("Data successfully updated.", "success");
    HeaderLocation::setLocation('../../users');
}

if(isset($_POST["delete"])) {
    $userId = $_POST["userId"];

    $user = new User();
    $user->destroy($userId);

    Toast::setToast("Data successfully deleted.", "success");
    HeaderLocation::setLocation('../../users');
}
?>