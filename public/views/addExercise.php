<?php
require_once 'session.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="public/css/profile_style.css" />
        <title>Add Exercise</title>
    </head>

    <body>
        <div class="messages" style="color: white; text-align: center; margin-bottom: 1em;">
            <?php if(isset($messages)) {
                foreach ($messages as $message){
                    echo $message;
                }
            }
            ?>
        </div>
        <form class="addExercise" action="addExercise" method="POST">
            <input name="exercise_name" type="text" placeholder="exercise name">
            <input name="sets" type="number" placeholder="sets">
            <input name="reps" type="number" placeholder="reps">
            <input name="weight" type="number" placeholder="weight">
            <button type="submit">ADD EXERCISE</button>
        </form>
    </body>
</html>