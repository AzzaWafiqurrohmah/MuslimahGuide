<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Repository\EducationRepository;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\service\adminService;
use MuslimahGuide\Service\sessionService;

class dashboardController
{
    private UserRepository $userRepo;
    private adminService $userService;
    private sessionService $sessionService;
    private EducationRepository $educationRepo;


    public function __construct()
    {
        $connection = database::getConnection();
        $this->userRepo = new UserRepository($connection);
        $this -> userService = new adminService($this->userRepo);

        $sessionRepo = new SessionRepository($connection);
        $this->sessionService = new sessionService($sessionRepo, $this->userRepo);
        $this->educationRepo = new EducationRepository($connection);
    }

    function dashboard(){
        //header name
        $user = $this->sessionService->current();
        $name = $user->getName();
        $profileImg = $user->getProfileImg();

        //dashboard chart
        $data = $this->userRepo->chart();

        //dashboard education
        $education = $this->educationRepo->dashboard();

        view::render('dashboard', [
            'name' => $name,
            'data' => $data,
            'education' => $education,
            'profileImg' => $profileImg
        ]);
    }

    function postDashboard(){
        if(isset($_POST['sign-out'])){
            $this->sessionService->destroy();
            view::redirect('login');
        }
    }

}