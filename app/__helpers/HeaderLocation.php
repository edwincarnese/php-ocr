<?php

class HeaderLocation {
    public static function setLocation(String $location) : void {
        header("Location: {$location}", true, 303);
        exit();
    }
}

?>