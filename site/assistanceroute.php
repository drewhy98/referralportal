<?php

$type = $_POST['user_type'];

if($type == "self"){
    header("Location: nhs-number.php");
}

if($type == "proxy"){
    header("Location: proxy-details.php");
}

exit();
