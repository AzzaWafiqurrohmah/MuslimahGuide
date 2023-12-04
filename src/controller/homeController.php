<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Service\adminService;
use MuslimahGuide\Service\sessionService;

class homeController
{
    private SessionRepository $sessionRepo;
    public function __construct()
    {
        $this->sessionRepo = new SessionRepository(database::getConnection());
    }

    function landingPage(){
        $this->sessionRepo->expiredTime();
        view::render('landingPage');
    }

    function postLandingPage(){
        view::redirect('login');
    }

    function image(){

    }

}