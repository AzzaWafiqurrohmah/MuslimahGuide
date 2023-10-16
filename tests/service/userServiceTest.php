<?php

namespace MuslimahGuide\service;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\userRequest;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class userServiceTest extends TestCase
{
    private userService $userService;
    private UserRepository $userRepo;
    private SessionRepository $sessionRepo;

    protected function setUp(): void
    {
        $connection = database::getConnection();
        $this->userRepo = new UserRepository($connection);
        $this->userService = new userService($this->userRepo);
        $this->sessionRepo = new SessionRepository($connection);
    }

    public function testLogin(){
        $user = new user('sisi', null, '087342123456', 'afdfdgdg', "azza123", 'rahasia');
        $this->expectException(validationException::class);

        $request = new userRequest();
        $request->username = "azza123";
        $request->password = "rahasia";

        $response = $this->userService->login($request);

        self::assertEquals($request->password, $response->user->getPassword());
        self::assertEquals($request->username, $response->user->getUsername());
    }

}