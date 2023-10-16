<?php

namespace MuslimahGuide\Service;

use MuslimahGuide\Domain\user;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\userRequest;
use MuslimahGuide\Model\userResponse;
use MuslimahGuide\Repository\UserRepository;

class userService
{
    private UserRepository $userRepo;

    public function __construct($userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(userRequest $request) : userResponse{
        $request->validateUserLoginRequest($request->username, $request->password);

        $user = $this->userRepo->get(["username" => $request->username, "password"=> $request->password]);
        if($user == null){
            throw new validationException("username or password is wrong");
        }

        $response = new userResponse();
        $response->user = $user;
        return $response;
    }
}