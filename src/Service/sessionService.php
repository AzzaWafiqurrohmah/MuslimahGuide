<?php

namespace MuslimahGuide\Service;

use MuslimahGuide\Domain\session;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;

class sessionService
{
    public static string $COOKIE_NAME = "MuslimahGuide";

    private SessionRepository $sessionRepo;
    private UserRepository $userRepo;

    /**
     * @param SessionRepository $sessionRepo
     * @param UserRepository $userRepo
     */
    public function __construct(SessionRepository $sessionRepo, UserRepository $userRepo)
    {
        $this->sessionRepo = $sessionRepo;
        $this->userRepo = $userRepo;
    }

    public function create(user $user) : session{
        $session = new session(uniqid(), $user);

        $this->sessionRepo->save($session);

        setcookie(self::$COOKIE_NAME, $session->getId());
        return $session;
    }

    public function destroy(){
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';

        $this->sessionRepo->deleteById($sessionId);

        setcookie(self::$COOKIE_NAME, '', 1, "/");
    }

    public function current() : ?user{
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';

        $session = $this->sessionRepo->findById($sessionId);
        if ($session == null){
            return null;
        }
        return $this->userRepo->getById($session->getUserId()->getId());
    }

}