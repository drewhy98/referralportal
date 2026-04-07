<?php include "includes/header.php"; ?>

<div class="panel">

  <form action="" method="POST">

    <h1>Referral Details</h1>

    <!-- Referral date question -->
    <p>When was the referral made?</p>
    <div class="radio-option">
      <label>
        <input type="radio" name="ref_date" value="1yr" required onclick="showSpecialtySection()">
        Within the last year
      </label>
    </div>
    <div class="radio-option">
      <label>
        <input type="radio" name="ref_date" value="1-2yr" required onclick="showSpecialtySection()">
        Between 1-2 years
      </label>
    </div>
    <div class="radio-option">
      <label>
        <input type="radio" name="ref_date" value="unknown" required onclick="showSpecialtySection()">
        Not sure
      </label>
    </div>

    <!-- Specialty question section, hidden initially -->
    <div id="specialty-section" style="display:none; margin-top:20px;">
      <p>Do you know the specialty?</p>

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

      <!-- Hidden text input for specialty -->
      <div id="spec-input-container" style="display:none; margin-top:10px;">
        <label for="spec_name">Enter the specialty:</label>
        <input type="text" name="spec_name" id="spec_name">
      </div>
    </div>

    <button type="submit" style="margin-top:20px;">Check Referral</button>

  </form>

</div>

<script>
function showSpecialtySection() {
    document.getElementById('specialty-section').style.display = 'block';
}

function showSpecInput(show) {
    document.getElementById('spec-input-container').style.display = show ? 'block' : 'none';
}
</script>

<?php
// Referral matching logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ref_date = $_POST['ref_date'] ?? 'unknown';
    $ref_spec_known = $_POST['ref_spec'] ?? 'no';
    $spec_name = trim($_POST['spec_name'] ?? '');

    // Example referral data
    $referrals = [
        [
            'date' => '1yr',
            'specialty' => 'Cardiology',
            'details' => 'Appointment scheduled for 20 May 2026 at Royal Hospital'
        ],
        [
            'date' => '1-2yr',
            'specialty' => 'Dermatology',
            'details' => 'Referral sent, awaiting appointment'
        ]
    ];

    // Redirect if unsure
    if ($ref_date === 'unknown' || ($ref_spec_known === 'no' && $spec_name === '')) {
        header("Location: dashboard.php?msg=" . urlencode("Not able to locate a match"));
        exit;
    }

    $match = null;
    foreach ($referrals as $ref) {
        if ($ref['date'] === $ref_date) {
            if ($ref_spec_known === 'yes' && strcasecmp(trim($ref['specialty']), $spec_name) === 0) {
                $match = $ref;
                break;
            } elseif ($ref_spec_known === 'no') {
                $match = $ref;
                break;
            }
        }
    }

    if ($match) {
        echo '<div class="panel" style="margin-top:20px;">';
        echo '<h2>Referral Details Found</h2>';
        echo '<p>' . htmlspecialchars($match['details']) . '</p>';
        echo '</div>';
    } else {
        header("Location: dashboard.php?msg=" . urlencode("Not able to locate a match"));
        exit;
    }
}
?>

<?php include "includes/footer.php"; ?>
