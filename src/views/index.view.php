<ul>
    <?php if (!empty($hikes)):
        foreach ($hikes as $hike):
            extract($hike); ?>
            <li><a href="/hike?hid=<?= $hid ?>"><?= $name ?></a></li>
        <?php endforeach;
    else: ?>
        <li>Aucun hike trouvé.</li>
    <?php endif; ?>
<?php if (isset($_SESSION['hiking_user'])): ?>
    <a href="/creation" role="button">Ajouter un Hike</a>
    <a href="/creationtag" role="button">Ajouter un Tag</a>
<?php endif; ?>