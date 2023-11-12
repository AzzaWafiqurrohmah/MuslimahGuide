<?php

namespace MuslimahGuide\Repository;


use MuslimahGuide\Domain\education;

class EducationRepository
{
    private \PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function add(education $education) :int{
        $sql = "INSERT INTO educations(img, title, contents, on_clicked) VALUES(?, ?, ?, ?)";
        $statement = $this->connection->prepare($sql);

        $statement->execute([
            $education->getImg(),
            $education->getTitle(),
            $education->getContents(),
            $education->getOnClicked()
        ]);
        $res = $this->connection->lastInsertId();
        return $res;
    }

    public function update(education $education) :bool{
        $sql = "UPDATE educations SET img = ?, title = ?, contents = ?, on_clicked = ? WHERE education_id = ?";
        $statement = $this->connection->prepare($sql);

        $res = $statement->execute([
            $education->getImg(),
            $education->getTitle(),
            $education->getContents(),
            $education->getOnClicked(),
            $education->getEducationId()
        ]);
        return $res;
    }

    public function delete(string $id) :bool{
        $sql = "DELETE FROM educations WHERE education_id = ?";
        $statement = $this->connection->prepare($sql);

        return $statement->execute([$id]);
    }

    public function getById(int $id) : ?education{
        $sql = "SELECT * FROM educations WHERE education_id = ?";
        $statement = $this->connection->prepare($sql);

        if($statement->execute([$id])){
            foreach ($statement as $row){
                return $this->mapToDomain($row);
            }
        }
        return null;
    }

    public function getAll() :?array{
        $sql = "SELECT * FROM educations";

        $statement = $this->connection->prepare($sql);
        if($statement->execute()){
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function getBy(array $values) :?education{
        $iterate = 0;
        $sql = "SELECT * FROM educations WHERE ";
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


    public function mapToDomain($row) :education{
        $education = new education(
            $row['img'],
            $row['title'],
            $row['contents'],
            $row['on_clicked']
        );

        return $education;
    }

}