<?php
session_start();
include "includes/dbconnect.php";
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

<div class="panel">
    <h1>Your Referrals</h1>

    <?php if (empty($referrals)): ?>
        <p>No referrals found for this NHS number.</p>
    <?php else: ?>
        <table id="myTable" class="display">
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
                        <td><?php echo htmlspecialchars($ref['id']); ?></td>
                        <td><?php echo htmlspecialchars($ref['ref_date']); ?></td>
                        <td><?php echo htmlspecialchars($ref['specialty']); ?></td>
                        <td><?php echo htmlspecialchars($ref['details']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<!-- Include DataTables CSS -->
<link rel="stylesheet" href="//cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">

<!-- Include DataTables JS -->
<script src="//cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialise DataTable
    let table = new DataTable('#myTable');
});
</script>

<?php include "includes/footer.php"; ?>
