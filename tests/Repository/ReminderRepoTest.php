<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\reminderType;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\cycleEst;
use MuslimahGuide\Domain\cycleHistory;
use MuslimahGuide\Domain\reminder;
use MuslimahGuide\Domain\user;
use PHPUnit\Framework\TestCase;

class ReminderRepoTest extends TestCase
{
    private ReminderRepository $reminderRepo;
    private UserRepository $userRepo;
    private CycleEstRepository $cycleEstRepo;
    private user $user;
    private reminder $reminder;
    private cycleEst $cycleEst;

    protected function setUp(): void
    {
        $connection = database::getConnection();
        $this->reminderRepo = new ReminderRepository($connection);
        $this->userRepo = new UserRepository($connection);
        $this->cycleEstRepo = new CycleEstRepository($connection);

        $this->user = new user(null ,'sisi', null, role::admin,'087342123456', 'afdfdgdg', "hjhjhjhj", 'rahasia');
        $this-> user->setId( $this->userRepo->addAll($this-> user));

        $this->cycleEst = new cycleEst(25, 7, null, null, $this->user);
        $this->cycleEst->setId($this->cycleEstRepo->addAll($this->cycleEst));

        $this->reminder = new reminder(reminderType::start, 'dsdsjdhjs', null, null, null, $this->cycleEst);
    }

    public function testadd(){
        $result = $this->reminderRepo->add($this->reminder);

        self::assertNotNull($result);
        self::assertNotNull($this->reminderRepo->getById($result));
    }

    public function testUpdate(){
        $result = $this->reminderRepo->add($this->reminder);
        self::assertNotNull($result);

        $reminder2 = $this->reminderRepo->getById($result);

        $reminder2->setReminderId($result);
        $reminder2->setCycleEst($this->cycleEst);
        $reminder2->setMessage('haiiii');

        self::assertTrue($this->reminderRepo->update($reminder2));
    }

    public function testDelete(){
        $result = $this->reminderRepo->add($this->reminder);

        self::assertNotNull($result);
        self::assertEquals(true, $this->reminderRepo->delete($result));
        self::assertNull($this->reminderRepo->getById($result));
    }

}