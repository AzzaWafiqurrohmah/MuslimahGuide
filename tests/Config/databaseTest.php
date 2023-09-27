<?php

namespace MuslimahGuide\Config;

use PHPUnit\Framework\TestCase;

class databaseTest extends TestCase
{
    /**
     * @test
     */
    public function testConnection()
    {
        $connection = database::getConnection();
        self::assertNotNull($connection);
    }
}