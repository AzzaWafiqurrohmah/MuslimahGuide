<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\education;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class educationRepoTest extends TestCase
{
    private education $education;
    private EducationRepository $educationRepo;

    protected function setUp(): void
    {
        $this->educationRepo = new EducationRepository(database::getConnection());
        $this->education = new education('coba.jpeg', 'tata cara mengganti sholat', 'mengganti sholat diwajibkan bagi setiap perempuan yang sudah menyelesaikan masa menstruasinya', 3);
    }

    public function testAdd(){
        $education_id = $this->educationRepo->add($this->education);
        self::assertNotNull($education_id);
    }

    public function testUpdate(){
        $education_id = $this->educationRepo->add($this->education);
        $user2 = $this->educationRepo->getById($education_id);

        $user2->setOnClicked(7);
        assertEquals(7, $user2->getOnClicked());
    }

    public function testDelete(){
        $education_id = $this->educationRepo->add($this->education);
        $res = $this->educationRepo->delete($education_id);
        self::assertTrue($res);
    }

}