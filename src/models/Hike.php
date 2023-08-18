<?php

namespace models;

class Hike extends Database
{
    public function insertHikeTagsRelation(int|string $tid, int|string $hid): bool
    {
        $sql = "INSERT INTO hikes_tags (hid, tid) VALUES (:hid, :tid)";
        return Database::exec(
            $sql,
            [
                "hid" => $hid,
                "tid" => $tid
            ]
        );
    }

    public function deleteHikeTagsRelation(int|string $tid, int|string $hid): bool
    {
        $sql = "DELETE FROM hikes_tags WHERE tid = :tid AND hid = :hid";
        return Database::exec(
            $sql,
            [
                "tid" => $tid,
                "hid" => $hid
            ]
        );
    }

    public function getTagsNotLink(int|string $hid): array|bool
    {
        $sql = "
            SELECT
                Tags.*
            FROM
                Tags
            JOIN
                hikes_tags
            ON
                Tags.tid = hikes_tags.tid
            WHERE
                hikes_tags.tid
            NOT IN (
                SELECT tid FROM hikes_tags WHERE hid = :hid
            )
        ";
        $result = Database::query($sql, ["hid" => $hid]);
        return $result->fetchAll();
    }

    public function deleteTagsByHikeId(int|string $hid): bool
    {
        $sql = "DELETE FROM hikes_tags WHERE hid = :hid";
        return Database::exec($sql, ["hid" => $hid]);
    }

    public function getTags(): array|bool
    {
        $sql = "SELECT * FROM Tags";
        $result = Database::query($sql);
        return $result->fetchAll();
    }

    public function getTagsByHikeId(string|int $hid): array|bool
    {
        $sql = "SELECT Tags.* FROM Tags JOIN hikes_tags ON Tags.tid = hikes_tags.tid WHERE hikes_tags.hid = :hid";
        $result = Database::query($sql, ["hid" => $hid]);
        return $result->fetchAll();
    }

    public function getAllHike(): array|bool
    {
        $sql = "SELECT Hikes.*, Users.nickname FROM Hikes JOIN Users ON Hikes.uid = Users.uid";
        $result = Database::query($sql);
        return $result->fetchAll();
    }

    public function getAllHikeByTag(string $tid): array|bool
    {
        $sql = "SELECT Hikes.*, Users.nickname as creator FROM Hikes LEFT JOIN hikes_tags ON Hikes.hid = hikes_tags.hid JOIN Users ON Hikes.uid = Users.uid WHERE hikes_tags.tid = :tid";
        $result = Database::query($sql, ["tid" => $tid]);
        return $result->fetchAll();
    }

    public function insertNewHike(array $param): array|bool
    {
        $sql = "INSERT INTO Hikes (name, distance, duration, elevation_gain, description, created_at, image_url, uid) VALUES (:name, :distance, :duration, :elevation_gain, :description, :created_at, :image_url, :uid)";
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

    public function getHikeById($hid): array|bool
    {
        $sql = "SELECT Hikes.*, Users.nickname as creator FROM Hikes JOIN Users ON Hikes.uid = Users.uid WHERE hid = :hid";
        $result = Database::query($sql, ["hid" => $hid]);
        return $result->fetchAll();
    }

    public function insertHikesTags(array $param): bool
    {
        $sql = "INSERT INTO hikes_tags (hid, tid) VALUES (:hid, :tid)";
        return Database::exec($sql, $param);
    }

    public function deleteHikeById(string|int $hid): bool
    {
        $sql = "DELETE FROM Hikes WHERE hid = :hid";
        return Database::exec($sql, ["hid" => $hid]);
    }

    public function updateHikeById(array $param): bool
    {
        $sql = "
        UPDATE
            Hikes
        SET
            name = :name,
            distance = :distance,
            duration = :duration,
            elevation_gain = :elevation_gain,
            description = :description,
            updated_at = :updated_at
        WHERE
            hid = :hid";
        return Database::exec($sql, $param);
    }
}
