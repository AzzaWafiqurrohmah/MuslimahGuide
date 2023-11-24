<?php

namespace MuslimahGuide\Domain;

class changePrayer
{
    private int $id;
    private string $prayer;
    private string $status;
    private cycleHistory $cycleHistory;

    public function __construct(?string $prayer, string $status, cycleHistory $cycleHistory)
    {
        $this->prayer = $prayer;
        $this->status = $status;
        $this->cycleHistory = $cycleHistory;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPrayer(): string
    {
        return $this->prayer;
    }

    public function setPrayer(string $prayer): void
    {
        $this->prayer = $prayer;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getCycleHistory(): cycleHistory
    {
        return $this->cycleHistory;
    }

    public function setCycleHistory(cycleHistory $cycleHistory): void
    {
        $this->cycleHistory = $cycleHistory;
    }




}