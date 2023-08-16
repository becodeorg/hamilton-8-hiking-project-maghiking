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

    public function verificationCreationTag(): void
    {
        echo "blabla";
    }
}