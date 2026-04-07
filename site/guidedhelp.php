<?php
include "includes/dbconnect.php";
include "includes/header.php";
include "refmatcher.php";

$match = null;

// Ensure NHS number is passed from previous page
$nhs_number = trim($_POST['nhs_number'] ?? '');

if (!$nhs_number) {
    // Redirect if NHS number missing
    header("Location: assistancechecker.php?msg=" . urlencode("Please provide your NHS number first"));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ref_date = $_POST['ref_date'] ?? 'unknown';
    $ref_spec_known = $_POST['ref_spec'] ?? 'no';
    $spec_name = trim($_POST['spec_name'] ?? '');

    // Redirect if unsure about date or specialty
    if ($ref_date === 'unknown' || ($ref_spec_known === 'no' && $spec_name === '')) {
        header("Location: dashboard.php?msg=" . urlencode("Not able to locate a match"));
        exit;
    }

    // Use refmatcher function to check DB
    $match = findReferral($db, $nhs_number, $ref_date, $spec_name, $ref_spec_known === 'yes');
}
?>

<div class="panel">

<?php if (!$match): ?>
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
