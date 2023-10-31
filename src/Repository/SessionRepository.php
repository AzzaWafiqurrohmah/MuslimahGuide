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
        $statement = $this->connection->prepare("INSERT INTO sessions VALUES (?, ?)");
        $statement->execute([$session->getId(), $session->getUserId()->getId()]);

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