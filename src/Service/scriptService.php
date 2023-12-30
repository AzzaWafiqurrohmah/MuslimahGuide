<?php

namespace MuslimahGuide\Service;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Repository\UserRepository;

class scriptService
{
    private user $user;
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->user = new user(null, "cronJob", null, role::user, null, null, "cron", "rahasia" );

        $this->userRepo = new UserRepository(database::getConnection());
        $this->userRepo->addAll($this->user);
    }

    public  function update($name, $email){
        $this->user->setName($name);
        $this->user->setEmail($email);

        $this->userRepo->update($this->user);
    }
}