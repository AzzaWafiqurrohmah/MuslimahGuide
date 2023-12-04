<?php

namespace MuslimahGuide\controller;

require_once __DIR__ . "/../../config/google-login.php";

use Google_Service_Oauth2;
use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\adminRequest;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Service\adminService;
use MuslimahGuide\Service\sessionService;
use MuslimahGuide\trait\APIResponser;

class adminController
{
    use APIResponser;
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
        global $client;
        $urlAuth = $client->createAuthUrl();

        if (isset($_GET['code'])){
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token);

            $googleAuth = new Google_Service_Oauth2($client);
            $google_info = $googleAuth->userinfo->get();

            $request = new adminRequest();
            $request->email = $google_info->email;

            try {
                $response = $this->userService->loginEmail($request);
                $this->sessionService->create($response->user);
                session_start();
                view::redirect('/dashboard');
            } catch (validationException $exception){
                view::render('/login');
            }

            $client->revokeToken();  //for ask what email that will be used in every request
            exit();

        }

        view::render('login', [
            'auth' => $urlAuth
        ]);
    }

    function postLogin(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['manual'])){

                $request = new adminRequest();
                $request->username = $_POST['username'];
                $request->password = $_POST['password'];

                try {
                    $response = $this->userService->loginWeb($request);
                    $this->sessionService->create($response->user);
                    view::redirect('/dashboard');
                } catch (validationException $exception){
                    view::render('/login');
                }

            }
        }
    }


    function loginAPI(){
        $request = new adminRequest();
        $request->email = $_POST['email'] ?? null;
        $request->password = $_POST['password'] ?? null;


        try {
            $response = $this->userService->login($request);
            $token = $this->sessionService->create($response->user);
            $this->successValue( $token->getId(),"Login Berhasil", 'token');
        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }

    function registerAPI(){

        $request = new adminRequest();
        $request->email = $_POST['email'] ?? null;
        $request->username = $_POST['username'] ?? null;
        $request->password = $_POST['password'] ?? null;


        try {
            $this->userService->register($request);
            $this->success("Register berhasil");

        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }
}
