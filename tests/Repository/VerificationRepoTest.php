<?php

namespace MuslimahGuide\Repository;

use Monolog\Test\TestCase;
use MuslimahGuide\Config\database;
use MuslimahGuide\data\role;
use MuslimahGuide\Domain\user;
use MuslimahGuide\Domain\verification;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertTrue;

class VerificationRepoTest extends TestCase
{
    private verification $verification;
    private VerificationRepository $verificationRepo;
    private user $user;
    private UserRepository $userRepo;

    protected function setUp(): void
    {
        $this->userRepo = new UserRepository(database::getConnection());

        $this->user = new user(null, 'contoh', null, role::admin, null, 'contoh@gmail.com','contoh', 'rahasia');
        $user_id = $this->userRepo->addAll($this->user);
        $this->user->setId($user_id);

        $this->verification = new verification(190032, $this->user);
        $this->verificationRepo = new VerificationRepository(database::getConnection());
    }

    public function testAdd(){
        $verification_id = $this->verificationRepo->add($this->verification);
        self::assertNotNull($verification_id);
    }

    public function testGet()
    {
        $verification_id = $this->verificationRepo->add($this->verification);
        $result = $this->verificationRepo->getById($verification_id);
        assertNotNull($result);
        var_dump($result);
    }

    public function  testUpdate(){
        $verification_id = $this->verificationRepo->add($this->verification);
        $this->verification->setVerificationId($verification_id);
        $this->verification->setCode(349087);

        $result = $this->verificationRepo->update($this->verification);
        assertTrue($result);
    }

    public function testDelete(){
        $verification_id = $this->verificationRepo->add($this->verification);
        $this->verification->setVerificationId($verification_id);

        $result = $this->verificationRepo->delete($this->verification->getVerificationId());
        assertTrue($result);
    }
}