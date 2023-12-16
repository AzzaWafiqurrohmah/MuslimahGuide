<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Config\database;
use MuslimahGuide\data\reminderType;
use MuslimahGuide\Domain\reminder;
use MuslimahGuide\Domain\user;

class ReminderRepository
{
    private  \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function add(reminder $reminder) : ?int{

        $sql = "INSERT INTO reminder(type, cycleEst_id) VALUES (?, ?) ";
        $statement = $this->connection->prepare($sql);
        $statement->execute([
            $reminder->getType(), $reminder->getCycleEst()->getId()
        ]);

        $user_id = $this->connection->lastInsertId();

        return $user_id;
    }

    public function update(reminder $reminder) :bool{
        $sql = "UPDATE reminder SET message = ?, reminderDays = ?, reminder_time = ?, is_on = ?, cycleEst_id = ? WHERE reminder_id = ?";

        $reminder->setCycleEst($reminder->getCycleEst());
        $statement = $this->connection->prepare($sql);
        $res = $statement->execute([
            $reminder->getMessage(), $reminder->getReminder(), $reminder->getTime(), $reminder->getIsOn(), $reminder->getCycleEst()->getId(), $reminder->getReminderId()
        ]);

        return $res;
    }

    public function delete(string $id) : bool{
        $sql = "DELETE FROM reminder WHERE reminder_id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        return $statement->execute();
    }

    public function getById(string $id){
        $sql = "SELECT * FROM reminder WHERE reminder_id = ?";
        $statement = $this->connection->prepare($sql);
        if($statement->execute([$id])){
            foreach ($statement as $row){
                return $this->mapToDomain($row);
            }
        }
        return null;
    }

    public function getByIdAPI(string $id) :?array{
        $sql = "SELECT reminder.*, cycle_est.start_date, cycle_est.end_date FROM reminder JOIN cycle_est ON reminder.cycleEst_id = cycle_est.cycleEst_id WHERE reminder.reminder_id = ?;
";
        $statement = $this->connection->prepare($sql);
        if($statement->execute([$id])){
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function getAll(string $id) :?array{
        $sql = "SELECT reminder.*, cycle_est.start_date, cycle_est.end_date FROM reminder JOIN cycle_est ON reminder.cycleEst_id = cycle_est.cycleEst_id WHERE cycle_est.user_id = ? ORDER BY `reminder`.`type` ASC";
         $statement = $this->connection->prepare($sql);
         if($statement->execute([$id])){
             return $statement->fetchAll(\PDO::FETCH_ASSOC);
         }
         return [];
    }

    public function mapToDomain($row) : reminder{
        $cycleEst_id = $row['cycleEst_id'];
        $cycleEstRepo = new CycleEstRepository(database::getConnection());
        $reminder = new reminder(
            $row['type'],
            $row['message'],
            $row['reminderDays'],
            $row['reminder_time'],
            $row['is_on'],
            $cycleEstRepo->getById($cycleEst_id)
        );
        return $reminder;
    }


}