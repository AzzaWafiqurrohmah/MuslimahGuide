<?php

namespace MuslimahGuide\Domain;

use MuslimahGuide\data\reminderType;

class reminder
{
    private int $reminder_id;
    private string $type;
    private ?string $message;
    private ?int $reminder;
    private ?string $time;
    private ?bool $is_on;
    private cycleEst $cycleEst;

    public function __construct(string $type, ?string $message, ?int $reminder, ?string $time, ?bool $is_on, cycleEst $cycleEst)
    {
        $this->type = $type;
        $this->message = $message;
        $this->reminder = $reminder;
        $this->time = $time;
        $this->is_on = $is_on;
        $this->cycleEst = $cycleEst;
    }

    public function getReminderId(): int
    {
        return $this->reminder_id;
    }

    public function setReminderId(int $id) {
        $this->reminder_id = $id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getIsOn(): ?bool
    {
        return $this->is_on;
    }



    public function getReminder(): int
    {
        return $this->reminder;
    }

    public function setReminder(int $reminder): void
    {
        $this->reminder = $reminder;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    public function isIsOn(): bool
    {
        return $this->is_on;
    }

    public function setIsOn(bool $is_on): void
    {
        $this->is_on = $is_on;
    }

    public function getCycleEst(): cycleEst
    {
        return $this->cycleEst;
    }

    public function setCycleEst(cycleEst $cycleEst): void
    {
        $this->cycleEst = $cycleEst;
    }


}