<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\service\adminService;
use MuslimahGuide\Service\sessionService;

class userTableController
{
    private user $user;
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
    public function userTable(){
        //header name
        $userProfile = $this->sessionService->current();
        $name = $userProfile->getName();
        $profileImg = $userProfile->getProfileImg();

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if(isset($_POST['addUser'])){
                $username = $_POST['validationCustomUsername'];
                $email = $_POST['validationCustom01'];
                $password = $_POST['validationCustom02'];

                $this->user = new user(null, null, null, role::user, null, $email, $username, $password);
                $this->userRepo->addAll($this->user);
            } else if(isset($_POST['editUser'])){
                $username = $_POST['validationCustomUsername'];
                $email = $_POST['validationCustom01'];
                $password = $_POST['validationCustom02'];
                $id = $_POST['user_id_edit'];

                $this->user = $this->userRepo->getById($id);
                $this->user->setEmail($email);
                $this->user->setUsername($username);
                $this->user->setPassword($password);

                $this->userRepo->update($this->user);
            } else {
                $id = $_POST['user_id_delete'];
                $this->userRepo->delete($id);
            }
        }

        //table
        $data = $this->userRepo->userTable();

        view::render('userTable',[
            'name' => $name,
            'data' => $data,
            'profileImg' => $profileImg
        ]);
    }
}