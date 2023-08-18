<section class="cards-wrapper">
    <?php if (!empty($hikesByTag)):
    foreach ($hikesByTag as $hikeByTag):
        extract($hikeByTag); ?>
        <div class="card">
            <a href="/hikes?id=<?= $ID ?>"><?= $name ?></a>
            <p><?= $distance ?> km</p>
            <p><?= $duration ?> h</p>
            <a href="/profile?uid=<?= $uid ?>"><?= $creator ?></a>
        </div>
    <?php endforeach;
    else: ?>
    <li>Aucun hike trouvé.</li>
    <?php endif; ?>
</section>
