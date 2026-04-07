<?php include "includes/header.php"; ?>

<div class="panel">

  <form action="assistancechecker.php" method="POST">

    <h1>Enter the patient's NHS number</h1>

    <p class="hint">
      This is a 10 digit number like 999 123 4567.
    </p>

    <input type="text" name="nhs_number" required>

    <h2>Your relationship to them</h2>

    <input type="text" name="relationship">

    
    <h2>Your first name and last name</h2>

    <input type="text" name="fullname">

    <button type="submit">Continue</button>

  </form>

</div>

<?php include "includes/footer.php"; ?>
