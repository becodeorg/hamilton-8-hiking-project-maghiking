<?php

namespace core;

use controllers\AuthController;
use controllers\HikeController;
use controllers\TagController;

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
                if (isset($_SESSION['hiking_user'])) {
                    if (empty($_GET)) {
                        $authController->showUserProfile($_SESSION['hiking_user']['uid']);
                    } else {
                        $authController->showUserProfile(htmlspecialchars($_GET['uid']));
                    }
                } else {
                    header('Location: /login?error_value=601');
                }
                break;
            case "/creation":
                $hikeController = new HikeController();
                if (empty($_POST)) {
                    $hikeController->showCreationHikes();
                } else {
                    $hikeController->creationHikesVerification($_POST);
                }
                break;
            case "/creationtag":
                $tagController = new TagController();
                if (empty($_POST)) {
                    $tagController->ShowCreationTag();
                } else {
                    $tagController->verificationCreationTag($_POST);
                }
                break;
            case "/hike":
                $hikeController = new HikeController();
                $hikeController->showHikeDetails(htmlspecialchars($_GET['hid']));
                break;
                case "/delete-hike":
                    if (isset($_GET['hid'])) {
                        $hikeController = new HikeController();
                        $hikeController->deleteHike(htmlspecialchars($_GET['hid']));
                    }
                    break;
            case "/modify":
                if (!empty($_GET)) {
                    if ($_GET['value'] == "account") {
                        $authController = new AuthController();
                        if (empty($_POST)) {
                            $authController->showUpdateProfile();
                        } else {
                            $authController->updateProfileVerification($_POST);
                        }
                    } else if ($_GET['value'] == "hike") {
                        $hikeController = new HikeController();
                        if (empty($_POST)) {
                            $hikeController->showUpdateHikeForm(htmlspecialchars($_GET['hid']));
                        } else {
                            $hikeController->updateHikeVerification($_POST, htmlspecialchars($_GET['hid']));
                        }
                    }
                }
                break;
            default:
                break;
        }
    }
}
