<?php
require_once(__DIR__."/../__helpers/Files.php");
require_once(__DIR__."/../__helpers/OCR.php");
require_once(__DIR__."/../__helpers/Search.php");
require_once(__DIR__."/../model/people.php");
require_once(__DIR__."/../model/barangay.php");

if(isset($_POST["image"])) {
    $targetDir = "../../images/";
    $fileId = sha1(date("Ymdhis")) . ".png";
    $uploadedFile = $targetDir . $fileId;
    $decodeImage = base64_decode($_POST["image"]);
    file_put_contents($uploadedFile, $decodeImage);

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
}
?>