<?php
require_once(__DIR__."/../__helpers/Files.php");
require_once(__DIR__."/../__helpers/OCR.php");
require_once(__DIR__."/../__helpers/HeaderLocation.php");
require_once(__DIR__."/../__helpers/Toast.php");
require_once(__DIR__."/../__helpers/Search.php");
require_once(__DIR__."/../model/people.php");
require_once(__DIR__."/../model/barangay.php");

if(isset($_POST["create"])) {
    $file = basename($_FILES["image"]["name"]);
    $targetDir = "../../images/";

    if(Files::checkFileUpload($file, $targetDir)) {
        $fileExtension = explode(".", $file);
        $fileId = sha1(date("Ymdhis")) . '.' . end($fileExtension);
        $uploadedFile = $targetDir . $fileId;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadedFile)) {
            $imageTexts = OCR::image($uploadedFile);

            $barangay = new Barangay();
            $searchBrgy = $barangay->getBarangayWildCardSearch($imageTexts);
            $brgyId = null;
            if($searchBrgy) {
                $brgyId = $searchBrgy->id;
            }

            $data = [
                'fullname' => Search::name($imageTexts), 
                'address' => Search::address($imageTexts),
                'file_path' => "images/{$fileId}",
                'brgyId' => $brgyId
            ];

            $people = new People();
            $people->addPeople($data);

            Toast::setToast("New data successfully saved.", "success");
            HeaderLocation::setLocation('../../people');
        } 
        else {
            Toast::setToast("Failed to upload file.", "error");
            HeaderLocation::setLocation('../../people');
        }
    } 
    else {
        Toast::setToast("Failed to upload file.", "error");
        HeaderLocation::setLocation('../../people');
    }   
}

if(isset($_POST["update"])) {
    $data = [
        'id' => $_POST["personId"], 
        'fullname' => $_POST["fullName"], 
        'address' =>  $_POST["address"]
    ];

    $people = new People();
    $people->updatePeople($data);

    Toast::setToast("Data successfully updated.", "success");
    HeaderLocation::setLocation('../../people');
}

if(isset($_POST["delete"])) {
    $personId = $_POST["personId"];

    $people = new People();
    $people->deletePeople($personId);

    Toast::setToast("Data successfully deleted.", "success");
    HeaderLocation::setLocation('../../people');
}

if(isset($_POST["personId"])) {
    $people = new People();
    $result = $people->getPeopleById($_POST["personId"]);
    echo json_encode($result);
}

?>