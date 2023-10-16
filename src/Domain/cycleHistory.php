<?php

namespace MuslimahGuide\Domain;

class cycleHistory
{
    private int $id;
    private ?int $cycleLength;
    private ?int $periodLength;
    private ?\DateTime $startDate;
    private ?\DateTime $endDate;
    private ?user $user_id;


    public function __construct(?int $cycleLength, ?int $periodLength, ?\DateTime $startDate, ?\DateTime $endDate, ?user $user_id)
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

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): void
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
}