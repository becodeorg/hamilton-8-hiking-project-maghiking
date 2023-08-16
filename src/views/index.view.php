<ul>
    <?php if (!empty($hikes)):
        foreach ($hikes as $hike):
            extract($hike); ?>
            <li><a href="/hike?hid=<?= $hid ?>"><?= $name ?></a></li>
        <?php endforeach;
    else: ?>

        <li>Auncun hike trouvé.</li>
    <?php endif; ?>
</ul>
<?php if (isset($_SESSION['hiking_user'])): ?>
    <a href="/creation" role="button">Ajouter un Hike</a>
<?php else: ?>

        <li>Aucun hike trouvé.</li>
    <?php endif; ?>
</ul>