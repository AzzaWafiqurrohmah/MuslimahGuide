<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Service\sessionService;
use MuslimahGuide\trait\APIResponser;

class profile
{
    use APIResponser;
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
            $this->successArray($user, 'Data Tersedia');
        } catch (\Exception $exception){
            $this->error($exception->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public function put_profile(){
        $token = $_POST['token'];

        $profileImg = null;
        if($_POST['profileImg']){
            $path = getcwd() . DIRECTORY_SEPARATOR . 'assetsWeb' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR;
            $profileImg = '/images/' . date("d-m-Y") . '-' . time() . '-' . rand(10000, 100000) . '.jpg';
            $data = base64_decode($_POST['profileImg']);

            file_put_contents($path . $profileImg, $data);
        }


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
            $this->success('Data berhasil diperbarui');
        } catch (\Exception $exception){
            $response = array(
                'status' => 0,
                'message' => $exception->getMessage()
            );
            $this->error($exception->getMessage());
        }
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
                $this->success('Password berhasil diperbarui');
            } else {
                $this->error('Password gagal diperbarui');
            }
        } else {
            $this->error('Token tidak ditemukan');
        }
    }

    public function signOut(){
        $token = $_POST['token'];
        $this->sessionRepo->deleteById($token);

        $res = $this->sessionRepo->findById($token);
        if($res == null){
            $this->success('Anda berhasil keluar');
        } else {
            $this->error('Token tidak valid');
        }
    }
}