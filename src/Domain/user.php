<?php

namespace MuslimahGuide\Domain;

class user{
    private int $id;
    private ?string $profileImg;
    private ?string $name;
    private ?string $birthDate;
    private string $role;
    private ?string $phone;
    private ?string $email;
    private ?string $username;
    private string $password;

    public function __construct(?string $profileImg ,?string $name, ?string $birthDate, string $role, ?string $phone, ?string $email, ?string $username, ?string $password)
    {
        $this->profileImg = $profileImg;
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

    public function getProfileImg(): ?string
    {
        return $this->profileImg;
    }

    public function setProfileImg(?string $profileImg): void
    {
        $this->profileImg = $profileImg;
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

    public function setBirthDate(?string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getPhone(): ?string
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

    public function getPassword(): ?string
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