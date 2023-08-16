<ul>
    <?php if (!empty($hikesByTag)):
    foreach ($hikesByTag as $hikeByTag):
        extract($hikeByTag); ?>

        <li><a href="/hikes?id=<?= $ID ?>"><?= $name ?></a></li>

        <li><a href="/hike.view.php?id=<?= $ID ?>"><?= $name ?></a></li>

    <?php endforeach;
    else: ?>
    <li>Aucun hike trouvé.</li>
    <?php endif; ?>
</ul>
