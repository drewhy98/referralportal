<?php
include "includes/header.php";

// Simulated referral data (in real life, this comes from a database)
$referrals = [
    [
        'nhs_number' => '9991234567',
        'date' => '1yr',
        'specialty' => 'Cardiology',
        'details' => 'Appointment scheduled for 20 May 2026 at Royal Hospital'
    ],
    [
        'nhs_number' => '9991234567',
        'date' => '1-2yr',
        'specialty' => 'Dermatology',
        'details' => 'Referral sent, awaiting appointment'
    ]
];

// Only process form if submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ref_date = $_POST['ref_date'] ?? 'unknown';
    $ref_spec_known = $_POST['ref_spec'] ?? 'no';
    $spec_name = trim($_POST['spec_name'] ?? '');

    $match = null;

    // If user unsure on date or specialty, no match
    if ($ref_date === 'unknown' || ($ref_spec_known === 'no' && $spec_name === '')) {
        header("Location: dashboard.php?msg=" . urlencode("Not able to locate a match"));
        exit;
    }

    // Loop through referrals to find a match
    foreach ($referrals as $ref) {
        if ($ref['date'] === $ref_date) {
            if ($ref_spec_known === 'yes' && strcasecmp($ref['specialty'], $spec_name) === 0) {
                $match = $ref;
                break;
            } elseif ($ref_spec_known === 'yes' && empty($spec_name)) {
                continue;
            }
        }
    }

    if ($match) {
        // Display referral details
        echo '<div class="panel">';
        echo '<h1>Referral Details Found</h1>';
        echo '<p>' . htmlspecialchars($match['details']) . '</p>';
        echo '</div>';
    } else {
        // Redirect if no match
        header("Location: dashboard.php?msg=" . urlencode("Not able to locate a match"));
        exit;
    }
}
?>

<?php include "includes/footer.php"; ?>
