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

        $sql = "INSERT INTO reminder(type, user_id) VALUES (?, ?) ";
        $statement = $this->connection->prepare($sql);
        $statement->execute([
            $reminder->getType(), $reminder->getUserId()->getId()
        ]);

        $user_id = $this->connection->lastInsertId();

        return $user_id;
    }

    public function update(reminder $reminder) :bool{
        $sql = "UPDATE reminder SET type = ?, message = ?, reminder = ?, reminder_time = ?, is_on = ?, is_read = ? WHERE user_id = ?";

        $statement = $this->connection->prepare($sql);
        $res = $statement->execute([
            $reminder->getType(), $reminder->getMessage(), $reminder->getReminder(), null, $reminder->getIsOn(), $reminder->getIsRead(), $reminder->getUserId()->getId()
        ]);

        return $res;
    }

    public function delete(string $id) : bool{
        $sql = "DELETE FROM reminder WHERE reminder_id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        return $statement->execute();
    }

    public function getById(int $id){
        $sql = "SELECT * FROM reminder WHERE reminder_id = ?";
        $statement = $this->connection->prepare($sql);
        if($statement->execute([$id])){
            foreach ($statement as $row){
                return $this->mapToDomain($row);
            }
        }
        return null;
    }

    public function mapToDomain($row) : reminder{
        $user_id = $row['user_id'];
        $time = $row['reminder_time'];
        $userRepo = new UserRepository(database::getConnection());
        $reminder = new reminder(
            $row['type'],
            $row['message'],
            $row['reminder'],
            \DateTime::createFromFormat("H:i:s", $time),
            $row['is_on'],
            $row['is_read'],
            $userRepo->getById($user_id)
        );

        return $reminder;
    }


}