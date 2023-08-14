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
        if(isset($_GET['error_value']))
        {
            $error_value = htmlspecialchars($_GET['error_value']);
        }
        include_once "views/layout/header.view.php";
        include_once "views/login.view.php";
        include_once "views/layout/footer.view.php";
    }

    public function loginVerification(array $post): void
    {
        try{
        // check la connexion d'un utilisateur
        // check si les champs ne sont pas vide
        // 101 => si les champs son vide
        // 201 => si l'email n'est pas valide
        // 202 => si le mot de passe n'est pas valide
        // 500 => error serveur

        if(empty($_POST['email']) || empty($post['password'])){
            throw new Exception("101");
        }
        //on filtre l'email
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('201');
        }
        // on cherche l'user associé à l'email
        $user = User::getUserByEmail($email);
        if (empty($user)){
            throw new Exception("102");
        }

        if (!password_verify($post['password'], $user['password'])) {
            throw new exception("202");
        }
        if (!$resultArray["bool"]) {
            throw new Exception("500");
        }

        unset($_SESSION['hiking_user']);
        $_SESSION['hiking_user'] = array(
            "uid" => $user['uid'],
            "nickname" => $nickname,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email
        );

        header('Location: /');
    }catch (Exception $e){
        header('Location: /login?error_value=' . $e->getMessage());
    }
    }
}