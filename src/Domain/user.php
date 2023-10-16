<?php

namespace MuslimahGuide\Domain;

class user{
    private int $id;
    private ?string $name;
    private ?\DateTime $birthDate;
    private string $role;
    private ?string $phone;
    private ?string $email;
    private ?string $username;
    private string $password;

    public function __construct(?string $name, ?\DateTime $birthDate, string $role, ?string $phone, ?string $email, ?string $username, string $password)
    {
        $this->name = $name;
        $this->birthDate = $birthDate;
        $this-> role = $role;
        $this->phone = $phone;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTime $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }



}