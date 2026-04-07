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
// Breadcrumb system: check if $breadcrumbs is set
if (!isset($breadcrumbs)) $breadcrumbs = [];

if (!empty($breadcrumbs)): ?>
<nav aria-label="breadcrumb" class="breadcrumb-container" style="margin: 15px 0;">
    <ol class="breadcrumb">
        <?php
        $last_index = count($breadcrumbs) - 1;
        foreach ($breadcrumbs as $i => $crumb):
            if ($i == $last_index): ?>
                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($crumb['title']); ?></li>
            <?php else: ?>
                <li class="breadcrumb-item"><a href="<?= htmlspecialchars($crumb['url']); ?>"><?= htmlspecialchars($crumb['title']); ?></a></li>
            <?php endif;
        endforeach;
        ?>
    </ol>
</nav>
<?php endif; ?>
