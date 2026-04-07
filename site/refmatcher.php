<?php
include "includes/dbconnect.php";

/**
 * Find a referral for a user
 *
 * @param PDO $db
 * @param string $nhs_number
 * @param string $ref_date
 * @param string $spec_name
 * @param bool $spec_known
 * @return array|null
 */
function findReferral($db, $nhs_number, $ref_date, $spec_name = '', $spec_known = false) {
    // Find user by NHS number
    $stmt = $db->prepare("SELECT id FROM users WHERE nhs_number = ?");
    $stmt->execute([$nhs_number]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) return null;

    $user_id = $user['id'];

    if ($spec_known && $spec_name !== '') {
        $stmt = $db->prepare("
            SELECT * FROM referrals 
            WHERE user_id = ? AND ref_date = ? AND LOWER(specialty) = LOWER(?)
            LIMIT 1
        ");
        $stmt->execute([$user_id, $ref_date, trim($spec_name)]);
    } else {
        $stmt = $db->prepare("
            SELECT * FROM referrals 
            WHERE user_id = ? AND ref_date = ?
            LIMIT 1
        ");
        $stmt->execute([$user_id, $ref_date]);
    }

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
