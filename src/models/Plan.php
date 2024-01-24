<?php

class Plan
{
    private $planName;
    private $userId;
    private $date;
    private $id;

    public function __construct(string $planName, int $userId, string $date, int $id = null)
    {
        $this->planName = $planName;
        $this->userId = $userId;
        $this->date = $date;
        $this->id = $id;
    }


    public function getPlanName(): string
    {
        return $this->planName;
    }

    public function setPlanName(string $planName): void
    {
        $this->planName = $planName;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

}