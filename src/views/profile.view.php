<?php extract($user); ?>
<section>
    <?php if ($_SESSION['hiking_user']['uid'] == $uid): ?>
        <h2>Ton profile</h2>
    <?php else: ?>
        <h2>Profile de <?= $nickname ?></h2>
    <?php endif; ?>
    <ul>
        <li>Nom: <?= $firstname . " " . $lastname ?></li>
        <li>Pseudo: <?= $nickname ?></li>
        <li>Email: <?= $email ?></li>
    </ul>
    <?php if (!isset($_GET['uid']) || $_SESSION['hiking_user']['uid'] == $_GET['uid']): ?>
        <a href="/modify?value=account" role="button">Modifier mes informations</a>
    <?php endif; ?>
</section>
<section class="cards-wrapper">
    <?php if ($_SESSION['hiking_user']['uid'] == $uid): ?>
        <h2>Tes Hikes</h2>
    <?php else: ?>
        <h2>Hikes de <?= $nickname ?></h2>
    <?php endif; ?>
    <ul>
        <?php if (!empty($hikes)):
            foreach ($hikes as $hike):
                extract($hike); ?>
                <li class="card">
                    <img src="<?= $image_url ?>" alt="photo-rando">
                    <div>
                        <h4><a href="/hike?hid=<?= $hid ?>"><?= $name ?></a></h4>
                        <p><?= $distance ?> km</p>
                        <p><?= $duration ?> <i class="fa-solid fa-clock"></i></p>
                        <a href="/profile?uid=<?= $uid ?>"><i class="fa-solid fa-user"></i> <?= $nickname ?></a>
                    </div>
                    <?php if ($_SESSION['hiking_user']['uid'] == $uid || $_SESSION['hiking_user']['uid'] == '1'): ?>
                        <div class="float">
                            <a href="/modify?value=hike&hid=<?= $hid ?>"><i class="fa-solid fa-pencil"></i></a>
                            <a href="/delete-hike?hid=<?= $hid ?>" onclick="return confirm('Etes-vous sûr de supprimer cette randonnée ?')"><i class="fa-regular fa-trash-can"></i></a>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach;
            else: ?>
            <a href="/creation">Tu n'as créé aucun hike.</a>
        <?php endif; ?>
    </ul>
</section>
