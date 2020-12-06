<?php
require_once(__DIR__."/../model/establishment.php");
require_once(__DIR__."/../__helpers/Toast.php");
require_once(__DIR__."/../__helpers/HeaderLocation.php");

if(isset($_POST["create"])) {
    $data = [
        'name' => $_POST["establishment"], 
        'address' => $_POST["address"], 
    ];
    $establishment = new Establishment();
    $establishment->store($data);

    Toast::setToast("New data successfully saved.", "success");
    HeaderLocation::setLocation('../../establishment');
}

if(isset($_POST["update"])) {
    $data = [
        'id' => $_POST["eId"], 
        'name' => $_POST["eName"], 
        'address' => $_POST["eAddress"], 
    ];
    $establishment = new Establishment();
    $establishment->edit($data);

    Toast::setToast("Data successfully updated.", "success");
    HeaderLocation::setLocation('../../establishment');
}

if(isset($_POST["delete"])) {
    $establishmentId = $_POST["establishmentId"];

    $establishment = new Establishment();
    $establishment->destroy($establishmentId);

    Toast::setToast("Data successfully deleted.", "success");
    HeaderLocation::setLocation('../../establishment');
}
?>