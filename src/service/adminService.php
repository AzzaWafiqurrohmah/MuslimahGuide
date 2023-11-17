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
        $request->validateUserMobileRequest($request->email, $request->password);

        $user = $this->userRepo->get(["email" => $request->email, "password"=> $request->password]);
        if($user == null){
            throw new validationException("email or password is wrong");
        }

        $response = new adminResponse();
        $response->user = $user;
        return $response;
    }

    public function loginWeb(adminRequest $request) : adminResponse{
        $request->validateUserMobileRequest($request->username, $request->password);

        $user = $this->userRepo->get(["username" => $request->username, "password"=> $request->password]);
        if($user == null){
            throw new validationException("email or password is wrong");
        }

        $response = new adminResponse();
        $response->user = $user;
        return $response;
    }

    public function loginEmail(adminRequest $request) : adminResponse{
        $request->validateUserEmailRequest($request->email);

        $user = $this->userRepo->get(["email" => $request->email]);
        if($user == null){
            throw new validationException("email or password is wrong");
        }

        $response = new adminResponse();
        $response->user = $user;
        return $response;
    }

    public function register(adminRequest $request) :adminResponse{
        $request -> validateUserRequest($request->email, $request->password);

        $user = new user(null,null, null, role::user, null, $request->email, null, $request->password);
        $user->setId($this->userRepo->addAll($user));

        $response = new adminResponse();
        $response->user = $user;
        return $response;
    }
}