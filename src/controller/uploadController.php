<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\education;
use MuslimahGuide\Repository\EducationRepository;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Service\sessionService;

class uploadController
{
    private education $education;
    private EducationRepository $educationRepo;
    private UserRepository $userRepo;
    private SessionRepository $sessionRepo;
    private sessionService $sessionService;

    public function __construct(){
        $connection = database::getConnection();
        $this->userRepo = new UserRepository($connection);
        $this-> sessionRepo = new SessionRepository($connection);

        $this->sessionService = new sessionService($this->sessionRepo, $this->userRepo);

        $this->educationRepo = new EducationRepository($connection);
    }

    public function upload(){
        $user = $this->sessionService->current();
        $name = $user->getName();
        $profileImg = $user->getProfileImg();

        view::render('uploadArticle', [
            'name' => $name,
            'profileImg' => $profileImg
        ]);
    }

    public function postUpload(){
        // get img
        $Img = $_FILES['fileInput']['name'];

        //move img
        $targetDirectory = "assets/img/education/";
        $targetFile = $targetDirectory . basename($Img);
        move_uploaded_file($_FILES["fileInput"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . '/' . $targetFile);

        $title = $_POST['title'];
        $content = $_POST['content'];

        $this->education = new education($Img, $title, $content, 0);
        $this->educationRepo->add($this->education);

        $user = $this->sessionService->current();
        $name = $user->getName();
        $profileImg = $user->getProfileImg();

        view::render('uploadArticle', [
            'name' => $name,
            'profileImg' => $profileImg
        ]);
    }
}