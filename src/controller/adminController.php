<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\adminRequest;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\service\adminService;
use MuslimahGuide\Service\sessionService;

class adminController
{
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

    function login(){
        view::render('login');
    }

    function postLogin(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['manual'])){

                $request = new adminRequest();
                $request->username = $_POST['username'];
                $request->password = $_POST['password'];

                try {
                    $response = $this->userService->login($request);
                    $this->sessionService->create($response->user);
                    view::redirect('dashboard');
                } catch (validationException $exception){
                    view::render('login');
                }

            }
        }
    }

    function loginAPI(){
        $request = new adminRequest();
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

    function registerAPI(){
        $request = new adminRequest();
        $request->username = $_GET['username'];
        $request->password = $_GET['password'];

        try {
            $this->userService->register($request);
            $response = array(
                'status' => 1,
                'message' => 'Register berhasil'
            );
        } catch (validationException $exception){
            $response = array(
                'status' => 0,
                'message' => 'Register gagal'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}