<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\changePrayer;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\api\prayerRequest;
use MuslimahGuide\Repository\changePrayerRepository;
use MuslimahGuide\Repository\CycleHistRepository;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Service\api\prayerService;
use MuslimahGuide\trait\APIResponser;
use mysql_xdevapi\Exception;

class prayer
{
    use APIResponser;
    private changePrayerRepository $changePrayerRepo;
    private CycleHistRepository $cycleHistRepo;
    private SessionRepository $sessionRepo;
    private prayerService $prayerService;

    public function __construct()
    {
        $this->changePrayerRepo = new changePrayerRepository(database::getConnection());
        $this->cycleHistRepo = new CycleHistRepository(database::getConnection());
        $this->sessionRepo = new SessionRepository(database::getConnection());

        $this->prayerService = new prayerService();
    }

    public function addPrayer(){
        $request = new prayerRequest();
        $request->cycleHistory_id = $_POST['cycleHistory_id'];
        $request->prayer = $_POST['prayer'];
        $request->token = $_POST['token'];

        try {
            $this->prayerService->addPrayer($request);
            $this->success("Data berhasil ditambahkan");
        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }

    public function getPrayer(){
        $request = new prayerRequest();
        $request->token = $_GET['token'];
        $request->cycleHistory_id = $_GET['cycleHistory_id'];

        try {
            $data = $this->prayerService->getPrayer($request);
            $this->successArray($data->changeprayer, "Data tersedia");
        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }

    public function updatePrayer(){
        $request = new prayerRequest();
        $request->token = $_POST['token'];
        $request->changePrayer_id = $_POST['changePrayer_id'];

        try {
            $this->prayerService->updatePrayer($request);
            $this->success("Data berhasil diperbarui");
        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }
}