<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Repository\EducationRepository;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Service\adminService;
use MuslimahGuide\Service\sessionService;

class articleController
{
    private UserRepository $userRepo;
    private adminService $adminService;
    private sessionService $sessionService;
    private EducationRepository $educationRepo;

    public function __construct()
    {
        $connection = database::getConnection();
        $this->userRepo = new UserRepository($connection);
        $this -> adminService = new adminService($this->userRepo);

        $sessionRepo = new SessionRepository($connection);
        $this->sessionService = new sessionService($sessionRepo, $this->userRepo);
        $this->educationRepo = new EducationRepository($connection);
    }

    public function article(){
        //header name
        $user = $this->sessionService->current();
        $name = $user->getName();
        $profileImg = $user->getProfileImg();

        $data = $this->educationRepo->getAll();

        view::render('article', [
            'name' => $name,
            'profileImg' => $profileImg,
            'data' => $data
        ]);
    }
    public function postArticle(){
        if(isset($_POST['deleteUser'])) {
            $id = $_POST['education_id_delete'];
            $this->educationRepo->delete($id);
        }
        $user = $this->sessionService->current();
        $name = $user->getName();
        $profileImg = $user->getProfileImg();

        $data = $this->educationRepo->getAll();

        view::render('article', [
            'name' => $name,
            'profileImg' => $profileImg,
            'data' => $data
        ]);
    }
}
