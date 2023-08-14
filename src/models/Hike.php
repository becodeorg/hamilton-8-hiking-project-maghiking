<?php

namespace models;

class Hike extends Database
{
    public function getAllHike(): array|bool
    {
        $sql = "SELECT * FROM Hikes LIMIT 20";
        $result = Database::query($sql);
        return $result->fetchAll();
    }
}