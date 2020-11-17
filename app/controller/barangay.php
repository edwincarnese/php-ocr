<?php
require_once(__DIR__."/../model/barangay.php");
require_once(__DIR__."/../__helpers/Toast.php");
require_once(__DIR__."/../__helpers/HeaderLocation.php");

if(isset($_POST["create"])) {
    $data = [
        'name' => $_POST["barangay"], 
    ];
    $barangay = new Barangay();
    $result = $barangay->getBarangayByName($data);
    
    if(!$result) {
        $barangay->addBarangay($data);
        Toast::setToast("New data successfully saved.", "success");
    } 
    else {
        Toast::setToast("Barangay is already exist.", "error");
    }
    HeaderLocation::setLocation('../../barangay');
}

if(isset($_POST["update"])) {
    $data = [
        'id' => $_POST["bId"], 
        'name' => $_POST["bName"], 
    ];
    $barangay = new Barangay();
    $barangay->updateBarangay($data);

    Toast::setToast("Data successfully updated.", "success");
    HeaderLocation::setLocation('../../barangay');
}

if(isset($_POST["delete"])) {
    $barangayId = $_POST["barangayId"];

    $barangay = new Barangay();
    $barangay->deleteBarangay($barangayId);

    Toast::setToast("Data successfully deleted.", "success");
    HeaderLocation::setLocation('../../barangay');
}
?>