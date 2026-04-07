<?php
session_start();

// Save NHS number from previous form
if(isset($_POST['nhs_number'])){
    $_SESSION['nhs_number'] = $_POST['nhs_number'];
}

// Check if NHS number exists
if(!isset($_SESSION['nhs_number']) || empty($_SESSION['nhs_number'])){
    header("Location: nhs-number.php?msg=Please+provide+your+NHS+number+first");
    exit();
}


include "includes/header.php";
?>

<div class="panel">

  <form action="assistanceroute.php" method="POST">

    <h1>Do you require assistance to find a specific referral?</h1>

    <p>Select one option.</p>

    <div class="radio-option">
      <label>
        <input type="radio" name="assistance_type" value="yes" required>
        Yes, i require guided help
      </label>
    </div>

    <div class="radio-option">
      <label>
        <input type="radio" name="assistance_type" value="no">
        No, i wish to view all and do not require help
      </label>
    </div>

    <button type="submit">Continue</button>

  </form>

</div>

<?php include "includes/footer.php"; ?>
