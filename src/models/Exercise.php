<?php

class Exercise
{
    private $exercise_name;
    private $sets;
    private $reps;
    private $weight;
    private $plan_id;
    private $id;

    public function __construct($plan_id, $exercise_name, $sets, $reps, $weight, $id = null)
    {
        $this->plan_id = $plan_id;
        $this->exercise_name = $exercise_name;
        $this->sets = $sets;
        $this->reps = $reps;
        $this->weight = $weight;
        $this->id = $id;
    }

    public function getExerciseName()
    {
        return $this->exercise_name;
    }

    public function setExerciseName($exercise_name): void
    {
        $this->exercise_name = $exercise_name;
    }

    public function getSets()
    {
        return $this->sets;
    }

    public function setSets($sets): void
    {
        $this->sets = $sets;
    }

    public function getReps()
    {
        return $this->reps;
    }

    public function setReps($reps): void
    {
        $this->reps = $reps;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    public function getPlanId()
    {
        return $this->plan_id;
    }

    public function setPlanId($plan_id): void
    {
        $this->plan_id = $plan_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }


}