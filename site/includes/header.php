<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>NHS Wales Referral Tracking Portal</title>

<link rel="stylesheet" href="assets/css/styles.css">

</head>

<body>

<header class="header">
    <div class="header-inner">

        <img 
        src="assets/images/nhslogo.webp"
        alt="NHS Wales"
        class="logo">

        <h1 class="service-name">NHS Wales Referral Tracking Portal</h1>

    </div>
</header>

<main class="container">

<?php
// Check if $breadcrumbs is defined on the page
if (!isset($breadcrumbs)) $breadcrumbs = [];

if (!empty($breadcrumbs)): ?>
<nav class="breadcrumb-container" style="margin:15px 0; font-size:0.95rem;">
    <?php
    $last_index = count($breadcrumbs) - 1;
    foreach ($breadcrumbs as $i => $crumb):
        if ($i != 0) echo ' > '; // separator
        if ($i == $last_index): ?>
            <span class="breadcrumb-current"><?= htmlspecialchars($crumb['title']); ?></span>
        <?php else: ?>
            <a href="<?= htmlspecialchars($crumb['url']); ?>"><?= htmlspecialchars($crumb['title']); ?></a>
        <?php endif;
    endforeach;
    ?>
</nav>
<?php endif; ?>
