<?php
session_start();
if(isset($_SESSION["userID"])) {
  header('Location: dashboard', true, 303);
  exit();
}
?>