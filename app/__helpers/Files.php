<?php

class Files {
    public static function checkFileUpload(String $file, String $targetDir) : Bool {
        $targetFile = $targetDir . $file;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    
        // if (file_exists($targetFile)) {
        //     $uploadOk = 0;
        // }
        
        if ($_FILES["image"]["size"] > 5000000000) {
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            return false;
        } else {
            return true;
        }
    }
}
?>