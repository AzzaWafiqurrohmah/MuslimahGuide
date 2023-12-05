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

//        $_SESSION['EditArticle'] = 'hai';
        view::render('editArticle', [
            'name' => $name,
            'profileImg' => $profileImg,
            'data' => $data
        ]);
    }

    public function postEditArticle(){
        $id = $_POST['education_id'];
        $this->education = $this->educationRepo->getById($id);
        $alert = null;

        $img = $_FILES['fileInput-edit']['name'];
        if($img != null){
            if($_POST['inputImg'] != null){
                $img = $_POST['inputImg'];

                $destination_path = getcwd() . DIRECTORY_SEPARATOR . 'assetsWeb' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'education' . DIRECTORY_SEPARATOR;
                $targetFile = $destination_path . basename($img);

                if(file_exists($targetFile)){
                    unlink($targetFile);
                }
            }
            //move img
            $destination_path = getcwd() . DIRECTORY_SEPARATOR . 'assetsWeb' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'education' . DIRECTORY_SEPARATOR;
            $targetFile = $destination_path . basename($img);
            move_uploaded_file($_FILES["fileInput-edit"]["tmp_name"], $targetFile);
        }
        if($img == null){
            $img = $_POST['inputImg'];
        }



        $title = $_POST['title'];
        $content = $_POST['content'];

        $this->education->setEducationId($id);
        $this->education->setImg($img);
        $this->education->setTitle($title);
        $this->education->setContents($content);

//        $_SESSION['EditArticle'] = 'hai';
        $this->educationRepo->update($this->education);
       view::redirect('article');
    }
}