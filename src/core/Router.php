<?php

namespace core;

use controllers\AuthController;
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
            case "/hikes":
                $hikeController = new HikeController();
                $hikeController->showHikesByTag(htmlspecialchars($_GET['tid']));
                break;
            case "/login":
                $authController = new AuthController();
                if (empty($_POST)) {
                    $authController->showLoginForm();
                } else {
                    $authController->loginVerification($_POST);
                }
                break;
            case "/register":
                $authController = new AuthController();
                if (empty($_POST)) {
                    $authController->showRegisterForm();
                } else {
                    $authController->registerVerification($_POST);
                }
                break;
            case "/logout":
                $authController = new AuthController();
                $authController->logout();
                break;
            case "/profile":
                $authController = new AuthController();
                $authController->showUserProfile();
                break;
            case "/creation":
                $hikeController = new HikeController();
                if (empty($_POST)) {
                    $hikeController->showCreationHikes();
                } else {
                    $hikeController->creationHikesVerification($_POST);
                }

            case "/hike":
                $hikeController = new HikeController();
                $hikeController->showHikeDetails(htmlspecialchars($_GET["hid"]));

                break;
        }
    }
}
