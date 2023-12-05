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
        $alert = null;
        if(isset($_POST['deleteUser'])) {
            $id = $_POST['education_id_delete'];
            $education = $this->educationRepo->getById($id);
            if($education->getImg() != null){
                $img = $education->getImg();

                $destination_path = getcwd() . DIRECTORY_SEPARATOR . 'assetsWeb' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'education' . DIRECTORY_SEPARATOR;
                $targetFile = $destination_path . basename($img);

                if(file_exists($targetFile)){
                    unlink($targetFile);
                }
            }

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
