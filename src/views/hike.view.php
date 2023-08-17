<?php foreach ($hikeDetails as $detail): 
    extract($detail); ?>
    <h1>Nom: <?= $name ?></h1>
    <p>Description: <?= $description ?></p>
    <p>Créateur du hike: <?= $creator ?></p>
    <?php if ($_SESSION['hiking_user']['uid'] == $uid || $_SESSION['hiking_user']['uid'] == '1'): ?>
        <a href="/modify?value=hike&hid=<?= $hid ?>" role="button">Modifier le hike</a>
    <?php endif; ?>
<?php endforeach; ?>