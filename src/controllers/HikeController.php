<?php

namespace controllers;

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
        include_once "views/layout/header.view.php";
        include_once "views/creationHikes.view.php";
        include_once "views/layout/footer.view.php";
    }

    public function creationHikesVerification(array $post): void
    {
        
    }

    public function showHikeDetails(string|int $hid) {

        $hikeDetails = Hike::getHikeById($hid);

        include_once "views/layout/header.view.php";
        include_once "views/hike.view.php";
        include_once "views/layout/footer.view.php";
    }

}