<?php

namespace MuslimahGuide\Model;

use MuslimahGuide\Exception\validationException;

class adminRequest
{
    public ?string $email = null;
    public ?string $password = null;

    public function validateUserRequest($email, $password){
        $this->email = $email;
        $this->password = $password;

        if($this->email == null || $this->password == null || trim($this->email) == "" || trim($this->password) == null){
            throw new validationException();
        }
    }


}