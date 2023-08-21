<?php

namespace controllers;

use Exception;
use models\Hike;
use models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class AuthController extends User
{
    public function showRegisterForm(): void
    {
        if (isset($_GET['error_value'])) {
            $error_value = htmlspecialchars($_GET['error_value']);
        }
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

            try {
                $mail = new PHPMailer(true);

                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host = getenv('EMAIL_HOST');
                $mail->SMTPAuth = true;
                $mail->Username = getenv('EMAIL_USERNAME');
                $mail->Password = getenv('EMAIL_PASSWORD');
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom(getenv('EMAIL_USERNAME'), 'Hiking');
                $mail->addAddress($email, $nickname);

                $mail->isHTML(true);
                $mail->Subject = 'Bienvenue sur Hiking!';
                $mail->Body =
                    '<html lang="fr">
                        <body>
                            <h3>Bienvenue sur Hiking!</h3>
                            <p>Nous confirmons votre inscription sur Hiking.</p>
                        </body>
                    </html>';
                $mail->send();
                echo "Mail successfully send!";
            } catch (\PHPMailer\PHPMailer\Exception $e) {
                echo $e->getMessage();
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
        try {
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
            if (!$user) {
                throw new Exception("500");
            }

            if (empty($user)){
                throw new Exception("102");
            }

            if (!password_verify($post['password'], $user['password'])) {
                throw new exception("202");
            }

            unset($_SESSION['hiking_user']);
            $_SESSION['hiking_user'] = array(
                "uid" => $user['uid'],
                "nickname" => $user['nickname'],
                "firstname" => $user['firstname'],
                "lastname" => $user['lastname'],
                "email" => $email
            );

            header('Location: /');
        } catch (Exception $e) {
            header('Location: /login?error_value=' . $e->getMessage());
        }
    }

    public function showUserProfile(string|int $uid): void
    {
        $user = User::getUserById($uid);
        if ($_SESSION['hiking_user']['uid'] == '1' && !isset($_GET['uid'])) {
            $hikes = (new Hike())->getAllHike();
        } else {
            $hikes = User::getHikeByUserId($uid);
        }

        include_once "views/layout/header.view.php";
        include_once "views/profile.view.php";
        include_once "views/layout/footer.view.php";
    }

    public function showUpdateProfile(): void
    {
        if(isset($_GET['error_value'])) {
            $error_value = htmlspecialchars($_GET['error_value']);
        }
        if (isset($_GET['modify'])) {
            $modify = htmlspecialchars($_GET['modify']);
        }
        include_once "views/layout/header.view.php";
        include_once "views/updateProfile.view.php";
        include_once "views/layout/footer.view.php";
    }

    public function updateProfileVerification(array $post): void
    {
        try {
            // check la modification des informations d'un utilisateur
            // 101 => si les champs son vide
            // 202 => si le mot de passe n'est pas valide
            // 500 => error serveur
            if (
                empty($post['firstname']) ||
                empty($post['lastname']) ||
                empty($post['password'])
                ) {
                throw new Exception("101");
            }

            $firstname = htmlspecialchars($post['firstname']);
            $lastname = htmlspecialchars($post['lastname']);

            $user = User::getUserById($_SESSION['hiking_user']['uid']);
            if (!$user) {
                throw new Exception("500");
            }
            if ($firstname != $user['firstname']) {
                if ($lastname != $user['lastname']) {
                    $result = User::updateUserFirstnameAndLastname(
                        [
                            "firstname" => $firstname,
                            "lastname" => $lastname,
                            "uid" => $_SESSION['hiking_user']['uid']
                        ]
                    );
                } else {
                    $result = User::updateUserFirstname(
                        [
                            "firstname" => $firstname,
                            "uid" => $_SESSION['hiking_user']['uid']
                        ]
                    );
                }
            } else {
                if ($lastname != $user['lastname']) {
                    $result = User::updateUserLastname(
                        [
                            "lastname" => $lastname,
                            "uid" => $_SESSION['hiking_user']['uid']
                        ]
                    );
                } else {
                    throw new Exception("301");
                }
            }

            if (!password_verify($post['password'], $user['password'])) {
                throw new Exception("202");
            }
            if (!$result) {
                throw new Exception("500");
            }

            unset($_SESSION['hiking_user']);
            $_SESSION['hiking_user'] = array(
                "uid" => $user['uid'],
                "nickname" => $user['nickname'],
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $user['email']
            );

            header('Location: /modify?value=account&modify=true');
        } catch (Exception $e) {
            header('Location: /modify?value=account&error_value=' . $e->getMessage());
        }
    }
}