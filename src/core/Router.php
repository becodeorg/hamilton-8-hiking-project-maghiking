<?php

namespace core;

use controllers\HikeController;

class Router
{
    public function route(string $uri_path): void
    {
        switch ($uri_path) {
            case "/":
            case "/index":
            case "/home":
                $hikeController = new HikeController();
                $hikeController->showHike();
                break;
        }
    }
}
