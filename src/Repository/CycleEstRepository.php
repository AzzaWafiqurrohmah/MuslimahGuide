<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\cycleEst;
use MuslimahGuide\Domain\user;

class CycleEstRepository
{
    private \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function addAll(cycleEst $cycle) : ?int{
        $sql = "INSERT INTO cycle_est(cycle_length, period_length, start_date, end_date, user_id) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            $cycle->getCycleLength(),
            $cycle->getPeriodLength(),
            $cycle->getStartDate(),
            $cycle->getEndDate(),
            $cycle->getUser_id()->getId()
        ]);

        $res = $this->connection->lastInsertId();
        return $res;
    }

    public function update(cycleEst $cycle) :bool{
        $sql = "UPDATE cycle_est SET cycle_length = ?, period_length = ?, start_date = ?, end_date = ? WHERE user_id = ?";

        $statement = $this->connection->prepare($sql);
        $res = $statement->execute([
            $cycle->getCycleLength(),
            $cycle->getPeriodLength(),
            $cycle->getStartDate(),
            $cycle->getEndDate(),
            $cycle->getUser_id()->getId()
        ]);

        return $res;
    }

    public function getByUserId(string $id) :?array{
        $sql = "SELECT * FROM cycle_est WHERE user_id = ?";

        $statement = $this->connection->prepare($sql);
        if($statement->execute([$id])){
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function getById(string $id) : ?cycleEst{
        $sql = "SELECT * FROM cycle_est WHERE cycleEst_id = ?";

        $statement = $this->connection->prepare($sql);
        if($statement->execute([$id])){
            foreach ($statement as $row){
                return $this->mapToDomain($row);
            }
        }
        return null;
    }

    public function getAll() :array {
        $sql = "SELECT cycleEst_id, start_date, end_date FROM cycle_est ";
        $statement = $this->connection->prepare($sql);
        if($statement->execute()){
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function delete(string $id) :bool{
        $sql = "DELETE FROM cycle_est WHERE cycleEst_id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        return  $statement->execute();
    }

    public function mapToDomain($row) : cycleEst{
        $user_id = $row['user_id'];
        $userRepo = new UserRepository(database::getConnection());
        $cycle = new cycleEst(
            $row['cycle_length'],
            $row['period_length'],
            $row['start_date'],
            $row['end_date'],
            $userRepo->getById($user_id)
        );
        return $cycle;
    }
}