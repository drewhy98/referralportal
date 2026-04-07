<?php

$type = $_POST['assistance_type'];

if($type == "yes"){
    header("Location: guidedhelp-date.php");
}

if($type == "no"){
    header("Location: dashboard.php");
}

exit();
