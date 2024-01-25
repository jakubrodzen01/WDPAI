<?php
require_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/main_style.css" />
    <script src="public/js/main.js" defer></script>
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
                    <form id="calendar" method="POST" action="postPlan">
                        <input type="date" id="datepicker" name="selectedDate" value="<?php echo date('Y-m-d'); ?>"
                            onchange="updateExerciseDay()">
                        <button class="addButton" type="submit">Show plan</button>
                    </form>
                </li>
                <li>
                    <a href="profile" class="button">Profile</a>
                </li>
            </ul>
        </nav>

        <main>
            <label style="color: #FFFFFF; display: flex; align-items: center; justify-content: center;">
                <?php
                if ($_SESSION['selected_date'] !== null) {
                    echo $_SESSION['selected_date'];
                } else {
                    echo 'Select date';
                }
                ?>
            </label>

            <section class="exerciseList">
                <?php if (!empty($_SESSION['exercises'])): ?>
                    <div class="plan-name">
                        <?php $exerciseList = $_SESSION['exercises']; ?>
                    </div>
                    <h1 style="color: #FFFFFF">
                        <?php echo $_SESSION['plan_name'] ?>
                    </h1>
                    <?php foreach ($exerciseList as $exercise): ?>

                        <div class="exerciseDetails">
                            <h2 id="exerciseName"><?= $exercise->getExerciseName(); ?></h2>
                            <p>Sets: <?= $exercise->getSets(); ?></p>
                            <p>Reps: <?= $exercise->getReps(); ?></p>
                            <p>Weight: <?= $exercise->getWeight(); ?></p>
                        </div>

                    <?php endforeach; ?>
                    <form action="addExercise" method="POST">
                        <button class="addButton" type="submit" value="Add exercise">ADD EXERCISE</button>
                    </form>
                <?php else: ?>
                    <p>No exercises available.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>

</html>