<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Repository\EducationRepository;
use MuslimahGuide\trait\APIResponser;

class education
{
    use APIResponser;
    private EducationRepository $educationRepo;

    public function __construct()
    {
        $this->educationRepo = new EducationRepository(database::getConnection());
    }

    public function getAll(){
        $data = $this->educationRepo->getAll();
        $this->successArray($data, 'Data tersedia');
    }

    public function getById(){
        $id = $_POST['id'];
        $data = $this->educationRepo->getByIdAPI($id);
        if($data != null){
            $this->successArray($data, 'Data tersedia');
        } else {
            $this->error('Data tidak tersedia');
        }
    }


    public function addOnClick(){
        $id = $_POST['id'];

        $education = $this->educationRepo->getById($id);
        $onClick = ($education->getOnClicked() + 1);
        $education->setEducationId($id);
        $education->setOnClicked($onClick);

        if($this->educationRepo->addOnClick($education)){
            $this->success('Data berhasil diupdate');
        } else {
            $this->success('Data gagal diupdate');
        }
    }

}