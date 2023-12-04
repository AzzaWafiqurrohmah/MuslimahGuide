<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\session;

class SessionRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(session $session) : ?session{
        date_default_timezone_set('Asia/Jakarta');
        $expiryTime = time() + (5 * 60 * 60); //every 5 hours, 5 hours * 60 minutes * 60 seconds
        $expiryTimeFormatted = date('Y-m-d H:i:s', $expiryTime);

        $statement = $this->connection->prepare("INSERT INTO sessions VALUES (?, ?, ?)");
        $statement->execute([$session->getId(), $expiryTimeFormatted ,$session->getUserId()->getId()]);

        return $session;
    }

    public function findById(string $id) : ?session {
        $sql = "SELECT * FROM sessions WHERE session_id = ?";
        $statement = $this->connection->prepare($sql);

        if($statement->execute([$id])){
            foreach ($statement as $row){
                return $this->mapToDomain($row);
            }
        }
        return null;
    }

    public function deleteById(string $id) : bool{
        $statement = $this->connection->prepare("DELETE FROM sessions WHERE session_id = ?");
        return $statement->execute([$id]);
    }

    public function expiredTime(){
        date_default_timezone_set('Asia/Jakarta');
        $currentTime = date('Y-m-d H:i:s', time());

        $sql = "DELETE FROM sessions WHERE expiryTime <= ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$currentTime]);
    }

    public function getById(string $id) : ?session{
        $sql = "SELECT * FROM sessions WHERE session_id = ?";
        $statement = $this->connection->prepare($sql);
        if($statement->execute([$id])){
            foreach ($statement as $row){
                return $this->mapToDomain($row);
            }
        }
        return null;
    }

    public function mapToDomain($row) : session{
        $user_id = $row['user_id'];
        $UserRepo = new UserRepository(database::getConnection());

        $session = new session(
            $row['session_id'],
            $UserRepo->getById($user_id)
        );

        return $session;
    }

}