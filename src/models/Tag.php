<?php

namespace models;

class Tag extends Database
{
    public function createTag(string $name): bool
    {
        $sql = "INSERT INTO Tags (name) VALUES (:name)";
        $params = [":name" => $name];

        return $this->exec($sql, $params);
    }
}
