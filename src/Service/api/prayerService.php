<?php

namespace MuslimahGuide\Service\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\changePrayer;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\api\prayerRequest;
use MuslimahGuide\Model\api\prayerResponse;
use MuslimahGuide\Repository\changePrayerRepository;
use MuslimahGuide\Repository\CycleHistRepository;
use MuslimahGuide\Repository\SessionRepository;

class prayerService
{
    private changePrayerRepository $changePrayerRepo;
    private CycleHistRepository $cycleHistRepo;
    private SessionRepository $sessionRepo;

    public function __construct()
    {
        $this->changePrayerRepo = new changePrayerRepository(database::getConnection());
        $this->cycleHistRepo = new CycleHistRepository(database::getConnection());
        $this->sessionRepo = new SessionRepository(database::getConnection());
    }

    public function addPrayer(prayerRequest $request) :bool{
        $user = $this->sessionRepo->getById($request->token);
        if($user == null){
            throw new validationException("token tidak valid");
        }

        $cycle = $this->cycleHistRepo->getById($request->cycleHistory_id);
        if($cycle == null){
            throw new validationException("cycle History ID tidak ditemukan");
        }
        $cycle->setId($request->cycleHistory_id);

        $changePrayer = new changePrayer($request->prayer, 'no', $cycle);
        $this->changePrayerRepo->addChangePrayer($changePrayer);

        return true;
    }

    public function getPrayer(prayerRequest $request) : prayerResponse{
        $user = $this->sessionRepo->getById($request->token);
        if($user == null){
            throw new validationException("token tidak valid");
        }

        $data = $this->changePrayerRepo->getChangePrayer($request->cycleHistory_id);
        if($data == null){
            throw new validationException("cycle history ID tidak valid");
        }

        $response = new prayerResponse();
        $response->changeprayer = $data;
        return $response;
    }

    public function updatePrayer(prayerRequest $request) :bool{
        $user = $this->sessionRepo->getById($request->token);
        if($user == null){
            throw new validationException("token tidak valid");
        }

        $changePrayer = $this->changePrayerRepo->getById($request->changePrayer_id);
        if($changePrayer == null){
            throw new validationException("change prayer ID tidak ditemukan");
        }

        $this->changePrayerRepo->update($request->changePrayer_id);
        return true;
    }
}