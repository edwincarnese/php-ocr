<?php
require_once(__DIR__."/../../vendor\autoload.php");

use thiagoalessio\TesseractOCR\TesseractOCR;

class OCR {

    public static function image(String $imagePath) : String {
        $ocr = new TesseractOCR($imagePath);
        return $ocr->run();
    }
}
