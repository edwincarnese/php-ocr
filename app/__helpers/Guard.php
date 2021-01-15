<?php
if($_SESSION["userType"] != 'Admin')
{
    header('Location: /../ocr', true, 303);
    exit();
}
?>