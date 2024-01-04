<?php

namespace MuslimahGuide\Repository;
use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\cycleEst;
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

    public function getById(int $id) :?cycleHistory{
        $sql = "SELECT * FROM cycle_history WHERE cycleHistory_id = ?";

        $statement = $this->connection->prepare($sql);
        if($statement->execute([$id])){
            foreach ($statement as $row){
                return $this->mapToDomain($row);
            }
        }
        return null;
    }

    public function getLastCycle(string $id) :?array{
        $sql = "SELECT * FROM cycle_history WHERE user_id = ? ORDER BY end_date DESC LIMIT 1";

        $statement = $this->connection->prepare($sql);
        if($statement->execute([$id])){
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function getAllHistCycle(string $id) :?array{
        $sql = "SELECT * FROM cycle_history WHERE user_id = ? ORDER BY end_date DESC";

        $statement = $this->connection->prepare($sql);
        if($statement->execute([$id])){
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function getAvrg(string $column, string $user_id)
    {
        $validColumns = ['period_length', 'cycle_length'];
        if (!in_array($column, $validColumns)) {
            return 0;
        }

        // Gabungkan nama kolom ke dalam query SQL dengan menggunakan tanda kutip ganda
        $sql = "SELECT $column FROM cycle_history WHERE user_id = ? ORDER BY end_date DESC LIMIT 3;";
        $data = [];

        $statement = $this->connection->prepare($sql);
        if ($statement->execute([ $user_id])) {
            $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        $first = 0;
        foreach($data as $r => $val) {
            foreach ($val as $res => $last){
                $first += $last;
            }
        }

        return ($first/count($data));
    }



    public function update(cycleHistory $cycle) :bool{
        $sql = "UPDATE cycle_history SET cycle_length = ?, period_length = ?, start_date = ?, end_date = ? WHERE cycleHistory_id = ?";

        $statement = $this->connection->prepare($sql);
        $res = $statement->execute([
            $cycle->getCycleLength(),
            $cycle->getPeriodLength(),
            $cycle->getStartDate(),
            $cycle->getEndDate(),
            $cycle->getId()
        ]);

        return $res;
    }

    public function mapToDomain($row) :cycleHistory{
        $user_id = $row['user_id'];
        $userRepo = new UserRepository(database::getConnection());
        $cycleHistory = new cycleHistory(
            $row['cycle_length'],
            $row['period_length'],
            $row['start_date'],
            $row['end_date'],
            $userRepo->getById($user_id)
        );
        return $cycleHistory;
    }

}