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
</section>
<section>
    <?php if ($_SESSION['hiking_user']['uid'] == $uid): ?>
        <h2>Tes Hikes</h2>
    <?php else: ?>
        <h2>Hikes de <?= $nickname ?></h2>
    <?php endif; ?>
    <ul>
        <?php if (!empty($hikes)):
            foreach ($hikes as $hike):
                extract($hike); ?>
                <li>
                    <?php if ($_SESSION['hiking_user']['uid'] == $uid): ?>
                        <a href="/hike?hid=<?= $hid ?>"><?= $name ?></a>
                        <a href="/modify?value=hike&hid=<?= $hid ?>"><i class="fa-solid fa-pencil"></i></a>
                        <a href="/delete-hike?hid=<?= $hid ?>" onclick="return confirm('Etes-vous sûr de supprimer cette randonnée ?')"><i class="fa-regular fa-trash-can"></i></a>
                    <?php else: ?>
                        <a href="/hike?hid=<?= $hid ?>"><?= $name ?></a>
                    <?php endif; ?>
                </li>
            <?php endforeach;
            else: ?>
            <li>Tu n'as créé aucun hike.</li>
        <?php endif; ?>
    </ul>
</section>
<a href="/modify?value=account" role="button">Modifier mes informations</a>
