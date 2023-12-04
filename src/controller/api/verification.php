<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\verificationRequest;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Repository\VerificationRepository;
use MuslimahGuide\Service\adminService;
use MuslimahGuide\Service\verificationService;
use MuslimahGuide\trait\APIResponser;

class verification
{
    use APIResponser;
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
                $this->successValue($response->verification->getVerificationId(), 'kode berhasi dikirm', 'verification_Id' );
            } else{
                throw new validationException($phpmailer->ErrorInfo);
            }
        } catch (validationException $e){
            $this->error($e->getMessage());
        }
    }

    public function otpVerification(){
        $request = new verificationRequest();
        $request->verification_id = $_POST['verification_id'];
        $request->code = $_POST['code'];

        try {
            $code = $this->verificationService->otpVerification($request);
            if($code){
                $this->success("Kode OTP sesuai");
            } else {
                throw new validationException("Kode tidak sesuai");
            }
        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }

    public function newPassword(){
        $request = new verificationRequest();
        $request->verification_id = $_POST['verification_id'];
        $request->password = $_POST['firstPassword'];

        try {
            $this->verificationService->newPassword($request);
            $this->success("Password berhasil diperbarui");
        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }

}