<?php

namespace MuslimahGuide\Model\api;

class reminderRequest
{
    public string $token;
    public string $reminder_id;
    public string $cycleEst_id;
    public string $message;
    public string $reminderDays;
    public string $reminderTime;
    public string $is_on;

}