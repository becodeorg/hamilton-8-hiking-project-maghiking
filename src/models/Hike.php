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

    public function getAllHikeByTag(string $tid): array|bool
    {
        $sql = "SELECT Hikes.* FROM Hikes LEFT JOIN hikes_tags ON Hikes.hid = hikes_tags.hid WHERE hikes_tags.tid = :tid";
        $result = Database::query($sql, ["tid" => $tid]);
        return $result->fetchAll();
    }
}