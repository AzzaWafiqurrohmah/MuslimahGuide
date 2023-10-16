<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\user;
use PHPUnit\Framework\TestCase;

class UserRepoTest extends TestCase
{
    private UserRepository $userRepo;
    private user $user;


    protected function setup() : void{
        $this->userRepo = new UserRepository(database::getConnection());
        $this -> user = new user(null, null, role::admin,"082342123456", null, null, "rahasia");
    }

    public function testAdd(){
        $user_id = $this->userRepo->addAll($this->user);
        self::assertTrue($user_id > 0);
    }


    public function testUpdate(){
        $user_id = $this->userRepo->addAll($this->user);

        $user2 = $this->userRepo->getById($user_id);

        $user2->setName('rika');
        $res = $this->userRepo->update($user2);

        self::assertTrue($res);
    }

    public function testDelete(){
        $this->user->setPhone("082134234212");
        $this-> user->setPassword("rahasia");
        $res = $this->userRepo->addAll($this-> user);

        self::assertEquals(true,$this->userRepo->delete($res));
    }

    public function testGet(){
        $this->userRepo->addAll($this-> user);
        $result = $this->userRepo->get(["username" => "azza23", "password" => "rahasia"]);

        var_dump($result);
        self::assertNotNull($result);
        self::assertEquals("azza23", $result->getUsername());

    }

}