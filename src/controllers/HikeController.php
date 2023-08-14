<?php

namespace controllers;

use models\Hike;

class HikeController extends Hike
{
    public function showHike(): void
    {
        $hikes = Hike::getAllHike();

        foreach ($hikes as $hike) {
            extract($hike);
            echo $name;
        }
    }
}