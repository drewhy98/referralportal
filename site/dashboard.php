<?php
session_start();
include "includes/dbconnect.php";
$breadcrumbs = [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => 'Find Referrals With Assistance', 'url' => 'assistancechecker.php'],
    ['title' => 'View Referral Dashboard', 'url' => 'dashboard.php'],
];
include "includes/header.php";

// Get NHS number from session
$nhs_number = trim($_SESSION['nhs_number'] ?? '');

if (!$nhs_number) {
    header("Location: nhs-number.php?msg=" . urlencode("Please provide your NHS number first"));
    exit;
}

// Fetch all referrals for this NHS number
$stmt = $db->prepare("
    SELECT r.id, r.ref_date, r.specialty, r.details
    FROM referrals r
    JOIN users u ON u.id = r.user_id
    WHERE u.nhs_number = ?
    ORDER BY r.ref_date DESC
");
$stmt->execute([$nhs_number]);
$referrals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<h2 class="page-title">Your Referrals</h2>

<div class="table-container">

<?php if (empty($referrals)): ?>
    <p>No referrals found for this NHS number.</p>
<?php else: ?>
    <table id="referralsTable" class="display">
        <thead>
            <tr>
                <th>Referral ID</th>
                <th>Date</th>
                <th>Specialty</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($referrals as $ref): ?>
            <tr>
                <td><?= htmlspecialchars($ref['id']); ?></td>
                <td><?= date("F j, Y", strtotime($ref['ref_date'])); ?></td>
                <td><?= htmlspecialchars($ref['specialty']); ?></td>
                <td><?= htmlspecialchars($ref['details']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#referralsTable').DataTable({
        pageLength: 10,
        order: [[1, "desc"]] // sort by date descending
    });
});
</script>

<?php include "includes/footer.php"; ?>
