<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\Config\database;
use MuslimahGuide\Model\verificationRequest;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Repository\VerificationRepository;
use MuslimahGuide\Service\adminService;
use MuslimahGuide\Service\verificationService;

class verification
{
    private UserRepository $userRepo;
    private adminService $adminService;
    private VerificationRepository $verificationRepo;
    private verificationService $verificationService;

    public function __construct()
    {
        $connection = database::getConnection();
        $this->userRepo = new UserRepository($connection);
        $this->verificationRepo = new VerificationRepository($connection);

        $this -> adminService = new adminService($this->userRepo);
        $this->verificationService = new verificationService($this->verificationRepo, $this->userRepo);

    }
    public function emailVerification(){
        $email = $_POST['email'];

        $request = new verificationRequest();
        $request->email = $email;

        try {
            $response = $this->verificationService->emailVerification($request);
            $phpmailer = $this->verificationService->sendEmail($email, $response->verification->getUser()->getName(), $response->verification->getCode());

            if($phpmailer->send()){
                $response = array(
                    'status' => 1,
                    'message' => 'Kode Berhasil Dikirim',
                    'verification_id' => $response->verification->getVerificationId()
                );
            } else{
                throw new \Exception($phpmailer->ErrorInfo);
            }
        } catch (\Exception $e){
            $response = array(
                'status' => 0,
                'message' => $e->getMessage()
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function otpVerification(){
        $verification_id = $_POST['verification_id'];
        $code = $_POST['code'];

        $verification = $this->verificationRepo->getById($verification_id);
        if($verification->getCode()){
            if($code == $verification->getCode()){
                $response = array(
                    'status' => 1,
                    'message' => 'Kode Sesuai'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Kode Salah'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'id tidak ditemukan'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function newPassword(){
        $verification_id = $_POST['verification_id'];
        $firstPassword = $_POST['firstPassword'];

        $verification = $this->verificationRepo->getById($verification_id);
        $user = $verification->getUser();

        $response = [];
        $user->setPassword($firstPassword);
        $this->verificationRepo->delete($verification_id);

        if($this->userRepo->update($user)){
            $response = array(
                'status' => 1,
                'message' => 'Password berhasil diperbarui'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Password gagal diperbarui'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}