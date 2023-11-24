<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\prayer;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\changePrayer;
use MuslimahGuide\Domain\cycleHistory;
use MuslimahGuide\Domain\user;
use PHPUnit\Framework\TestCase;

class changePrayerRepoTest extends TestCase
{
    private \PDO $connection;
    private changePrayerRepository $changePrayerRepo;
    private UserRepository $userRepo;
    private CycleHistRepository $histRepo;
    private changePrayer $changePrayer;
    private cycleHistory $cycleHistory;
    private user $user;

    protected function setUp(): void
    {
        $this->connection = database::getConnection();
        $this->changePrayerRepo = new changePrayerRepository($this->connection);
        $this->userRepo = new UserRepository($this->connection);
        $this->histRepo = new CycleHistRepository($this->connection);

        $this->user = new user(null ,'sisi', null, role::admin,'087342123456', 'afdfdgdg', "hjhjhjhj", 'rahasia');
        $this->user ->setId($this->userRepo->addAll($this->user));

        $this->cycleHistory = new cycleHistory(4, 30, null, null, $this->user);
        $this->cycleHistory->setId($this->histRepo->addAll($this->cycleHistory));
    }

    public function testAdd(){
        $this->changePrayer = new changePrayer(prayer::dzuhur, 'yes', $this->cycleHistory);
        $res = $this->changePrayerRepo->addChangePrayer($this->changePrayer);
        self::assertNotNull($res);
    }

    public function testGet(){
        $this->changePrayer = new changePrayer(prayer::dzuhur, 'yes', $this->cycleHistory);
        $res = $this->changePrayerRepo->addChangePrayer($this->changePrayer);
        $this->changePrayer->setId($res);
        $res = $this->changePrayerRepo->getById($res);
        self::assertNotNull($res);
    }

    public function testUpdate(){
        $this->changePrayer = new changePrayer(prayer::dzuhur, 'yes', $this->cycleHistory);
        $res = $this->changePrayerRepo->addChangePrayer($this->changePrayer);

        $this->changePrayer->setId($res);

        $this->changePrayer->setPrayer(prayer::ashar);
        self::assertTrue($this->changePrayerRepo->update($this->changePrayer));
    }
}