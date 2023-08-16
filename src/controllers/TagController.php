<?php

namespace controllers;

use Exception;
use models\Tag;

class TagController 
{
    public function showCreationTag(): void
    {
        if (isset($_GET['error_value'])) {
            $error_value = htmlspecialchars($_GET['error_value']);
        }
        include_once "views/layout/header.view.php";
        include_once "views/creationTags.view.php";
        include_once "views/layout/footer.view.php";
    }

    public function createTag(string $name): bool
    {
        $tid = uniqid(); // Génère un ID unique pour le tag
        $sql = "INSERT INTO Tags (tid, name) VALUES (:tid, :name)";
        $params = [":tid" => $tid, ":name" => $name];

        return $this->exec($sql, $params);
    }

    public function verificationCreationTag(): void
{
    try {
        if (empty($_POST['name'])) {
            throw new Exception("101");
        }

        $name = htmlspecialchars($_POST['name']);
        $tagModel = new Tag();
        
        if ($tagModel->createTag($name)) {
            header('Location: /');
            exit();
        } else {
            throw new Exception("500");
        }
    } catch (Exception $e) {
        header('Location: /creationTags?error_value=' . $e->getMessage());
        exit();
    }
}

        
    

}