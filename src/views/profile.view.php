<section>
    <h2>Ton profile</h2>
    <ul>
        <li></li>
    </ul>
</section>
<?php if (isset($modify) && $modify): ?>
    <section>
        <h2>Modification</h2>
        <form action="#" method="post">
            <fieldset>
                <input type="text" name="firstname" id="firstname" value="<?= $_SESSION['hiking_user']['firstname'] ?>" placeholder="Modifie ton prénom" required>
                <label for="firstname">Prénom</label>
            </fieldset>
            <fieldset>
                <input type="text" name="lastname" id="lastname" value="<?= $_SESSION['hiking_user']['lastname'] ?>" placeholder="Modifie ton nom" required>
                <label for="lastname">Nom</label>
            </fieldset>
            <fieldset>
                <input type="text" name="nickname" id="nickname" value="<?= $_SESSION['hiking_user']['nickname'] ?>" placeholder="Modifie ton surnom" required>
                <label for="nickname">Surnom</label>
            </fieldset>
            <fieldset>
                <input type="password" name="password" id="password" placeholder="Confirme les modifications" required>
                <label for="password">Confirme avec ton mot de passe</label>
            </fieldset>
            <button type="submit">Modifier</button>
        </form>
    </section>
<?php else: ?>
    <section>
        <a href="#?modify=true" role="button">Modifier mes informations</a>
    </section>
<?php endif; ?>