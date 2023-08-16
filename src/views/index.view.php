<ul>
    <?php if (!empty($hikes)):
        foreach ($hikes as $hike):
            extract($hike); ?>
            <li><a href="/hike?hid=<?= $hid ?>"><?= $name ?></a></li>
        <?php endforeach;
    else: ?>
        <li>Aucun hike trouvé.</li>
    <?php endif; ?>
</ul>
