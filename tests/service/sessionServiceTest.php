<?php

namespace MuslimahGuide\service;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class sessionServiceTest extends TestCase
{
    private sessionService $sessionService;
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;
    private user $user;
    protected function setUp() : void{
        $this->sessionRepository = new SessionRepository(database::getConnection());
        $this->userRepository = new UserRepository(database::getConnection());
        $this->sessionService = new sessionService($this->sessionRepository, $this->userRepository);

        $this-> user = new user( null,"azza", null, role::user,"087675453432", "azza@gmail.com", "azza345", "rahasia");
        $this->user->setId($this->userRepository->addAll($this -> user));
    }

    public function testCreate(){
        $session = $this->sessionService->create($this->user);
        self::assertNotNull($session);
    }
}