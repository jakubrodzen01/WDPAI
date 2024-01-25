<?php
require_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/admin_style.css" />
    <script src="public/js/admin.js" defer></script>
    <title>Admin Panel</title>
</head>

<body>
    <h1>
        <img src="public/img/logo_green.svg">
        Delete user
    </h1>

    <div class="usersList">
        <?php
        if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
            foreach ($_SESSION['users'] as $user):
                ?>
                <p id="user_<?php echo $user->getId(); ?>" onclick="deleteUser(<?php echo $user->getId(); ?>)">
                    Email: <?php echo $user->getEmail() ?><br>
                    Name: <?php echo $user->getName() ?><br>
                    Surname: <?php echo $user->getSurname() ?><br>
                    Gender: <?php echo $user->getGender() ?><br>
                </p>
            <?php
            endforeach;
        } else {
            echo '<p>No users.</p>';
        }
        ?>
    </div>
</body>

</html>