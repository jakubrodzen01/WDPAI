<?php
require_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/profile_style.css" />
    <script src="public/js/profile.js" defer></script>
    <title>Profile</title>
</head>

<body>
    <div class="avatar">
        <img src="public/img/avatar.svg">
    </div>

    <p>
        <?php echo $_SESSION['user_name'] . ' ' . $_SESSION['user_surname']; ?>
    </p>
    <?php if ($_SESSION['user_email'] === 'admin'): ?>
        <button class="adminPanel" onclick="goToAdminPanel()">ADMIN PANEL</button>
    <?php endif; ?>
    <form class="logout_form" action="logout" method="GET">
        <button class="logout_button" type="submit">LOGOUT</button>
    </form>
</body>

</html>