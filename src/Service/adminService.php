<?php

namespace MuslimahGuide\Service;

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
        if($request->email === null){
            throw new validationException("Harap masukkan email terlebih dahulu");
        }

        if($request->password === null){
            throw new validationException("Harap masukkan password terlebih dahulu");
        }

        $user = $this->userRepo->get(["email" => $request->email]);
        if($user == null){
            throw new validationException("email tidak ditemukan");
        }

        $user = $this->userRepo->get(["email" => $request->email, "password" => $request->password]);
        if($user == null){
            throw new validationException("password tidak sesuai");
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
        if($request->email === null){
            throw new validationException("Harap masukkan email terlebih dahulu");
        }

        if($request->username === null){
            throw new validationException("Harap masukkan username terlebih dahulu");
        }

        if($request->password == null){
            throw new validationException("Harap masukkan password terlebih dahulu");
        }

        $request -> validateRegisterRequest($request->email, $request->username, $request->password);

        $user = $this->userRepo->get(["email" => $request->email]);
        if($user !== null){
            throw new validationException("email sudah digunakan");
        }

        $user = new user(null,null, null, role::user, null, $request->email, $request->username, $request->password);
        $user->setId($this->userRepo->addAll($user));

        $response = new adminResponse();
        $response->user = $user;
        return $response;
    }
}