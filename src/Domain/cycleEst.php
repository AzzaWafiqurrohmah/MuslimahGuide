<?php

namespace MuslimahGuide\Domain;

class cycleEst
{
    private int $id;
    private ?int $cycleLength;
    private ?int $periodLength;
    private ?string $startDate;
    private ?string $endDate;
    private ?user $user_id;


    public function __construct(?int $cycleLength, ?int $periodLength, ?string $startDate, ?string $endDate, ?user $user_id)
    {
        $this->cycleLength = $cycleLength;
        $this->periodLength = $periodLength;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->user_id = $user_id;
    }

    public function getCycleLength(): ?int
    {
        return $this->cycleLength;
    }

    public function setCycleLength(?int $cycleLength): void
    {
        $this->cycleLength = $cycleLength;
    }

    public function getPeriodLength(): ?int
    {
        return $this->periodLength;
    }

    public function setPeriodLength(?int $periodLength): void
    {
        $this->periodLength = $periodLength;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(?string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(?string $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getUser_id(): ?user
    {
        return $this->user_id;
    }

    public function setUser_id(?user $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }




}