<?php foreach ($hikeDetails as $detail): 
extract($detail); ?>

<h1><?= $name ?></h1>
<ul>
    <li><?= $duration ?> <i class="fa-regular fa-clock"></i></li>
    <li><?= $distance ?> km</li>
    <li><?= $elevation_gain ?> mètres<i class="fa-solid fa-chart-line"></i></li>
</ul>
<p> <?= $description ?></p>

<?php endforeach; ?>