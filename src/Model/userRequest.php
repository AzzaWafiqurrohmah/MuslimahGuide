<?php

namespace MuslimahGuide\Model;

use MuslimahGuide\Exception\validationException;

class userRequest
{
    public ?string $username = null;
    public ?string $password = null;

    public function validateUserLoginRequest($username, $password){
        $this->username = $username;
        $this->password = $password;

        if($this->username == null || $this->password == null || trim($this->username) == "" || trim($this->password) == null){
            throw new validationException();
        }
    }
}