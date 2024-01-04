<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\cycleHistory;
use MuslimahGuide\Domain\user;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotNull;

class cycleHistRepoTest extends TestCase
{
    private CycleHistRepository $cycleRepo;
    private UserRepository $userRepo;

    private user $user;

    protected function setUp(): void
    {
        $this->cycleRepo = new CycleHistRepository(database::getConnection());
        $this->userRepo = new UserRepository(database::getConnection());

//        $this->user = new user(null ,'sisi', null, role::admin,'087342123456', 'afdfdgdg', "hjhjhjhj", 'rahasia');
//        $this->user ->setId($this->userRepo->addAll($this->user));
    }

    public function testAdd(){
        $cycle = new cycleHistory(4, 30, null, null, $this->user);

        $cycle_id = $this->cycleRepo->addAll($cycle);
        self::assertTrue($cycle_id > 0);
    }

    public function testGet(){
        $cycle = new cycleHistory(4, 30, null, null, $this->user);

        $cycle_id = $this->cycleRepo->addAll($cycle);
        self::assertNotNull($this->cycleRepo->getById($cycle_id));
    }

    public function testGetAvrg(){
        $cycles = $this->cycleRepo->getAvrg("cycle_length", 853);
        var_dump($cycles);
        assertNotNull($cycles);
    }

    public function testGetAll(){
        $cycle = $this->cycleRepo->getAllHistCycle("853");
        var_dump($cycle);
        self::assertNotNull($cycle);
    }
}