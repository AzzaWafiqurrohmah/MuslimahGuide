<?php

namespace MuslimahGuide\Config;

class database{
    private static ?\PDO $pdo = null;


    public static function getConnection(): \PDO{
        if(self::$pdo == null){
            require_once __DIR__ . "/../../config/Database.php";
            $config = getdatabaseconfig();
            self::$pdo = new \PDO(
                $config['database']['url'],
                $config['database']['username'],
               $config['database']['password'],
            );
        }
        return self::$pdo;
    }

}
