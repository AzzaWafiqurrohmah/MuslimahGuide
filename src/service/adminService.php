<?php

namespace MuslimahGuide\service;

use MuslimahGuide\data\role;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\adminRequest;
use MuslimahGuide\Model\adminResponse;
use MuslimahGuide\Repository\UserRepository;

class adminService
{
    private UserRepository $userRepo;

    public function __construct($userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(adminRequest $request) : adminResponse{
        $request->validateUserLoginRequest($request->username, $request->password);

        $user = $this->userRepo->get(["username" => $request->username, "password"=> $request->password]);
        if($user == null){
            throw new validationException("username or password is wrong");
        }

        $response = new adminResponse();
        $response->user = $user;
        return $response;
    }

    public function register(adminRequest $request) :adminResponse{
        $request -> validateUserLoginRequest($request->username, $request->username);

        $user = new user(null, null, role::user, null, null, $request->username, $request->password);
        $user->setId($this->userRepo->addAll($user));

        $response = new adminResponse();
        $response->user = $user;
        return $response;
    }
}