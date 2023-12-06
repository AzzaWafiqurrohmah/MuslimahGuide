<?php

namespace MuslimahGuide\Service;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\verification;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\verificationRequest;
use MuslimahGuide\Model\verificationResponse;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Repository\VerificationRepository;
use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ ."/../../vendor/autoload.php";

class verificationService
{
    private VerificationRepository $verificationRepo;
    private UserRepository $userRepo;

    //php mailer
    private $Host;
    private $SMTPAuth;
    private $Port;
    private $Username;
    private $Password;
    private $SMTPSecure;

    public function __construct($verificationRepo, $userRepo)
    {
        $this->verificationRepo = $verificationRepo;
        $this->userRepo = $userRepo;

         $this-> Host = 'mail.irsyadulibad.my.id';
         $this-> SMTPAuth = true;
         $this-> Port = 587;
         $this-> Username = 'zenfemina@irsyadulibad.my.id';
         $this-> Password = 'zEnF3min4';
         $this-> SMTPSecure ='tls';
    }

    public function emailVerification(verificationRequest $request) :verificationResponse{
        $user = $this->userRepo->get(["email" => $request->email]);
        if($user == null){
            throw new validationException("email tidak terdaftar");
        }

        $uniqueNumber = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $verification = new verification((string)$uniqueNumber, $user);
        $verification_id = $this->verificationRepo->add($verification);
        $verification->setVerificationId($verification_id);

        $response = new verificationResponse();
        $response->verification = $verification;
        return $response;
    }

    public function sendEmail($recipient, $name ,$code) :PHPMailer{
        set_time_limit(300); // Menetapkan batas waktu eksekusi ke 300 detik (5 menit)
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host =$this->Host;
        $phpmailer->SMTPAuth = $this->SMTPAuth;
        $phpmailer->Port = $this->Port;
        $phpmailer->Username = $this->Username;
        $phpmailer->Password = $this->Password;
        $phpmailer->SMTPSecure = $this->SMTPSecure;

        $phpmailer->setFrom($this->Username, 'zenFemina');
        $phpmailer->addAddress($recipient, $name);     //Add a recipient
        $phpmailer->addReplyTo($this->Username, 'Information');

        $phpmailer->isHTML(true);                                  //Set email format to HTML
        $phpmailer->Subject = 'zenfemina Verification Code';
        $phpmailer->Body    = 'Your code is ' . $code;
        $phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

        return $phpmailer;
    }

    public function sendEmailUser($email, $subjek, $message){
        set_time_limit(300); // Menetapkan batas waktu eksekusi ke 300 detik (5 menit)
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host =$this->Host;
        $phpmailer->SMTPAuth = $this->SMTPAuth;
        $phpmailer->Port = $this->Port;
        $phpmailer->Username = $this->Username;
        $phpmailer->Password = $this->Password;
        $phpmailer->SMTPSecure = $this->SMTPSecure;

        $phpmailer->setFrom($this->Username, 'zenFemina');
        $phpmailer->addAddress('wafiqurrohmahazza@gmail.com', 'admin');     //Add a recipient
        $phpmailer->addReplyTo($this->Username, 'Information');

        $phpmailer->isHTML(true);                                  //Set email format to HTML
        $phpmailer->Subject = 'zenfemina feedback';
        $phpmailer->Body    = 'from : '. $email . '<br> subject : '. $subjek . '<br> message : '. $message;
        $phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

        return $phpmailer;
    }

    public function otpVerification(verificationRequest $request) :bool{
        $verification = $this->verificationRepo->getById($request->verification_id);
        if($verification == null){
            throw new validationException("verifikasi ID tidak ditemukan");
        }

        $code = $verification->getCode();
        if($code == $request->code){
            return true;
        } else {
            return false;
        }
    }

    public function newPassword(verificationRequest $request) :bool{
        $verification_id = $_POST['verification_id'];
        $firstPassword = $_POST['firstPassword'];

        $verification = $this->verificationRepo->getById($request->verification_id);
        if($verification == null){
            throw new validationException("verifikasi ID tidak ditemukan");
        }

        $user = $verification->getUser();
        $user->setPassword($firstPassword);

        $this->verificationRepo->delete($verification_id);

        $this->userRepo->update($user);
        return true;
    }

}