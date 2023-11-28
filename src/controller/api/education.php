<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Repository\EducationRepository;

class education
{
    private EducationRepository $educationRepo;

    public function __construct()
    {
        $this->educationRepo = new EducationRepository(database::getConnection());
    }

    public function getAll(){
        $data = $this->educationRepo->getAll();

        $response = array(
            'status' => 1,
            'message' => "Data berhasil didapatkan",
            'data' =>$data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getById(){
        $id = $_POST['id'];
        $data = $this->educationRepo->getByIdAPI($id);
        if($data != null){
            $response = array(
                'status' => 1,
                'message' => "Data berhasil didapatkan",
                'data' => $data
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => "Data tersebut tidak tersedia",
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function searchEdu(){
        $input = $_GET['input'];
        $data = $this->educationRepo->search($input);
        if($data != null){
            $response = array(
                'status' => 1,
                'message' => "Data berhasil didapatkan",
                'data' => $data
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => "Data tidak tersedia"
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function addOnClick(){
        $id = $_POST['id'];

        $education = $this->educationRepo->getById($id);
        $onClick = ($education->getOnClicked() + 1);
        $education->setEducationId($id);
        $education->setOnClicked($onClick);

        if($this->educationRepo->addOnClick($education)){
            $response = array(
                'status' => 1,
                'message' => "Data berhasil di update"
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => "Data gagal diupdate",
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}