<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Plan.php';
require_once __DIR__.'/../repository/PlanRepository.php';
require_once __DIR__.'/../repository/ExerciseRepository.php';

class PlanController extends AppController
{
    private $planRepository;
    private $exerciseRepository;

    public function __construct()
    {
        parent::__construct();
        $this->planRepository = new PlanRepository();
        $this->exerciseRepository = new ExerciseRepository();
    }

    public function postPlan()
    {
        session_start();

        if (!$this->isPost()) {
            return $this->render('main');
        }

        $selectedDate = $_POST["selectedDate"];
        $_SESSION['selected_date'] = $selectedDate;
        $userEmail = $_SESSION['user_email'];

        $plan = $this->planRepository->getPlanByEmailAndDate($userEmail, $selectedDate);

        if ($plan) {
            // Zapisz plan_id oraz datę do sesji
            $_SESSION['plan_id'] = $plan->getId();
            $_SESSION['plan_name'] = $plan->getPlanName();

            $exercises = [];
            $exercises += $this->exerciseRepository->getExercisesByPlanId($plan->getId());

            $_SESSION['exercises'] = $exercises;
        }

        //Jeśli brak planu lub błąd, przekieruj na główną stronę
        $this->render('main');
    }

    public function addExercise() {
        session_start();
        if (!$this->isPost()) {
            return $this->render('addExercise');
        }

        // Pobranie danych z formularza
        $exerciseName = $_POST["exercise_name"];
        $sets = $_POST["sets"];
        $reps = $_POST["reps"];
        $weight = $_POST["weight"];

        $exerciseRepository = new ExerciseRepository();

        $exercise = new Exercise($_SESSION['plan_id'], $exerciseName, $sets, $reps, $weight);
        try {
            $exerciseRepository->addExercise($exercise);

        } catch (Exception $e) {
            $this->render('addExercise', ['error' => 'Add exercise failed: ' . $e->getMessage()]);
        }

        //header("Location: main");
        return $this->render('main', ['messages' => ['Added successful!']]);
    }
}