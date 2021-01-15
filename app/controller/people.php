<?php
require_once(__DIR__."/../__helpers/Files.php");
require_once(__DIR__."/../__helpers/OCR.php");
require_once(__DIR__."/../__helpers/HeaderLocation.php");
require_once(__DIR__."/../__helpers/Toast.php");
require_once(__DIR__."/../__helpers/Search.php");
require_once(__DIR__."/../model/people.php");
require_once(__DIR__."/../model/barangay.php");
require_once(__DIR__."/../__helpers/Session.php");

if(isset($_POST["create"])) {
    $fileFrontImage = basename($_FILES["front_image"]["name"]);
    $fileBackImage = basename($_FILES["back_image"]["name"]);

    $targetDir = "../../images/";
    $fileName = sha1(date("Ymdhis")) . '.';

    if(!Files::checkFileUpload($fileFrontImage, $targetDir)) {
        Toast::setToast("Failed to upload file.", "error");
        HeaderLocation::setLocation('../../people');
    } 

    if(!Files::checkFileUpload($fileBackImage, $targetDir)) {
        Toast::setToast("Failed to upload file.", "error");
        HeaderLocation::setLocation('../../people');
    } 

    $fileFrontImageExt = explode(".", $fileFrontImage);
    $fileFrontImageId = 'front-' . $fileName . end($fileFrontImageExt);
    $uploadedFrontImage = $targetDir . $fileFrontImageId;

    if (!move_uploaded_file($_FILES["front_image"]["tmp_name"], $uploadedFrontImage)) {
        Toast::setToast("Failed to upload file.", "error");
        HeaderLocation::setLocation('../../people');
    } 

    $fileBackImageExt = explode(".", $fileBackImage);
    $fileBackImageId = 'back-' . $fileName . end($fileBackImageExt);
    $uploadedBackImage = $targetDir . $fileBackImageId;

    if (!move_uploaded_file($_FILES["back_image"]["tmp_name"], $uploadedBackImage)) {
        Toast::setToast("Failed to upload file.", "error");
        HeaderLocation::setLocation('../../people');
    } 

    $imageTexts = OCR::image($uploadedFrontImage);
    $brgyId = isBarangayFound($imageTexts);
    $status = isTodayFound($uploadedBackImage);

    $data = [
        'fullname' => Search::name($imageTexts), 
        'address' => Search::address($imageTexts),
        'front_id' => "images/{$fileFrontImageId}",
        'back_id' => "images/{$fileBackImageId}",
        'brgyId' => $brgyId,
        'status' => $status,
        'establishment_id' => $_SESSION["userEstablishmentId"]
    ];

    $people = new People();
    $people->store($data);

    Toast::setToast("New data successfully saved.", "success");
    HeaderLocation::setLocation('../../people');
}

if(isset($_POST["update"])) {
    $data = [
        'id' => $_POST["personId"], 
        'fullname' => $_POST["fullName"], 
        'address' =>  $_POST["address"]
    ];

    $people = new People();
    $people->edit($data);

    Toast::setToast("Data successfully updated.", "success");
    HeaderLocation::setLocation('../../people');
}

if(isset($_POST["delete"])) {
    $personId = $_POST["personId"];

    $people = new People();
    $people->destroy($personId);

    Toast::setToast("Data successfully deleted.", "success");
    HeaderLocation::setLocation('../../people');
}

if(isset($_POST["personId"])) {
    $people = new People();
    $result = $people->getById($_POST["personId"]);
    echo json_encode($result);
}

function isBarangayFound($imageTexts) {
    $brgyId = null;
    $barangay = new Barangay();

    $searchBrgy = $barangay->searchBarangayFromImage($imageTexts);
    if($searchBrgy) {
        $brgyId = $searchBrgy->id;
    }
    return $brgyId;
}

function isTodayFound($image) {
    $todayDate = date("l");

    if(preg_match("/{$todayDate}/i", OCR::image($image))) {
        return 1;
    } 
    return 0;
}
?>