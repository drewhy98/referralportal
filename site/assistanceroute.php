<?php
// Make sure the form was submitted
if (isset($_POST['assistance_type'])) {
    $type = $_POST['assistance_type'];

    if ($type === "yes") {
        header("Location: guidedhelp.php");
        exit(); // stop execution immediately
    }

    if ($type === "no") {
        header("Location: dashboard.php");
        exit();
    }
} else {
    // No value posted; go back to form
    header("Location: assistancechecker.php");
    exit();
}
?>
