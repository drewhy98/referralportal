<?php include "includes/header.php"; ?>

<div class="panel">

  <form action="guidedhelp-spec.php" method="POST">

    <h1>Do you know what the specialty was?</h1>

    <p>Select one option.</p>

    <div class="radio-option">
      <label>
        <input type="radio" name="ref_spec" value="yes" required onclick="showSpecInput(true)">
        Yes
      </label>
    </div>

    <div class="radio-option">
      <label>
        <input type="radio" name="ref_spec" value="no" required onclick="showSpecInput(false)">
        No, I'm not sure
      </label>
    </div>

    <!-- Hidden text input, shown only if "Yes" is selected -->
    <div id="spec-input-container" style="display:none; margin-top:10px;">
      <label for="spec_name">Enter the specialty:</label>
      <input type="text" name="spec_name" id="spec_name">
    </div>

    <button type="submit">Continue</button>

  </form>

</div>

<script>
  function showSpecInput(show) {
    const container = document.getElementById('spec-input-container');
    container.style.display = show ? 'block' : 'none';
  }
</script>

<?php include "includes/footer.php"; ?>
