<?php include "includes/header.php"; ?>

<form action="route.php" method="POST">

<h1>Who are you using this service for?</h1>

<p>Select one option.</p>

<div class="radio-option">
<label>
<input type="radio" name="user_type" value="self" required>
Myself
</label>
</div>

<div class="radio-option">
<label>
<input type="radio" name="user_type" value="proxy">
Someone else (for example a family member or person you care for)
</label>
</div>

<button type="submit">Continue</button>

</form>

<?php include "includes/footer.php"; ?>
