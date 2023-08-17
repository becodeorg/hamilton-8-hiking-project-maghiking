<?php foreach ($hikeDetails as $detail):
    extract($detail); ?>
    <h1><?= $name ?></h1>
    <ul>
        <li><?= $duration ?> <i class="fa-regular fa-clock"></i></li>
        <li><?= $distance ?> km</li>
        <li><?= $elevation_gain ?> mètres<i class="fa-solid fa-chart-line"></i></li>
    </ul>
    <p> <?= $description ?></p>
    <p>Créateur du hike: <?= $creator ?></p>
    <?php if ($_SESSION['hiking_user']['uid'] == $uid || $_SESSION['hiking_user']['uid'] == '1'): ?>
        <a href="/modify?value=hike&hid=<?= $hid ?>" role="button">Modifier le hike</a>
    <?php endif; ?>
<?php endforeach; ?>