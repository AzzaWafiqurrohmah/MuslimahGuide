<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;

class profile
{
    private UserRepository $userRepo;
    private SessionRepository $sessionRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository(database::getConnection());
        $this->sessionRepo = new SessionRepository(database::getConnection());
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
        $input_data = file_get_contents("php://input");
        $params = json_decode($input_data, true);
        $token = $params['token'];
        $user = new user(null,
                         $params['name'],
                         $params['birthdate'],
                         role::user,
                         $params['phone'],
                         $params['email'],
                         $params['username'],
                         $params['password']);

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
}