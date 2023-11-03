<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\service\adminService;
use MuslimahGuide\Service\sessionService;

class dashboardController
{
    private UserRepository $userRepo;
    private adminService $userService;
    private sessionService $sessionService;

    public function __construct()
    {
        $connection = database::getConnection();
        $this->userRepo = new UserRepository($connection);
        $this -> userService = new adminService($this->userRepo);

        $sessionRepo = new SessionRepository($connection);
        $this->sessionService = new sessionService($sessionRepo, $this->userRepo);
    }

    function dashboard(){
        //header name
        $user = $this->sessionService->current();
        $name = $user->getName();

        //dashboard chart
        $data = $this->userRepo->chart();

        view::render('dashboard', [
            'name' => $name,
            'data' => $data
        ]);
    }
}