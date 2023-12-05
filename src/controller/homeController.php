<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Repository\VerificationRepository;
use MuslimahGuide\Service\adminService;
use MuslimahGuide\Service\sessionService;
use MuslimahGuide\Service\verificationService;

class homeController
{
    private SessionRepository $sessionRepo;
    private verificationService $verificationService;
    private VerificationRepository $verificationRepo;
    private UserRepository $userRepo;
    public function __construct()
    {
        $this->sessionRepo = new SessionRepository(database::getConnection());
        $this->userRepo = new UserRepository(database::getConnection());
        $this->verificationRepo = new VerificationRepository(database::getConnection());
        $this->verificationService = new verificationService($this->verificationRepo, $this->userRepo);
    }

    function landingPage(){
        $this->sessionRepo->expiredTime();
        view::render('landingPage');
    }

    function postLandingPage(){
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $phpmailer = $this->verificationService->sendEmailUser($email, $subject, $message);
        if($phpmailer->send()){
            view::render('landingPage');
        }
    }

    function image(){

    }

}