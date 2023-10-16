<?php

namespace MuslimahGuide\Repository;
use MuslimahGuide\Domain\cycleHistory;

class CycleHistRepository
{
    private \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function addAll(cycleHistory $cycle) : ?int{
        $sql = "INSERT INTO cycle_history(cycle_length, period_length, start_date, end_date, user_id) VALUES (?, ?, ?, ?, ?)";

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

}