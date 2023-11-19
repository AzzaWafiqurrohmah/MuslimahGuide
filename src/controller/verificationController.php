<?php

namespace MuslimahGuide\controller;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Domain\verification;
use MuslimahGuide\Model\verificationRequest;
use MuslimahGuide\Repository\VerificationRepository;

use MuslimahGuide\app\view;
use MuslimahGuide\Config\database;
use MuslimahGuide\Model\adminRequest;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\service\adminService;
use MuslimahGuide\service\verificationService;

class verificationController
{
    private UserRepository $userRepo;
    private adminService $adminService;
    private VerificationRepository $verificationRepo;
    private verificationService $verificationService;

    public function __construct()
    {
        $connection = database::getConnection();
        $this->userRepo = new UserRepository($connection);
        $this -> adminService = new adminService($this->userRepo);
        $this->verificationRepo = new VerificationRepository($connection);
        $this->verificationService = new verificationService($this->verificationRepo, $this->userRepo);

    }

    public function email(){
        view::render('verification-email');
    }

    public function postEmail(){
        $email = $_POST['email'];

        $request = new verificationRequest();
        $request->email = $email;

        try {
            $response = $this->verificationService->emailVerification($request);
            $phpmailer = $this->verificationService->sendEmail($email, $response->verification->getUser()->getName(), $response->verification->getCode());

            if($phpmailer->send()){
                header("Location: /verificationCode?id=" . $response->verification->getVerificationId());
            } else{
                throw new \Exception($phpmailer->ErrorInfo);
            }
        } catch (\Exception $e){
            view::render('verificationEmail');
        }
    }

    public function code(){
        $verification_id = $_GET['id'];
        view::render('verification-code',[
            'id' => $verification_id
        ]);
    }

    public function postCode(){
        $verification_id = $_POST['verification_id'];
        $code = $_POST['code'];

        $verification = $this->verificationRepo->getById($verification_id);
        echo $verification_id;
        if($code == $verification->getCode()){
            view::redirect("verificationNewPassword?id=$verification_id");
        } else {
            view::render('verificationCode?id=' . $verification_id);
        }
    }

    public function newPassword(){
        $verification_id = $_GET['id'];
        $verification = $this->verificationRepo->getById($verification_id);
        $email = $verification->getUser()->getEmail();
        view::render('verification-newPassword', [
            'verification_id' => $verification_id,
            'email' => $email
        ]);
    }

    public function postNewPassword(){
        $verification_id = $_POST['verification_id'];
        $firstPassword = $_POST['firstPassword'];
        $secondPassword = $_POST['secondPassword'];

        $verification = $this->verificationRepo->getById($verification_id);
        $user = $verification->getUser();

        if($firstPassword == $secondPassword){
            $user->setPassword($firstPassword);
            $this->userRepo->update($user);

            $this->verificationRepo->delete($verification_id);

            view::redirect('login');
            exit();
        }
        view::redirect("verificationNewPassword?id=$verification_id");
    }
}