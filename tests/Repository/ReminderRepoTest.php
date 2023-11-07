<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\reminderType;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\reminder;
use MuslimahGuide\Domain\user;
use PHPUnit\Framework\TestCase;

class ReminderRepoTest extends TestCase
{
    private ReminderRepository $reminderRepo;
    private UserRepository $userRepo;
    private user $user;
    private reminder $reminder;

    protected function setUp(): void
    {
        $this->reminderRepo = new ReminderRepository(database::getConnection());
        $this->userRepo = new UserRepository(database::getConnection());

        $this->user = new user(null ,'sisi', null, role::admin,'087342123456', 'afdfdgdg', "hjhjhjhj", 'rahasia');
        $this->reminder = new reminder(reminderType::start, 'dsdsjdhjs', null, null, null, null, $this->user);
    }

    public function testadd(){
        $this->user->setId($this->userRepo->addAll($this->user));
        $result = $this->reminderRepo->add($this->reminder);

        self::assertNotNull($result);
    }

    public function testUpdate(){
        $this-> user->setId( $this->userRepo->addAll($this-> user));
        $result = $this->reminderRepo->add($this->reminder);
        self::assertNotNull($result);

        $reminder2 = $this->reminderRepo->getById($result);
        $reminder2->setMessage('haiiii');

        self::assertTrue($this->reminderRepo->update($reminder2));
    }

    public function testDelete(){
        $this->user->setId($this->userRepo->addAll($this->user));
        $result = $this->reminderRepo->add($this->reminder);

        self::assertNotNull($result);
        self::assertEquals(true, $this->reminderRepo->delete($result));
    }

}