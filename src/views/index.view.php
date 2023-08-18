
<section class="cards-wrapper">
    <?php if (!empty($hikes)):
        foreach ($hikes as $hike):
            extract($hike); ?>
            <div class="card">
                <img width="300px" src="<?= $image_url ?>" alt="photo-rando">
                <h4><a href="/hike?hid=<?= $hid ?>"><?= $name ?></a></h4>
                <p><?= $distance ?> km</p>
                <p><?= $duration ?> <i class="fa-solid fa-clock"></i></p>
                <a href="/profile?uid=<?= $uid ?>"><i class="fa-solid fa-user"></i> <?= $nickname ?></a>
            </div>
        <?php endforeach;
    else: ?>
        <p>Aucun hike trouvé.</p>
    <?php endif; ?>
</section>

