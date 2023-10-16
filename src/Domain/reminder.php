<?php

namespace MuslimahGuide\Domain;

use MuslimahGuide\data\reminderType;

class reminder
{
    private int $reminder_id;
    private string $type;
    private ?string $message;
    private ?int $reminder;
    private ?\DateTime $time;
    private ?bool $is_on;
    private ?bool$is_read;
    private user $user_id;

    /**
     * @param int $reminder_id
     * @param reminderType $type
     * @param string $message
     * @param int|null $reminder
     * @param \DateTime|null $time
     * @param bool|null $is_on
     * @param user $user_id
     */
    public function __construct(string $type, ?string $message, ?int $reminder, ?\DateTime $time, ?bool $is_on, ?bool $is_read, user $user_id)
    {
        $this->type = $type;
        $this->message = $message;
        $this->reminder = $reminder;
        $this->time = $time;
        $this->is_on = $is_on;
        $this->is_read = $is_read;
        $this->user_id = $user_id;
    }


    public function getReminderId(): int
    {
        return $this->reminder_id;
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

    public function getTime(): \DateTime
    {
        return $this->time;
    }

    public function setTime(\DateTime $time): void
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

    public function getUserId(): user
    {
        return $this->user_id;
    }

    public function setUserId(user $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getIsRead(): ?bool
    {
        return $this->is_read;
    }

    public function setIsRead(?bool $is_read): void
    {
        $this->is_read = $is_read;
    }


}