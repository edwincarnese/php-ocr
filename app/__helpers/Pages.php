<?php

class Pages {
    private $title;
    private $url;

    function __construct(String $title) {
        $this->title = $title;
        $this->url = explode("/ocr/", $_SERVER['REQUEST_URI'])[1];
    }

    function getTitle() : String {
        return $this->title;
    }

    function getUrl() : String {
        return $this->url;
    }

    function setCurrentMenuPage(Array $menu) : String {
        foreach($menu as $menu) {
            if($menu == $this->getUrl()) {
                return "active";
            } 
        }
        return "";
    }

    function setCurrentOpenMenuPage(Array $menu) : String {
        foreach($menu as $menu) {
            if($menu == $this->getUrl()) {
                return "menu-open";
            } 
        }
        return "";
    }
}

?>