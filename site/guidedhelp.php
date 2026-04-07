<?php include "includes/dbconnect.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "refmatcher.php"; ?>


<div class="panel">

<?php
$match = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nhs_number = $_POST['nhs_number'] ?? '';
    $ref_date = $_POST['ref_date'] ?? 'unknown';
    $ref_spec_known = $_POST['ref_spec'] ?? 'no';
    $spec_name = trim($_POST['spec_name'] ?? '');

    // Redirect immediately if user unsure about date or specialty
    if ($ref_date === 'unknown' || ($ref_spec_known === 'no' && $spec_name === '')) {
        header("Location: dashboard.php?msg=" . urlencode("Not able to locate a match"));
        exit;
    }

    // Use refmatcher.php function to check DB
    $match = findReferral($db, $nhs_number, $ref_date, $spec_name, $ref_spec_known === 'yes');
}
?>

<?php if (!$match): ?>
    <!-- Show form only if no match -->
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

        <!-- Specialty question section -->
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

            <div id="spec-input-container" style="display:none; margin-top:10px;">
                <label for="spec_name">Enter the specialty:</label>
                <input type="text" name="spec_name" id="spec_name">
            </div>
        </div>

        <button type="submit" style="margin-top:20px;">Check Referral</button>
    </form>
<?php else: ?>
    <!-- Match found, hide form -->
    <h2>Referral Details Found</h2>
    <p><?php echo htmlspecialchars($match['details']); ?></p>
<?php endif; ?>

</div>

<script>
function showSpecialtySection() {
    document.getElementById('specialty-section').style.display = 'block';
}
function showSpecInput(show) {
    document.getElementById('spec-input-container').style.display = show ? 'block' : 'none';
}
</script>

<?php include "includes/footer.php"; ?>
