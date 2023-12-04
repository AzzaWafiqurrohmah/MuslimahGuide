<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Exception\validationException;
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
            if(!($session )) throw new \Exception('token tidak valid');

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
                throw new \Exception('token tidak valid');
            }

            $user->setId($session->getUserId()->getId());
            $this->userRepo->update($user);
            $this->success('Data berhasil diperbarui');
        } catch (\Exception $exception){
            $this->error($exception->getMessage());
        }
    }

    public function post_password(){
        $token = $_POST['token'];
        $pass = $_POST['password'];

        try{
            if(!$token) throw new validationException('Harap login terlebih dahulu');

            $session = $this->sessionRepo->findById($token);
            if(!($session )) throw new validationException('token tidak valid');

            $user = $this->userRepo->getById($session->getUserId()->getId());
            $user->setPassword($pass);
            $this->userRepo->update($user);

            $this->success('Password berhasil diperbarui');
        }catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }

    public function signOut(){
        $token = $_POST['token'];

        try {
            if(!$token) throw new validationException('Harap login terlebih dahulu');

            $session = $this->sessionRepo->findById($token);
            if(!($session )) throw new validationException('token tidak valid');

            $this->sessionRepo->deleteById($token);
            $this->success('Anda berhasil keluar');
        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }
}