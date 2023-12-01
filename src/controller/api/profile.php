<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Service\sessionService;

class profile
{
    private UserRepository $userRepo;
    private SessionRepository $sessionRepo;
    private sessionService $sessionService;

    public function __construct()
    {
        $this->userRepo = new UserRepository(database::getConnection());
        $this->sessionRepo = new SessionRepository(database::getConnection());

        $this->sessionService = new sessionService($this->sessionRepo, $this->userRepo);
    }

    public function get_profile(){
        $token = $_GET['token'];

        try{
            if(!$token) throw new \Exception('Harap login terlebih dahulu');

            $session = $this->sessionRepo->findById($token);

            if(!($session )) throw new \Exception('Invalid token');

            $user = $this->userRepo->getByIdAPI($session->getUserId()->getId());
            $response = array(
                'status' => 1,
                'data' => $user
            );
        } catch (\Exception $exception){
            $response = array(
                'status' => 0,
                'message' => $exception->getMessage()
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    /**
     * @throws \Exception
     */
    public function put_profile(){
        $token = $_POST['token'];

        $profileImg = $_POST['profileImg'];
        $name = $_POST['name'];
        $birthDate = $_POST['birthDate'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = new user(
            $profileImg,
            $name,
            $birthDate,
            role::user,
            $phone,
            $email,
            $username,
            $password
        );

        try {
            if(!$token) throw new \Exception('Harap login terlebih dahulu');
            $session = $this->sessionRepo->findById($token);
            if(!$session){
                throw new \Exception('Invalid token');
            }

            $user->setId($session->getUserId()->getId());
            $this->userRepo->update($user);
            $response = array(
                'status' => 1,
                'message' => "Data berhasil diperbarui"
            );
        } catch (\Exception $exception){
            $response = array(
                'status' => 0,
                'message' => $exception->getMessage()
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function put_cycle(){

    }

    public function get_cycle(){

    }

    public function post_password(){
        $token = $_POST['token'];
        $pass = $_POST['password'];
        $response = [];

        $session = $this->sessionRepo->getById($token);

        if($session !== null){
            $user_id = $session->getUserId()->getId();

            $user = $this->userRepo->getById($user_id);
            $user->setPassword($pass);
            if($this->userRepo->update($user)){
                $response = array(
                    'status' => 1,
                    'message' => "Password berhasil diperbarui"
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => "Password Gagal diperbarui"
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => "Token tidak ditemukan"
            );
        }


        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function signOut(){
        $token = $_POST['token'];
        $this->sessionRepo->deleteById($token);

        $res = $this->sessionRepo->findById($token);
        if($res == null){
            $response = array(
                'status' => 1,
                'message' => "Anda berhasil keluar"
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => "Token anda tidak sesuai"
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}