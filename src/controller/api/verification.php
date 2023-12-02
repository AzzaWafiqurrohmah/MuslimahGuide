<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
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
                throw new \Exception($phpmailer->ErrorInfo);
            }
        } catch (\Exception $e){
            $this->error($e->getMessage());
        }
    }

    public function otpVerification(){
        $verification_id = $_POST['verification_id'];
        $code = $_POST['code'];

        $verification = $this->verificationRepo->getById($verification_id);
        if($verification->getCode()){
            if($code == $verification->getCode()){
                $this->success('Kode sesuai');
            } else {
                $this->error('kode salah');
            }
        } else {
            $this->error('id tidak ditemukan');
        }
    }

    public function newPassword(){
        $verification_id = $_POST['verification_id'];
        $firstPassword = $_POST['firstPassword'];

        $verification = $this->verificationRepo->getById($verification_id);
        $user = $verification->getUser();

        $user->setPassword($firstPassword);
        $this->verificationRepo->delete($verification_id);

        if($this->userRepo->update($user)){
            $this->success('Password berhasil diperbarui');
        } else {
            $this->error('Password gagal diperbarui');
        }
    }

}