<?php
session_start();
if(isset($_SESSION["adminID"])) {
  header('Location: dashboard', true, 303);
  exit();
}
?>