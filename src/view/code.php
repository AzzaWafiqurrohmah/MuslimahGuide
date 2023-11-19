<?php

use PHPMailer\PHPMailer\PHPMailer;
require_once __DIR__ ."/../../vendor/autoload.php";  //bisa dipakai atau engga juga bisa

set_time_limit(300); // Menetapkan batas waktu eksekusi ke 300 detik (5 menit)
$phpmailer = new PHPMailer();
$phpmailer->isSMTP();
$phpmailer->Host = 'mail.irsyadulibad.my.id';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = 587;
$phpmailer->Username = 'zenfemina@irsyadulibad.my.id';
$phpmailer->Password = 'zEnF3min4';
$phpmailer->SMTPDebug = 2;

$phpmailer->SMTPSecure ='tls';

$phpmailer->setFrom('zenFemina@irsyadulibad.my.id', 'admin zenFemina');
$phpmailer->addAddress('wafiqurrohmahazza@gmail.com', 'azza');     //Add a recipient
$phpmailer->addReplyTo('zenFemina@irsyadulibad.my.id', 'Information');

$phpmailer->isHTML(true);                                  //Set email format to HTML
$phpmailer->Subject = 'MuslimahGuide VerificationCode';
$phpmailer->Body    = 'code anda adalah 345987, ini yang 587';
$phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

if($phpmailer->send()){
    echo "message has sent";
} else{
    echo $phpmailer->ErrorInfo;
}