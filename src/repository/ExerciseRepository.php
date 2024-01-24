<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Exercise.php';
require_once __DIR__.'/../repository/ExerciseRepository.php';

class ExerciseRepository extends Repository
{
    public function getExercisesByPlanId(int $planId): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT *
            FROM public.exercises
            WHERE plan_id = :planId
        ');

        $stmt->bindParam(':planId', $planId, PDO::PARAM_INT);
        $stmt->execute();

        $exercises = [];

        while ($exerciseData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $exercise = new Exercise(
                $exerciseData['plan_id'],
                $exerciseData['exercise_name'],
                $exerciseData['sets'],
                $exerciseData['reps'],
                $exerciseData['weight'],
                $exerciseData['id']
            );

            $exercises[] = $exercise;
        }

        return $exercises;
    }

    public function addExercise(Exercise $exercise) {
        {
            $stmt = $this->database->connect()->prepare('
            INSERT INTO public.exercises (plan_id, exercise_name, sets, reps, weight)
            VALUES (:plan_id, :exercise_name, :sets, :reps, :weight)
        ');
            $planId = $exercise->getPlanId();
            $exerciseName = $exercise->getExerciseName();
            $sets = $exercise->getSets();
            $reps = $exercise->getReps();
            $weight = $exercise->getWeight();


            $stmt->bindParam(':plan_id', $planId, PDO::PARAM_INT);
            $stmt->bindParam(':exercise_name', $exerciseName, PDO::PARAM_STR);
            $stmt->bindParam(':sets', $sets, PDO::PARAM_INT);
            $stmt->bindParam(':reps', $reps, PDO::PARAM_INT);
            $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);

            $stmt->execute();
        }
    }
}
