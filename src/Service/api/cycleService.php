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
        $lastDate = \DateTime::createFromFormat('Y-m-d H:i:s', $request->lastDate, new \DateTimeZone('Asia/Jakarta'));
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

        $user->setId($user_id);
        $user->setBirthDate($birthDate);
        $this->userRepo->update($user);

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $request->lastDate, new \DateTimeZone('Asia/Jakarta'));
        $startDate = $date->sub(new \DateInterval("P{$period}D"));
        $cycleHist = new cycleHistory(0, $period, $startDate->format('Y-m-d H:i:s'), $lastDate->format('Y-m-d H:i:s'), $user);
        $cycleHistory = $this->cycleHistRepo->addAll($cycleHist);
        if($cycleHistory == null){
            throw new validationException("cycle history gagal ditambahkan");
        }

        $res = $cycle - $period;
        $startDateEst = $lastDate->add(new \DateInterval("P{$res}D"));

        $newLastDate = \DateTime::createFromFormat('Y-m-d H:i:s', $request->lastDate, new \DateTimeZone('Asia/Jakarta'));
        $newStartDate = $newLastDate->add(new \DateInterval("P{$res}D"));
        $lastDateEst = $newStartDate->add(new \DateInterval("P{$period}D"));
        $cycleEst = new cycleEst($cycle, $period, $startDateEst->format('Y-m-d H:i:s'), $lastDateEst->format('Y-m-d H:i:s'), $user);
        $cycleEst = $this->cycleEstRepo->addAll($cycleEst);
        if($cycleEst == null){
            throw new validationException("cycleEst gagal ditambahkan");
        }

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

}