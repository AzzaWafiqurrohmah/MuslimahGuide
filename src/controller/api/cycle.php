<?php

namespace MuslimahGuide\controller\api;

use Google\Service\AdExchangeBuyerII\Date;
use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\cycleEst;
use MuslimahGuide\Domain\cycleHistory;
use MuslimahGuide\Repository\CycleEstRepository;
use MuslimahGuide\Repository\CycleHistRepository;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;

class cycle
{

    private CycleHistRepository $cycleHistRepo;
    private CycleEstRepository $cycleEstRepo;
    private UserRepository $userRepo;
    private SessionRepository $sessionRepo;

    public function __construct()
    {
        $connection = database::getConnection();
        $this->cycleEstRepo = new CycleEstRepository($connection);
        $this->cycleHistRepo = new CycleHistRepository($connection);

        $this->userRepo = new UserRepository($connection);
        $this->sessionRepo = new SessionRepository($connection);
    }

    public function question(){

        $token = $_POST['token'];
        $birthDate = $_POST['birthDate'];
        $lastDate = \DateTime::createFromFormat('Y-m-d H:i:s', $_POST['lastDate'], new \DateTimeZone('Asia/Jakarta'));
        $cycle = $_POST['cycle'];
        $period = $_POST['period'];

        $session = $this->sessionRepo->getById($token);
        $user_id = $session->getUserId()->getId();
        $user = $this->userRepo->getById($user_id);

        $user->setId($user_id);
        $user->setBirthDate($birthDate);
        $this->userRepo->update($user);

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $_POST['lastDate'], new \DateTimeZone('Asia/Jakarta'));
        $startDate = $date->sub(new \DateInterval("P{$period}D"));
        $cycleHist = new cycleHistory(0, $period, $startDate->format('Y-m-d H:i:s'), $lastDate->format('Y-m-d H:i:s'), $user);
        $this->cycleHistRepo->addAll($cycleHist);

        $res = $cycle - $period;
        $startDateEst = $lastDate->add(new \DateInterval("P{$res}D"));

        $newLastDate = \DateTime::createFromFormat('Y-m-d H:i:s', $_POST['lastDate'], new \DateTimeZone('Asia/Jakarta'));
        $newStartDate = $newLastDate->add(new \DateInterval("P{$res}D"));
        $lastDateEst = $newStartDate->add(new \DateInterval("P{$period}D"));
        $cycleEst = new cycleEst($cycle, $period, $startDateEst->format('Y-m-d H:i:s'), $lastDateEst->format('Y-m-d H:i:s'), $user);
        $this->cycleEstRepo->addAll($cycleEst);

        $response = array(
            'status' => 1,
            'message' => "Data tersimpan"
        );
        header('Content-Type: application/json');
        echo json_encode($response);

    }

    public function getHistory(){
        $token = $_GET['token'];
        $session = $this->sessionRepo->getById($token);
        $user_id = $session->getUserId()->getId();

        if($user_id != null){
            $data = $this->cycleHistRepo->getLastCycle($user_id);
            $response = array(
                'status' => 1,
                'message' => "Data Tersedia",
                'data' => $data
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => "Token tidak valid"
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getEstimation(){
        $token = $_GET['token'];
        $session = $this->sessionRepo->getById($token);
        $user_id = $session->getUserId()->getId();

        if($user_id != null){
            $data = $this->cycleEstRepo->getByUserId($user_id);
            $response = array(
                'status' => 1,
                'message' => "Data Tersedia",
                'data' => $data
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => "Token tidak valid"
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


}