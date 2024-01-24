<?php
require_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/profile_style.css" />
    <title>Profile</title>
</head>

<body>
    <nav>
        <div class="avatar">
            <img src="public/img/avatar.svg">
        </div>

        <ul>
                    <li>
                        <label><?php echo $_SESSION['user_name'].' '.$_SESSION['user_surname']; ?></label>
                    </li>
                    <li>
                        <form class="logout_form" action="logout" method="GET">
                            <button class="logout_button" type="submit">LOGOUT</button>
                        </form>
                    </li>
        </ul>
    </nav>
</body>

</html>