<?php

namespace controllers;

use Exception;
use models\User;

class AuthController extends User
{
    public function showRegisterForm(): void
    {
        include_once "views/layout/header.view.php";
        include_once "views/register.view.php";
        include_once "views/layout/footer.view.php";
    }

    public function registerVerification(array $post): void
    {
        try {
            /*
             * 101 => no data in field
             * 102 => data found in database
             * 201 => email not valid
             * 500 => server error
             */

            // if empty field throw error
            if (
                empty($post['firstname']) ||
                empty($post['lastname']) ||
                empty($post['nickname']) ||
                empty($post['email']) ||
                empty($post['password'])
            ) {
                throw new Exception("101");
            }

            // create new var with value without undesired special chars
            $firstname = htmlspecialchars($post['firstname']);
            $lastname = htmlspecialchars($post['lastname']);
            $nickname = htmlspecialchars($post['nickname']);

            // verification of email validity
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("201");
            }

            $password_hash = password_hash($post['password'], PASSWORD_DEFAULT);

            $user = User::getUserByNickNameAndEmail(
                [
                    "nickname" => $nickname,
                    "email" => $email
                ]
            );
            if (!empty($user)) {
                throw new Exception("102");
            }

            $result = User::insertNewUser(
                [
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "nickname" => $nickname,
                    "email" => $email,
                    "password" => $password_hash,
                ]
            );
            if (!$result["bool"]) {
                throw new Exception("500");
            }

            unset($_SESSION['hiking_user']);
            $_SESSION['hiking_user'] = array(
                "uid" => $result["id"],
                "firstname" => $firstname,
                "lastname" => $lastname,
                "nickname" => $nickname,
                "email" => $email
            );

            header('Location: /');
        } catch (Exception $e) {
            header('Location: /register?error_value=' . $e->getMessage());
        }
    }

    public function logout(): void
    {
        unset($_SESSION['hiking_user']);
        header('Location: /');
    }

    public function showLoginForm(): void
    {

    }

    public function loginVerification(array $post): void
    {

    }
}