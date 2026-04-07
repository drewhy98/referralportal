<?php
include "includes/db_connect.php"; 

// Only process if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nhs_number = $_POST['nhs_number'] ?? '';  // user’s NHS number
    $ref_date = $_POST['ref_date'] ?? 'unknown';
    $ref_spec_known = $_POST['ref_spec'] ?? 'no';
    $spec_name = trim($_POST['spec_name'] ?? '');

    // 1️⃣ Find user in DB
    $stmt = $db->prepare("SELECT id FROM users WHERE nhs_number = ?");
    $stmt->execute([$nhs_number]);
    $user = $stmt->fetch();

    if (!$user) {
        // User not found → redirect
        header("Location: dashboard.php?msg=" . urlencode("Not able to locate a match"));
        exit;
    }

    $user_id = $user['id'];

    // 2️⃣ Build query to check referrals
    if ($ref_spec_known === 'yes') {
        // Check both date and specialty
        $stmt = $db->prepare("
            SELECT * FROM referrals 
            WHERE user_id = ? AND ref_date = ? AND LOWER(specialty) = LOWER(?)
            LIMIT 1
        ");
        $stmt->execute([$user_id, $ref_date, $spec_name]);
    } else {
        // User doesn't know specialty → only check date
        $stmt = $db->prepare("
            SELECT * FROM referrals 
            WHERE user_id = ? AND ref_date = ?
            LIMIT 1
        ");
        $stmt->execute([$user_id, $ref_date]);
    }

    $referral = $stmt->fetch();

    if ($referral) {
        // Match found → display details
        echo '<div class="panel" style="margin-top:20px;">';
        echo '<h2>Referral Details Found</h2>';
        echo '<p>' . htmlspecialchars($referral['details']) . '</p>';
        echo '</div>';
    } else {
        // No match → redirect to dashboard
        header("Location: dashboard.php?msg=" . urlencode("Not able to locate a match"));
        exit;
    }
}
?>
