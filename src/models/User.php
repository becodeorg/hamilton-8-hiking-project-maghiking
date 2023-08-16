<?php

namespace models;

class User extends Database
{

    /**
     * @param string|int $uid
     * @return array|bool
     */

    public function getUserById(string|int $uid): array|bool
    {
        $sql = "SELECT * FROM Users WHERE uid = :uid";
        $result = Database::query($sql, ["uid" => $uid]);
        return $result->fetch();
    }


    /**
     * @param string $email
     * @return array|bool
     */

    public function getUserByEmail(string $email): array|bool
    {
        $sql = "SELECT * FROM Users WHERE email = :email";
        $result = Database::query($sql, ["email" => $email]);
        return $result->fetch();
    }

    /**
     * @param array $param
     * @return array|bool
     */

    public function getUserByNickNameAndEmail(array $param): array|bool
    {
        $sql = "SELECT * FROM Users WHERE nickname = :nickname OR email = :email";
        $result = Database::query($sql, $param);
        return $result->fetch();
    }

    /**
     * @param array $param
     * @return array|bool
     */


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

    /**
     * @param string|int $uid
     * @return array|bool
     */
    public function getHikeByUserId(string|int $uid): array|bool
    {
        $sql = "SELECT * FROM Hikes WHERE uid = :uid";
        $result = Database::query($sql, ["uid" => $uid]);
        return $result->fetchAll();
    }

    public function updateUserFirstnameAndLastname(array $param): bool
    {
        $sql = "UPDATE Users SET firstname = :firstname AND lastname = :lastname WHERE uid = :uid";
        return Database::exec($sql, $param);
    }

    public function updateUserFirstname(array $param): bool
    {
        $sql = "UPDATE Users SET firstname = :firstname WHERE uid = :uid";
        return Database::exec($sql, $param);
    }

    public function updateUserLastname(array $param): bool
    {
        $sql = "UPDATE Users SET lastname = :lastname WHERE uid = :uid";
        return Database::exec($sql, $param);
    }
}