<section class="background_fixed"></section>
<section class="empty">
    <h1>Bienvenue sur highKing.</h1>
    <h4>Le hike fait pour vous!</h4>
    <p>Grâce highKing, le partage des meilleurs hikes aux alentoures n'a jamais été aussi simple.</p>
</section>
<section class="cards-wrapper">
    <h1>Hikes</h1>
    <ul>
    <?php if (!empty($hikes)):
        foreach ($hikes as $hike):
            extract($hike); ?>
            <li class="card">
                <img src="<?= $image_url ?>" alt="photo-rando">
                <div>
                    <h4><a href="/hike?hid=<?= $hid ?>"><?= $name ?></a></h4>
                    <p class="hoverOpacityCard"><?= $distance ?> km</p>
                    <p class="hoverOpacityCard"><?= $duration ?> <i class="fa-solid fa-clock"></i></p>
                    <a href="/profile?uid=<?= $uid ?>" class="hoverOpacityCard"><i class="fa-solid fa-user"></i> <?= $nickname ?></a>
                </div>
            </li>
        <?php endforeach;
    else: ?>
        <p>Aucun hike trouvé.</p>
    <?php endif; ?>
    </ul>
</section>