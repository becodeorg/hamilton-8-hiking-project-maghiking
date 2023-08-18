<?php foreach ($hikeDetails as $detail):
    extract($detail); ?>
    <h1><?= $name ?></h1>
    <ul>
        <img width="800px" src="<?= $image_url ?>" alt="photo-rando">
        <li><?= $duration ?> <i class="fa-regular fa-clock"></i></li>
        <li><?= $distance ?> km</li>
        <li><?= $elevation_gain ?> mètres<i class="fa-solid fa-chart-line"></i></li>
    </ul>
    <p> <?= $description ?></p>
    <p>Créateur du hike: <a href="/profile?uid=<?= $uid ?>"><?= $creator ?></a></p>
    <h3>Tags: </h3>
    <ul>
        <?php foreach ($tags as $tag): ?>
            <li><a href="/hikes?tid=<?= $tag['tid'] ?>"><?= $tag['name'] ?></a></li>
        <?php endforeach; ?>
    </ul>
    <?php if ($_SESSION['hiking_user']['uid'] == $uid || $_SESSION['hiking_user']['uid'] == '1'): ?>
        <a href="/modify?value=hike&hid=<?= $hid ?>" role="button">Modifier le hike</a>
    <?php endif; ?>
<?php endforeach; ?>
<?php if (isset($error_value)): ?>
    <?php if ($error_value == "500"): ?>
        <p class="message error">Il semblerait que l'on est rencontré une erreur. Veuillez essayer plus tard.</p>
    <?php endif; ?>
<?php endif; ?>
