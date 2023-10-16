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

    public function delete(string $id) :bool{
        $sql = "DELETE FROM cycle_est WHERE cycleEst_id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        return  $statement->execute();
    }

    public function mapToDomain($row) : cycleEst{
        $cycleRepo = new CycleEstRepository(database::getConnection());
        $cycle = new cycleEst(
            $row['cycle_length'],
            $row['period_length'],
            $row['start_date'],
            $row['end_date'],
            $row['user_id']
        );
    }
}