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
}