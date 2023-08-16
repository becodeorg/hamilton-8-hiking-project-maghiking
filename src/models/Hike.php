<?php

namespace models;

class Hike extends Database
{
    public function getAllHike(): array|bool
    {
        $sql = "SELECT * FROM Hikes LIMIT 30";
        $result = Database::query($sql);
        return $result->fetchAll();
    }

    public function getAllHikeByTag(string $tid): array|bool
    {
        $sql = "SELECT Hikes.* FROM Hikes LEFT JOIN hikes_tags ON Hikes.hid = hikes_tags.hid WHERE hikes_tags.tid = :tid";
        $result = Database::query($sql, ["tid" => $tid]);
        return $result->fetchAll();
    }

    public function insertNewHike(array $param): array|bool
    {
        $sql = "
            INSERT INTO
            Hikes
            (
                name, distance, duration, elevation_gain, description, created_at, uid
            )
            VALUES
            (
                :name, :distance, :duration, :elevation_gain, :description, :created_at, :uid
            )
        ";
        $result = Database::exec($sql, $param);
        if ($result) {
            $lastInsertId = Database::lastInsertId();
            return [
                "bool" => true,
                "hid" => $lastInsertId
            ];
        } else {
            return ["bool" => false];
    }
    }

    public function getHikeById($hid) {

        $sql = "SELECT * FROM Hikes WHERE hid = :hid";
        $result = Database::query($sql, ["hid" => $hid]);
        return $result->fetchAll();
    }

}
