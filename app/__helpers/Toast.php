<?php

class Toast {
    public static function setToast(String $message, String $type) {
        session_start();
        $_SESSION["toastMessage"] = $message;
        $_SESSION["toastType"] = $type;
    }
}

?>