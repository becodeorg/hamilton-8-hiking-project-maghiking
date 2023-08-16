<form action="#" method="post">
    <fieldset>
        <input type="text" name="firstname" id="firstname" placeholder="John" required>
        <label for="firstname">Prénom</label>
    </fieldset>
    <fieldset>
        <input type="text" name="lastname" id="lastname" placeholder="Smith" required>
        <label for="lastname">Nom</label>
    </fieldset>
    <fieldset>
        <input type="text" name="nickname" id="nickname" placeholder="jSmith03" required>
        <label for="nickname">Surnom</label>
    </fieldset>
    <fieldset>
        <input type="email" name="email" id="email" placeholder="j.smith@gmail.com" required>
        <label for="email">Email</label>
    </fieldset>
    <fieldset>
        <input type="password" name="password" id="password" placeholder="Pas de <1234>!" required>
        <label for="password">Mot de passe</label>
    </fieldset>
    <button type="submit">M'inscrire</button>
</form>
<?php if (isset($error_value)):
    if ($error_value == "101"): ?>
        <p class="error">Veuillez remplir les champs ci-dessus avec votre informations.</p>
    <?php elseif ($error_value == "102"): ?>
        <p class="error">Il semblerait qu'un utilisateur utilisé déjà ce surnom ou cette email.</p>
    <?php elseif ($error_value == "201"): ?>
        <p class="error">Cette email n'est pas valide.</p>
    <?php elseif ($error_value == "500"): ?>
        <p class="error">Il semblerait que l'on est rencontré une erreur. Veuillez essayer plus tard.</p>
        <?php endif;
endif; ?>