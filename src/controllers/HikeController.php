<?php

namespace controllers;

use Exception;
use models\Hike;

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
                empty($post['description'])
            ){
                throw new Exception("101");
            }

            // create new var with value without undesired special chars
            $name = htmlspecialchars($post['name']);
            $distance = htmlspecialchars($post['distance']);
            $duration = htmlspecialchars($post['duration']);
            $elevation_gain = htmlspecialchars($post['elevation_gain']);
            $description = htmlspecialchars($post['description']);
            

            $result = Hike::insertNewHike(
                [
                    "name" => $name,
                    "distance" => $distance,
                    "duration" => $duration,
                    "elevation_gain" => $elevation_gain,
                    "description" => $description,
                    "created_at" => date('Y-m-d H:i:s'),
                    "uid" => $_SESSION['hiking_user']['uid']    
                ]
            );

            if (!$result["bool"]){
                throw new Exception("500");
            }

            $newHikeId = $result["hid"];

            header('Location: /');
            exit;

        } catch (Exception $e){
            header('Location: /creation?error_value=' . $e->getMessage());
        }
    }
    public function showUpdateHike(): void
    {

    }

    public function showHikeDetails(string|int $hid) {

        $hikeDetails = Hike::getHikeById($hid);

        include_once "views/layout/header.view.php";
        include_once "views/hike.view.php";
        include_once "views/layout/footer.view.php";
    }
}