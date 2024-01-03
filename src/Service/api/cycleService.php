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
        $startDate = $this->dateOperations($request->lastDate, "sub", $period);
        $cycleHist = new cycleHistory($cycle, $period, $startDate, $lastDate, $user);
        $this->cycleHistRepo->addAll($cycleHist);


        //set cycleEst
        $res = $cycle - $period;
        $startDateEst = $this->dateOperations($request->lastDate, "add", $res);
        $LastDateEst = $this->dateOperations($request->lastDate, "add", $cycle);
        $cycleEst = new cycleEst($cycle, $period, $startDateEst, $LastDateEst, $user);
        $this->cycleEstRepo->addAll($cycleEst);

        return true;
    }

    public function dateOperations(string $date, string $operation, int $val) :string{
        $res = \DateTime::createFromFormat('Y/m/d H:i:s', $date, new \DateTimeZone('Asia/Jakarta'));
        $res->$operation(new \DateInterval("P{$val}D"));
        return $res->format('Y-m-d H:i:s');
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
        $cycleEst_id = $request->cycleEst_id;

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