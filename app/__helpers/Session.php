<?php
session_start();
if(!isset($_SESSION["adminID"]) || !isset($_SESSION["adminName"]))
{
    header('Location: /../ocr', true, 303);
    exit();
}
?>