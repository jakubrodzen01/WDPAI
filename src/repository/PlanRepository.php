<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Plan.php';
require_once __DIR__.'/../repository/PlanRepository.php';

class PlanRepository extends Repository
{
    public function getPlanByEmailAndDate(string $email, string $date) :? Plan
    {
        unset($_SESSION['plan_name']);
        unset($_SESSION['exercises']);
        $stmt = $this->database->connect()->prepare('
            SELECT *, p.id as id
            FROM public.plans p
            JOIN public.users u ON p.user_id = u.id
            WHERE u.email = :email AND p.date = :date
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->execute();

        $planData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($planData === false) {
            return null;
        }

        return new Plan($planData['plan_name'], $planData['user_id'], $planData['date'], $planData['id']);
    }
}