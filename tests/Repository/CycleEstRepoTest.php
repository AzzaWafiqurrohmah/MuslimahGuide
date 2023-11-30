<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\cycleEst;
use MuslimahGuide\Domain\user;
use PHPUnit\Framework\TestCase;

class CycleEstRepoTest extends TestCase
{
    private CycleEstRepository $cycleRepo;
    private UserRepository $userRepo;
    private user $user;
    private cycleEst $cycle;

    protected function setUp(): void
    {
       $this->cycleRepo = new CycleEstRepository(database::getConnection());
       $this->userRepo = new UserRepository(database::getConnection());

        $this->user = new user(null, 'sisi', null, role::admin,'087342123456', 'afdfdgdg', "hjhjhjhj", 'rahasia');
        $this->user ->setId($this->userRepo->addAll($this->user));
        $this->cycle = new cycleEst(3, 22, null, null, $this->user);
    }

    public function testAdd(){
        $cycle_id = $this->cycleRepo->addAll($this->cycle);
        self::assertTrue($cycle_id > 0);
        self::assertNotNull($this->cycleRepo->getById($cycle_id));
    }

    public function testUpdate(){
        $cycle_id = $this->cycleRepo->addAll($this->cycle);

        $this->cycle->setCycleLength(8);
        $this->cycle->setPeriodLength(27);

        self::assertTrue($this->cycleRepo->update($this->cycle));
    }

    public function testDelete(){
        $cycle_id = $this->cycleRepo->addAll($this->cycle);

        self::assertTrue($this->cycleRepo->delete($cycle_id));
    }

}