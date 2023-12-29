<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Exception\validationException;
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
        try{
            $education = $this->educationRepo->getById($id);
            if($education == null){
                throw new validationException("ID tidak ditemukan");
            }

            $onClick = ($education->getOnClicked() + 1);
            $education->setEducationId($id);
            $education->setOnClicked($onClick);
            $this->educationRepo->update($education);
            $this->success('Data berhasil diupdate');
        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }

}