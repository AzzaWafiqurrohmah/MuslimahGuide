<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\changePrayer;
use MuslimahGuide\Repository\changePrayerRepository;
use MuslimahGuide\Repository\CycleHistRepository;

class prayer
{
    private changePrayerRepository $changePrayerRepo;
    private CycleHistRepository $cycleHistRepo;

    public function __construct()
    {
        $this->changePrayerRepo = new changePrayerRepository(database::getConnection());
        $this->cycleHistRepo = new CycleHistRepository(database::getConnection());
    }

    public function addPrayer(){
        $cycleHistory_id = $_POST['cycle_id'];
        $prayer = $_POST['prayer'];
        $cycle = $this->cycleHistRepo->getById($cycleHistory_id);
        $cycle->setId($cycleHistory_id);

        $changePrayer = new changePrayer($prayer, 'no', $cycle);
        $res = $this->changePrayerRepo->addChangePrayer($changePrayer);
        if($res != null){
            $response = array(
                'status' => 1,
                'message' => "Data berhasil ditambahkan"
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => "Data gagal ditambahkan"
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getPrayer(){
        $cycleHistory_id = $_GET['cycleHistory_id'];
        $data = $this->changePrayerRepo->getChangePrayer($cycleHistory_id);
        if($data != null){
            $response = array(
                'status' => 1,
                'message' => "Data berhasil ditambahkan",
                'data' => $data
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => "cycleHistory_id tidak ditemukan",
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function updatePrayer(){
        $changePrayer_id = $_POST['changePrayer_id'];

        if($this->changePrayerRepo->update($changePrayer_id)){
            $response = array(
                'status' => 1,
                'message' => "Data berhasil diupdate",
            );
        }else {
            $response = array(
                'status' => 0,
                'message' => "Data Gagal diupdate",
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}