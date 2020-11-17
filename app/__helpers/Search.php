<?php

class Search {
    public static function address(String $data) : String {
        $address = explode(" ", $data); 
        $searchWord = "City";
        $matches = array();
        foreach($address as $k=>$v) {
            if(preg_match("/\b$searchWord\b/i", $v)) {
                $matches[$k] = $v;
                $purok = $address[$k - 3] ?? '';
                $brgy = $address[$k - 2] ?? '';
                $city = $address[$k - 1] ?? '';
                return $purok . " " . $brgy . " " . $city . " " . $matches[$k];
            }
        }
        return "";
    }

    public static function name(String $data) : String {
        $name = explode(" ", $data); 
        $searchWord = "Home";
        $matches = array();
        foreach($name as $k=>$v) {
            if(preg_match("/\b$searchWord\b/i", $v)) {
                $matches[$k] = $v;
                $firstName = $name[$k + 2] ?? '';
                $middleName = $name[$k + 3] ?? '';
                $lastName = $name[$k + 4] ?? '';
                return $firstName . " " . $middleName . " " . $lastName;
            }
        }
        return "";
    }
}

?>