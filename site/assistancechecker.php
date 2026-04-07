<?php
session_start(); // start session at the top

include "includes/header.php";

// Determine NHS number depending on user type
$nhs_number = null;

// If a proxy submitted an NHS number in this form
if (isset($_POST['nhs_number']) && !empty($_POST['nhs_number'])) {
    $nhs_number = trim($_POST['nhs_number']);
    $_SESSION['nhs_number'] = $nhs_number; // store in session for consistency
} 
// Otherwise, use NHS number from session (self user)
elseif (isset($_SESSION['nhs_number']) && !empty($_SESSION['nhs_number'])) {
    $nhs_number = trim($_SESSION['nhs_number']);
}

// If we still don't have an NHS number, redirect back
if (!$nhs_number) {
    header("Location: nhs-number.php?msg=" . urlencode("Please provide your NHS number first"));
    exit();
}
?>

<div class="panel">

  <form action="assistanceroute.php" method="POST">

    <h1>Do you require assistance to find a specific referral?</h1>

    <p>Select one option.</p>

    <div class="radio-option">
      <label>
        <input type="radio" name="assistance_type" value="yes" required>
        Yes, I require guided help
      </label>
    </div>

    <div class="radio-option">
      <label>
        <input type="radio" name="assistance_type" value="no">
        No, I wish to view all and do not require help
      </label>
    </div>

    <button type="submit">Continue</button>

  </form>

</div>

<?php include "includes/footer.php"; ?>
