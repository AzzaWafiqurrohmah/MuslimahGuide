<?php

namespace MuslimahGuide\Middleware;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\session;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Service\sessionService;
use PHPUnit\Framework\TestCase;

class MustNotLogin extends TestCase
{
    private mustNotLoginMiddleware $middleware;
    private UserRepository $userRepo;
    private SessionRepository $sessionRepo;

    protected function setUp() : void
    {
        $this->middleware = new mustNotLoginMiddleware();

        $this->userRepo = new UserRepository(database::getConnection());
        $this->sessionRepo = new SessionRepository(database::getConnection());
    }

    public function testBeforeGuest()
    {
        $this->middleware->before();
        $this->expectOutputString("");
    }

    public function testBeforeLoginUser(){
        $user = new user(null, null, role::admin,"082342123456", null, "azza23", "rahasia");
        $user->setId($this->userRepo->addAll($user));

        $session = new session(uniqid(), $user);
        $this->sessionRepo->save($session);

        $cookieName = sessionService::$COOKIE_NAME;
        $_COOKIE[$cookieName] = $session->getId();


        $this->middleware->before();
        $this->expectOutputString("[Location: /]");
    }

    
}