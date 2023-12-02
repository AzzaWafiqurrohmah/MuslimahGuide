<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Repository\CycleEstRepository;
use MuslimahGuide\Repository\ReminderRepository;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\trait\APIResponser;

class reminder
{
    use APIResponser;
    private ReminderRepository $reminderRepo;
    private UserRepository $userRepo;
    private SessionRepository $sessionRepo;
    private CycleEstRepository $cycleEstRepo;

    public function __construct()
    {
        $connection = database::getConnection();
        $this->reminderRepo = new ReminderRepository($connection);
        $this->cycleEstRepo = new CycleEstRepository($connection);
        $this->userRepo = new UserRepository($connection);
        $this->sessionRepo = new SessionRepository($connection);

    }

    public function getAllReminder(){
        $token = $_GET['token'];
        $session = $this->sessionRepo->getById($token);
        if($session){
            $data = $this->reminderRepo->getAll($session->getUserId()->getId());
            $this->successArray($data, 'Data Tersedia');
        } else{
            $this->error('Token tidak valid');
        }
    }

    public function getById(){
        $token = $_GET['token'];
        $reminder_id = $_GET['reminder_id'];
        $session = $this->sessionRepo->getById($token);
        if($session){
            if($data = $this->reminderRepo->getByIdAPI($reminder_id)){
                $this->successArray($data, 'Data tersedia');
            } else {
                $this->error('Data tidak tersedia');
            }
        } else{
            $this->error('Token tidak valid');
        }
    }

    public function updateReminder(){
        $message = $_POST['message'];
        $reminderDays = $_POST['reminderDays'];
        $reminderTime = $_POST['reminderTime'];
        $is_on = $_POST['is_on'];

        $token = $_POST['token'];
        $reminder_id = $_POST['reminder_id'];
        $cycleEst_id = $_POST['cycleEst_id'];

        $session = $this->sessionRepo->getById($token);
        $cycleEst = $this->cycleEstRepo->getById($cycleEst_id);
        $cycleEst->setId($cycleEst_id);

        $reminder = $this->reminderRepo->getById($reminder_id);
        $reminder->setReminderId($reminder_id);
        $reminder->setMessage($message);
        $reminder->setReminder($reminderDays);
        $reminder->setTime($reminderTime);
        $reminder->setIsOn($is_on);
        $reminder->setCycleEst($cycleEst);
        if($session->getUserId()->getId()){
            if($this->reminderRepo->update($reminder)){
                $this->success('Data berhasil diupdate');
            } else {
                $this->error('Data gagal diupdate');
            }
        } else {
            $this->error('Data tidak valid');
        }
    }
}