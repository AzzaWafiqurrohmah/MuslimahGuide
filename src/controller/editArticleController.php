<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\education;
use MuslimahGuide\Repository\EducationRepository;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Service\sessionService;

class editArticleController
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
    public function editArticle(){
        $user = $this->sessionService->current();
        $name = $user->getName();
        $profileImg = $user->getProfileImg();

        $id = $_GET['id'];
        $data = $this->educationRepo->getById($id);
        $data->setEducationId($id);

        view::render('editArticle', [
            'name' => $name,
            'profileImg' => $profileImg,
            'data' => $data
        ]);
    }

    public function postEditArticle(){
        $id = $_POST['education_id'];
        $this->education = $this->educationRepo->getById($id);

        $img = $_FILES['fileInput-edit']['name'];
        if($img == null){
            $img = $_POST['inputImg'];
        }
        $title = $_POST['title'];
        $content = $_POST['content'];

        $this->education->setEducationId($id);
        $this->education->setImg($img);
        $this->education->setTitle($title);
        $this->education->setContents($content);
        $this->educationRepo->update($this->education);

       view::redirect('article');
    }
}