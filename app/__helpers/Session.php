<?php
session_start();
if(!isset($_SESSION["userID"]) || !isset($_SESSION["userName"]))
{
    header('Location: /../ocr', true, 303);
    exit();
}
?>