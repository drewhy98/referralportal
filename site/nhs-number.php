<?php
session_start();

if(isset($_POST['nhs_number'])){
    $_SESSION['nhs_number'] = $_POST['nhs_number'];
    header("Location: assistancechecker.php");
    exit();
}
?>

<?php include "includes/header.php"; ?>

<div class="panel">

 <form action="nhs-number.php" method="POST">

    <h1>What is your NHS number?</h1>

    <p class="hint">
      This is a 10 digit number like 999 123 4567.
    </p>

    <input type="text" name="nhs_number" required>

    <button type="submit">Continue</button>

  </form>

</div>

<?php include "includes/footer.php"; ?>
