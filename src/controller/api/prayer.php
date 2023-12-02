<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\changePrayer;
use MuslimahGuide\Repository\changePrayerRepository;
use MuslimahGuide\Repository\CycleHistRepository;
use MuslimahGuide\trait\APIResponser;

class prayer
{
    use APIResponser;
    private changePrayerRepository $changePrayerRepo;
    private CycleHistRepository $cycleHistRepo;

    public function __construct()
    {
        $this->changePrayerRepo = new changePrayerRepository(database::getConnection());
        $this->cycleHistRepo = new CycleHistRepository(database::getConnection());
    }

    public function addPrayer(){
        $cycleHistory_id = $_POST['cycleHistory_id'];
        $prayer = $_POST['prayer'];
        $cycle = $this->cycleHistRepo->getById($cycleHistory_id);
        $cycle->setId($cycleHistory_id);

        $changePrayer = new changePrayer($prayer, 'no', $cycle);
        $res = $this->changePrayerRepo->addChangePrayer($changePrayer);
        if($res != null){
            $this->success('Data berhasil ditambahkan');
        } else {
            $this->error('Data gagal ditambahkan');
        }
    }

    public function getPrayer(){
        $cycleHistory_id = $_GET['cycleHistory_id'];
        $data = $this->changePrayerRepo->getChangePrayer($cycleHistory_id);
        if($data != null){
            $this->successArray($data, 'Data tersedia');
        } else {
            $this->error('Data tida tersedia');
        }
    }

    public function updatePrayer(){
        $changePrayer_id = $_POST['changePrayer_id'];

        if($this->changePrayerRepo->update($changePrayer_id)){
            $this->success('Data berhasil diupdate');
        }else {
            $this->error('Data gagal diupdate');
        }
    }
}