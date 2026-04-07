<?php include "includes/header.php"; ?>

<div class="panel">

  <form action="guidedhelp2.php" method="POST">

    <h1>Do you know when the referral was made?</h1>

    <p>Select one option.</p>

    <div class="radio-option">
      <label>
        <input type="radio" name="ref_date" value="1yr" required>
        Within the last year
      </label>
    </div>

     <div class="radio-option">
      <label>
        <input type="radio" name="ref_date" value="1-2yr" required>
        Between 1-2 years
      </label>
    </div>
    
    <div class="radio-option">
      <label>
        <input type="radio" name="ref_date" value="unknown" required>
        Not sure
      </label>
    </div>
    
    <button type="submit">Continue</button>

  </form>

</div>

<?php include "includes/footer.php"; ?>
