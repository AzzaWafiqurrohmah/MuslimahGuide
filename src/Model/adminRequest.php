<?php

namespace MuslimahGuide\Model;

use MuslimahGuide\Exception\validationException;

class adminRequest
{
    public ?string $email = null;
    public ?string $username = null;
    public ?string $password = null;

    public function validateUserMobileRequest($email, $password){
        $this->email = $email;
        $this->password = $password;

        if($this->email == null || $this->password == null || trim($this->email) == "" || trim($this->password) == null){
            throw new validationException();
        }
    }

    public function validateUserWebRequest($username, $password){
        $this->username = $username;
        $this->password = $password;

        if($this->username == null || $this->password == null || trim($this->username) == "" || trim($this->password) == null){
            throw new validationException();
        }
    }

    public function validateUserEmailRequest($email){
        $this->email = $email;

        if($this->email == null || trim($this->email) == ""){
            throw new validationException();
        }
    }


}