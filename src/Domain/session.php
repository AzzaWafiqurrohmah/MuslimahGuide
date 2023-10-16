<?php

namespace MuslimahGuide\Domain;

class session
{
    private string $id;
    private user $user_id;

    /**
     * @param string $id
     * @param int $user_id
     */
    public function __construct(string $id, user $user_id)
    {
        $this->id = $id;
        $this->user_id = $user_id;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): user
    {
        return $this->user_id;
    }

    public function setUserId(user $user_id): void
    {
        $this->user_id = $user_id;
    }




}