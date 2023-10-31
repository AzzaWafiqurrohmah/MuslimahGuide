<?php

namespace MuslimahGuide\Middleware;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Service\sessionService;

class mustLoginMiddleware implements middleware
{

    private sessionService $sessionService;

    public function __construct()
    {
        $sessionRepo = new SessionRepository(database::getConnection());
        $userRepo = new UserRepository(database::getConnection());
        $this->sessionService = new sessionService($sessionRepo, $userRepo);
    }

    function before(): void
    {
        $user = $this->sessionService->current();
        if($user ==null) {
            view::redirect('/users/login');
        }
    }
}