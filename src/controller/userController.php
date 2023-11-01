<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\userRequest;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Service\sessionService;
use MuslimahGuide\Service\userService;

class userController
{
    private userService $userService;
    private sessionService $sessionService;
    public function __construct()
    {
        $connection = database::getConnection();
        $userRepo = new UserRepository($connection);
        $this -> userService = new userService($userRepo);

        $sessionRepo = new SessionRepository($connection);
        $this->sessionService = new sessionService($sessionRepo, $userRepo);
    }

    function login(){
        view::render('login');
    }

    function postLogin(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['manual'])){

                $request = new userRequest();
                $request->username = $_POST['username'];
                $request->password = $_POST['password'];

                try {
                    $response = $this->userService->login($request);
                    if($_POST['remember'] == "true"){
                        $this->sessionService->create($response->user);
                    }
                    view::redirect('dashboard');
                } catch (validationException $exception){
                    view::render('login');
                }

            }
        }
    }

    function loginAPI(){
        $request = new userRequest();
        $request->username = $_GET['username'];
        $request->password = $_GET['password'];

        try {
            $this->userService->login($request);
            $response = array(
                'status' => 1,
                'message' => 'login berhasil'
            );
        } catch (validationException $exception){
            $response = array(
                'status' => 0,
                'message' => 'login gagal'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function dashboard(){
        view::render('dashboard');
    }
}