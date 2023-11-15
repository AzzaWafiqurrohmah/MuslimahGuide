<?php

namespace MuslimahGuide\Repository;

use MuslimahGuide\Domain\user;

class UserRepository
{
    private \PDO $connection;


    public function __construct($connection)
    {
        $this->connection = $connection;
    }


    public function addAll(user $user) : int{
        $sql = "INSERT INTO users(name, birthdate, role, phone, email, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            $user->getName(),
            $user->getBirthDate(),
            $user->getRole(),
            $user->getPhone(),
            $user->getEmail(),
            $user->getUsername(),
            $user->getPassword()
        ]);
        $res = $this->connection->lastInsertId();

        return $res;
    }

    public function update(user $user) : bool{
        $sql = "UPDATE users SET profileImg = ?, name = ?, birthdate = ?, phone = ?, email = ?, username = ?, password = ? WHERE user_id = ?";

        $statement = $this->connection->prepare($sql);
        $res = $statement->execute([
            $user->getProfileImg() ,$user->getName(), $user->getBirthDate(), $user->getPhone(), $user->getEmail(), $user->getUsername(), $user->getPassword(), $user->getId()
        ]);

        return $res;
    }

    public function delete(string $id) : bool {
        $sql = "DELETE FROM users WHERE user_id = ?";

        $statement = $this->connection->prepare($sql);

        return  $statement->execute([$id]);
    }



    public function findById(string $id) : ?string{
        $statement = $this->connection->prepare("SELECT * FROM users WHERE user_id = ?");
        $statement->execute([$id]);

        try {
            if($row = $statement->fetch()){
                $user = new user();
                $user->setId($row['user_id']);

                return $user->getId();
            }
                return null;
        } finally {
            $statement->closeCursor();
        }
    }

    public function getById(int $id) : ?user {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $statement = $this->connection->prepare($sql);
        if ($statement->execute([$id])){
            foreach ($statement as $row){
                return $this->mapToDomain($row);
            }
        }
        return null;
    }

    public function getByIdAPI(int $id) : ?array {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $statement = $this->connection->prepare($sql);
        if ($statement->execute([$id])){
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function get(array $values) : ?user{
        $iterate = 0;
        $sql = "SELECT * FROM users WHERE ";
        $params = [];

        foreach ($values as $valuekey => $value){
            if($iterate > 0) {
                $sql .= " AND ";
            }
            $params[] = $value;
            $sql .= $valuekey . " = ?";
            $iterate++;
        }

        $statement = $this->connection->prepare($sql);
        $statement->execute($params);

        foreach ($statement as $row){
          return $this->mapToDomain($row);
        }
        return null;
    }

    public function chart() :array{
        $sql = "SELECT COALESCE(TIMESTAMPDIFF(YEAR, birthdate, CURDATE()), 0) as usia,  COUNT(*) as jumlah FROM users WHERE role='user' GROUP BY usia;";
        $data = ["usia"=>[], "jumlah"=>[]];

        $statement = $this->connection->prepare($sql);
        if($statement->execute()){
            foreach ($statement as $row){
                $data["usia"][] = $row['usia'];
                $data["jumlah"][] = $row['jumlah'];
            }
        }

        return $data;
    }

    public function userTable(): array{
        $sql = "SELECT user_id, name AS fullname, birthdate, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) as age, phone, username, email, password FROM users  WHERE role='user'";

        $statement = $this->connection->prepare($sql);

        if($statement->execute()){
            return $statement->fetchAll(\PDO::FETCH_ASSOC);

        }

        return  [];
    }


    public function mapToDomain($row) : user{
            $user = new user(
                $row['profileImg'],
                $row['name'],
            $row['birthdate'],
            $row['role'],
            $row['phone'],
            $row['email'],
            $row['username'],
            $row['password']
            );

            $user->setId($row['user_id']);
            return $user;
    }



}