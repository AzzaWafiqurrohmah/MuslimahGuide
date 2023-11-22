<?php

namespace MuslimahGuide\Domain;

class verification
{
    private int $verification_id;
    private ?string $code;
    private user $user;
    public function __construct(?string $code, user $user)
    {
        $this->code = $code;
        $this->user = $user;
    }

    public function getVerificationId(): int
    {
        return $this->verification_id;
    }

    public function setVerificationId(int $verification_id): void
    {
        $this->verification_id = $verification_id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?int $code): void
    {
        $this->code = $code;
    }

    public function getUser(): user
    {
        return $this->user;
    }

    public function setUser(user $user): void
    {
        $this->user = $user;
    }




}