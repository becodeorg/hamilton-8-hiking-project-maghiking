<section>
    <h2>Ton profil</h2>
    <ul>
        <li>Nom: <?= $_SESSION['hiking_user']['firstname'] . " " . $_SESSION['hiking_user']['lastname'] ?></li>
        <li>Pseudo: <?= $_SESSION['hiking_user']['nickname'] ?></li>
        <li>Email: <?= $_SESSION['hiking_user']['email'] ?></li>
    </ul>
</section>
<section>
    <h2>Tes Hikes</h2>
    <ul>
        <?php if (!empty($hikes)):
            foreach ($hikes as $hike):
                extract($hike); ?>
                <li>
                    <a href="/hike?hid=<?= $hid ?>"><?= $name ?></a>
                    /* Ajout d'une alerte */
                    <a href="/delete-hike?hid=<?= $hid ?>" onclick="return confirm('Es-tu sûr de vouloir supprimer cette randonnée ?')"><i class="fa-regular fa-trash-can"></i></a>

                </li>
            <?php endforeach;
            else: ?>
            <li>Tu n'as créé aucun hike.</li>
        <?php endif; ?>
    </ul>
</section>
<a href="/modify?value=account" role="button">Modifier mes informations</a>
