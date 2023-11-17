<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\verification;

class VerificationRepository
{
    private \PDO $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function add(verification $verification) : ?int{
        $sql = "INSERT INTO verifications(code, user_id) VALUES (?, ?)";

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            $verification->getCode(),
            $verification->getUser()->getId()
        ]);
        $res = $this->connection->lastInsertId();
        return $res;
    }

    public function getByUserId(int $id) : ?verification{
        $sql = "SELECT * FROM verifications WHERE user_id = ?";

        $statement = $this->connection->prepare($sql);
        if($statement->execute([$id])){
            foreach ($statement as $row){
                return $this->mapToDomain($row);
            }
        }
        return null;
    }

    public function update(verification $verification) :bool{
        $sql = "UPDATE verifications SET code = ?, user_id = ? WHERE verification_id = ?";

        $statement = $this->connection->prepare($sql);
        $res = $statement->execute([
            $verification->getCode(),
            $verification->getUser()->getId(),
            $verification->getVerificationId()
        ]);

        return $res;
    }

    public function delete(int $id) :bool{
        $sql = "DELETE FROM verifications WHERE verification_id = ?";
        $statement = $this->connection->prepare($sql);

        return $statement->execute([$id]);
    }

    public function mapToDomain($row) :verification{
        $user_id = $row['user_id'];
        $userRepo = new UserRepository(database::getConnection());

        $verification = new verification(
            $row['code'],
            $userRepo->getById($user_id)
        );
        return $verification;
    }

}