<?php

namespace models;

class User extends Database
{
    public function getUserById(string|int $uid): array|bool
    {
        $sql = "SELECT * FROM Users WHERE uid = :uid";
        $result = Database::query($sql, ["uid" => $uid]);
        return $result->fetch();
    }

    public function getUserByEmail(string $email): array|bool
    {
        $sql = "SELECT * FROM Users WHERE email = :email";
        $result = Database::query($sql, ["email" => $email]);
        return $result->fetch();
    }

    public function getUserByNickNameAndEmail(array $param): array|bool
    {
        $sql = "SELECT * FROM Users WHERE nickname = :nickname OR email = :email";
        $result = Database::query($sql, $param);
        return $result->fetch();
    }

    public function insertNewUser(array $param): array|bool
    {
        $sql = "
            INSERT INTO
            Users
            (
                firstname, lastname, nickname, email, password
            )
            VALUES
            (
                :firstname, :lastname, :nickname, :email, :password
            )
        ";
        $result = Database::exec($sql, $param);
        return [
            "bool" => $result,
            "uid" => Database::lastInsertId()
        ];
    }
}