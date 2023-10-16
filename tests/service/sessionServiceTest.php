<?php

namespace MuslimahGuide\service;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\session;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class sessionServiceTest extends TestCase
{
    private sessionService $sessionService;
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;
    protected function setUp() : void{
        $this->sessionRepository = new SessionRepository(database::getConnection());
        $this->userRepository = new UserRepository(database::getConnection());
        $this->sessionService = new sessionService($this->sessionRepository, $this->userRepository);

        $user = new user("azza", null, null, "azza@gmail.com", "azza345", "rahasia");
        $this->userRepository->addAll($user);
    }

    public function testCreate(){
        $session = $this->sessionService->create("eko");
        $this->expectOutputRegex("[MuslimahGuide: $session->getId]");
    }
}