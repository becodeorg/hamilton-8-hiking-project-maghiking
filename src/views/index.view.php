<section class="cards-wrapper">
    <?php if (!empty($hikes)):
        foreach ($hikes as $hike):
            extract($hike); ?>
            <div class="card">
                <img width="300px" src="<?= $image_url ?>" alt="photo-rando">
                <h4><a href="/hike?hid=<?= $hid ?>"><?= $name ?></a></h4>
                <p><?= $distance ?> km</p>
                <p><?= $duration ?> h</p>
                <a href="/profile?uid=<?= $uid ?>"><?= $nickname ?></a>
            </div>
        <?php endforeach;
    else: ?>
        <p>Aucun hike trouvé.</p>
    <?php endif; ?>
</section>
<section>
<?php if (isset($_SESSION['hiking_user'])): ?>
    <a href="/creation" role="button">Ajouter un Hike</a>
    <a href="/creationtag" role="button">Ajouter un Tag</a>
<?php endif; ?>
</section>
