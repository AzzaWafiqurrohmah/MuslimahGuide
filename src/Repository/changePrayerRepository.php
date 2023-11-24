<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\Domain\changePrayer;
use MuslimahGuide\Domain\cycleHistory;

class changePrayerRepository
{
    private \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function addChangePrayer(changePrayer $changePrayer) :int{
        $sql = "INSERT INTO change_prayer (prayer, status, cycleHistory_id) values (?, ?, ?)";

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            $changePrayer->getPrayer(),
            $changePrayer->getStatus(),
            $changePrayer->getCycleHistory()->getId()
        ]);

        $res = $this->connection->lastInsertId();
        return $res;
    }

    public function getById(int $id) :?changePrayer{
        $sql = "SELECT * FROM change_prayer WHERE changePrayer_id = ?";

        $statement = $this->connection->prepare($sql);
        if($statement->execute([$id])){
            foreach ($statement as $row){
                return $this->mapTodDomain($row);
            }
        }
        return null;
    }

    public function update(changePrayer $changePrayer) :bool{
        $sql = "UPDATE change_prayer set prayer = ?, status = ?, cycleHistory_id = ? WHERE changePrayer_id = ?";

        $statement = $this->connection->prepare($sql);
        $res = $statement->execute([
            $changePrayer->getPrayer(),
            $changePrayer->getStatus(),
            $changePrayer->getCycleHistory()->getId(),
            $changePrayer->getId()
        ]);
        return $res;
    }

    public function mapTodDomain($row) :changePrayer{
        $cycleHistory_id = $row['cycleHistory_id'];
        $cycleHistoryRepo = new CycleHistRepository(database::getConnection());
        $change_prayer = new changePrayer(
            $row['prayer'],
            $row['status'],
            $cycleHistoryRepo->getById($cycleHistory_id)
        );

        return $change_prayer;
    }

}