<?php
require_once(__DIR__."/../__helpers/HeaderLocation.php");

session_start();
unset($_SESION["adminID"]);
session_destroy();

HeaderLocation::setLocation('../../dashboard');
?>