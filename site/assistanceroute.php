<?php
session_start();

$type = $_POST['assistance_type'];

if($type == "yes"){
    header("Location: guidedhelp.php");
    exit();
}

if($type == "no"){
    header("Location: dashboard.php");
    exit();
}
?>
