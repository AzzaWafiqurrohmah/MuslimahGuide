<?php

namespace MuslimahGuide\Service\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\cycleEst;
use MuslimahGuide\Domain\cycleHistory;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\api\cycleRequest;
use MuslimahGuide\Model\api\cycleResponse;
use MuslimahGuide\Repository\CycleEstRepository;
use MuslimahGuide\Repository\CycleHistRepository;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;



class cycleService
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

    public function question(cycleRequest $request) :bool{
        $token = $request->token;
        $birthDate = $request->birthdate;
        $lastDate = $request->lastDate;
        $cycle = $request->cycle;
        $period = $request->period;

        $session = $this->sessionRepo->getById($token);
        if($session == null){
            throw new validationException("token tidak valid");
        }

        $user_id = $session->getUserId()->getId();
        $user = $this->userRepo->getById($user_id);
        if($user == null){
            throw new validationException("user ID tidak ditemukan");
        }

        //set birthdate
        $user->setId($user_id);
        $user->setBirthDate($birthDate);
        $this->userRepo->update($user);


        // set cycleHist
        $startDate = \DateTime::createFromFormat('Y/m/d H:i:s', $request->lastDate, new \DateTimeZone('Asia/Jakarta'));
        $startDate->sub(new \DateInterval("P{$period}D"));

        $cycleHist = new cycleHistory(0, $period, $startDate->format('Y-m-d H:i:s'), $lastDate, $user);
        $this->cycleHistRepo->addAll($cycleHist);


        //set cycleEst
        $res = $cycle - $period;
        $startDateEst = \DateTime::createFromFormat('Y/m/d H:i:s', $request->lastDate, new \DateTimeZone('Asia/Jakarta'));
        $startDateEst->add(new \DateInterval("P{$res}D"));

        $LastDateEst = \DateTime::createFromFormat('Y/m/d H:i:s', $request->lastDate, new \DateTimeZone('Asia/Jakarta'));
        $LastDateEst->add(new \DateInterval("P{$res}D"));
        $LastDateEst->add(new \DateInterval("P{$period}D"));

        $cycleEst = new cycleEst($cycle, $period, $startDateEst->format('Y-m-d H:i:s'), $LastDateEst->format('Y-m-d H:i:s'), $user);
        $this->cycleEstRepo->addAll($cycleEst);

        return true;
    }

    public function getHistory(cycleRequest $request) :cycleResponse{
        $session = $this->sessionRepo->getById($request->token);
        if($session == null){
            throw new validationException("Token tidak valid");
        }
        $user_id = $session->getUserId()->getId();
        $data = $this->cycleHistRepo->getLastCycle($user_id);
        if($data == null){
            throw new validationException("data tidak ditemukan");
        }
        $response = new cycleResponse();
        $response->data = $data;
        return $response;
    }

    public function getEst(cycleRequest $request) : cycleResponse{
        $session = $this->sessionRepo->getById($request->token);
        if($session == null){
            throw new validationException("Token tidak valid");
        }
        $user_id = $session->getUserId()->getId();
        $data = $this->cycleEstRepo->getByUserId($user_id);
        if($data == null){
            throw new validationException("Data tidak ditemukan");
        }

        $response = new cycleResponse();
        $response->data = $data;
        return $response;
    }

    public function getAllHist(cycleRequest $request) : cycleResponse{
        $session = $this->sessionRepo->getById($request->token);
        if($session == null){
            throw new validationException("Token tidak valid");
        }
        $user_id = $session->getUserId()->getId();
        $data = $this->cycleHistRepo->getAllHistCycle($user_id);
        if($data == null){
            throw new validationException("data tidak ditemukan");
        }
        $response = new cycleResponse();
        $response->data = $data;
        return $response;
    }

    public function beginCycle(cycleRequest $request){
        $token = $request->token;
        $dateNow = $request->datenow;
        $cycleEst_id = $request->

        $session = $this->sessionRepo->getById($request->token);
        if($session == null){
            throw new validationException("token tidak valid");
        }

        $cycleEst = $this->cycleEstRepo->getById($request->cycleEst_id);
        if($cycleEst == null){
            throw new validationException("cycle Est ID tidak valid");
        }

        if($cycleEst->getStartDate() > $request->datenow){
            $cycleEst->setStartDate($request->datenow);



        }
    }

}