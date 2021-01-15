<?php
require_once(__DIR__."/../__helpers/HeaderLocation.php");

session_start();
unset($_SESION["userID"]);
unset($_SESION["userFullname"]);
unset($_SESION["userName"]);
unset($_SESION["userType"]);
unset($_SESION["userEstablishmentId"]);
unset($_SESION["userEstablishment"]);
session_destroy();

HeaderLocation::setLocation('../../dashboard');
?>