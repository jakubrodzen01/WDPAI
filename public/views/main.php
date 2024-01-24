<?php
require_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/main_style.css" />
    <script src="public/js/main.js"></script>
    <title>Main</title>
</head>

<body>
<div class="base_container">
    <header>
        <img src="public/img/calendar.svg">
        <img src="public/img/more.svg">
    </header>

    <nav>
        <img src="public/img/logo_green.svg">
        <ul>
            <li>
                <form method="POST" action="postPlan">
                    <input type="date" id="datepicker" name="selectedDate" value="<?php echo date('Y-m-d'); ?>" onchange="updateExerciseDay()">
                    <button type="submit">Show plan</button>
                </form>
            </li>
            <li>
                <a href="profile" class="button">Profile</a>
            </li>
        </ul>
    </nav>

    <main>
        <label style="color: #FFFFFF">
            <?php
            if ($_SESSION['selected_date'] !== null) {
                echo $_SESSION['selected_date'];
            } else {
                echo 'Select date';
            }
            ?>
        </label>

        <section class="exerciseList">
            <?php $exerciseList = $_SESSION['exercises']; ?>
            <h1 style="color: #FFFFFF"><?php echo $_SESSION['plan_name']?></h1>
            <?php foreach ($exerciseList as $exercise): ?>

                <div style="color: #FFFFFF">
                    <h2><?=$exercise->getExerciseName(); ?></h2>
                    <p>Sets: <?=$exercise->getSets(); ?></p>
                    <p>Reps: <?=$exercise->getReps(); ?></p>
                    <p>Weight: <?=$exercise->getWeight(); ?></p>
                </div>

            <?php endforeach; ?>
            <form id="add_button" method="POST" action="addExercise">
                <input type="submit" value="Add exercise">
            </form>
        </section>
    </main>
</div>
</body>

</html>
