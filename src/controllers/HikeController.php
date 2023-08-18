<?php

namespace controllers;

use Exception;
use models\Database;
use models\Hike;
use models\User;

class HikeController extends Hike
{
    public function showHike(): void
    {
        $hikes = Hike::getAllHike();

        include_once "views/layout/header.view.php";
        include_once "views/index.view.php";
        include_once "views/layout/footer.view.php";
    }

    public function showHikesByTag(string|int $tid): void
    {
        $hikesByTag = Hike::getAllHikeByTag($tid);

        include_once "views/layout/header.view.php";
        include_once "views/hikesTags.view.php";
        include_once "views/layout/footer.view.php";
    }


    public function showCreationHikes(): void
    {
        if(isset($_GET['error_value']))
        {
            $error_value = htmlspecialchars($_GET['error_value']);
        }

        $tags = Hike::getTags();

        include_once "views/layout/header.view.php";
        include_once "views/creationHikes.view.php";
        include_once "views/layout/footer.view.php";
    }

    public function creationHikesVerification(array $post): void
    {
        try {
            /*
             * 101 => les champs ne sont pas remplis
             * 500 => erreur serveur
             */

            // si formulaire vide
            if (
                empty($post['name']) ||
                empty($post['distance']) ||
                empty($post['duration']) ||
                empty($post['elevation_gain']) ||
                empty($post['description']) ||
                empty($post['image_url'])
            ) {
                throw new Exception("101");
            }

            // create new var with value without undesired special chars
            $name = htmlspecialchars($post['name']);
            $distance = htmlspecialchars($post['distance']);
            $duration = htmlspecialchars($post['duration']);
            $elevation_gain = htmlspecialchars($post['elevation_gain']);
            $description = htmlspecialchars($post['description']);
            $image_url = htmlspecialchars($post['image_url']);


            $result = Hike::insertNewHike(
                [
                    "name" => $name,
                    "distance" => $distance,
                    "duration" => $duration,
                    "elevation_gain" => $elevation_gain,
                    "description" => $description,
                    "created_at" => date('Y-m-d H:i:s'),
                    "image_url" => $image_url,
                    "uid" => $_SESSION['hiking_user']['uid']    
                ]
            );

            if (!$result["bool"]){
                throw new Exception("500");
            }

            $newHikeId = $result["hid"];

            if (!empty($post['tag'])) {
                foreach ($post['tag'] as $k => $v) {
                    if ($v == "on") {
                        Hike::insertHikesTags(
                            [
                                "hid" => $newHikeId,
                                "tid" => (int) $k
                            ]
                        );
                    }
                }
            }

            header('Location: /hike?hid=' . $newHikeId);
            exit;
        } catch (Exception $e){
            header('Location: /creation?error_value=' . $e->getMessage());
        }

    }
    public function showUpdateHikeForm(string|int $hid): void
    {
        $hikeDetails = Hike::getHikeById($hid);

        $tags = Hike::getTagsByHikeId($hid);

        if (isset($_GET['error_value'])) {
            $error_value = $_GET['error_value'];
        }

        include_once "views/layout/header.view.php";
        include_once "views/hikeModification.view.php";
        include_once "views/layout/footer.view.php";
    }

    public function showHikeDetails(string|int $hid): void
    {
        $hikeDetails = Hike::getHikeById($hid);

        $tags = Hike::getTagsByHikeId($hid);

        include_once "views/layout/header.view.php";
        include_once "views/hike.view.php";
        include_once "views/layout/footer.view.php";
    }

    public function updateHikeVerification(array $post, string|int $hid): void
    {
        try {
            /*
             * 101 => input filed empty
             * 401 => no modification set
             */
            if (
                empty($post['name']) ||
                empty($post['distance']) ||
                empty($post['duration']) ||
                empty($post['elevation_gain']) ||
                empty($post['description'])
            ) {
                throw new Exception("101");
            }

            $hikeDetails = Hike::getHikeById($hid);

            $name = htmlspecialchars($post['name']);
            $distance = htmlspecialchars($post['distance']);
            $duration = htmlspecialchars($post['duration']);
            $elevation_gain = htmlspecialchars($post['elevation_gain']);
            $description = htmlspecialchars($post['description']);

            $result = Hike::updateHikeById(
                [
                    "name" => $name,
                    "distance" => $distance,
                    "duration" => $duration,
                    "elevation_gain" => $elevation_gain,
                    "description" => $description,
                    "updated_at" => date('Y-m-d'),
                    "hid" => $hid
                ]
            );

            header('Location: /hike?hid=' . $hid);
        } catch (Exception $e) {
            header('Location: /modify?value=hike&hid=' . $hid . '&error_value=' . $e->getMessage());
        }
    }

    public function deleteHike(string|int $hid): void
    {
        try {
            $result = Hike::deleteHikeById($hid);

            if ($result) {
                header('Location: /');
            } else {
                throw new Exception("Erreur lors de la suppression de la randonnée.");
            }
        } catch (Exception $e) {
            header('Location: /?error=' . $e->getMessage());
            exit;
        }
    }
}
