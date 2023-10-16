<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\session;
use MuslimahGuide\Domain\user;
use PHPUnit\Framework\TestCase;

class SessionRepoTest extends TestCase
{
    private SessionRepository $sessionRepo;
    private UserRepository $userRepo;
    private user $user;

    protected function setUp(): void
    {
        $this->userRepo = new UserRepository(database::getConnection());
        $this->sessionRepo = new SessionRepository(database::getConnection());

        $this-> user = new user('second', null, role::user,'087342123456', 'afdfdgdg', "hjhjhjhj", 'rahasia');
    }

    public function testSaveSuccess(){
        $this->user->setId($this->userRepo->addAll($this-> user));

        $session = new session(uniqid(), $this->user);
        $this->sessionRepo->save($session);

        $res = $this->sessionRepo->getById($session->getId());

        self::assertNotNull($session);
        self::assertNotNull($res);
    }

    public function testDeleteById(){
        $this-> user->setId($this->userRepo->addAll($this-> user));

        $session = new session(uniqid(), $this-> user);
        $this->sessionRepo->save($session);

        $res = $this->sessionRepo->deleteById($session->getId());
        $result = $this->sessionRepo->findById($session->getId());
        self::assertNotNull($res);
    }
}