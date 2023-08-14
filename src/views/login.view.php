<h1>Connexion</h1>
<form action="#" method="post">
    <fieldset>
        <input type="email" name="email" id="email" placeholder="Entrez votre email" required>
        <label for="email">Email</label>
    </fieldset>
    <fieldset>
        <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>
        <label for="password">Mot de passe</label>
    </fieldset>
    <button type="submit">Connexion</button>
</form>

<?php if (isset($error_value)):
    if ($error_value == "101"): ?>
        <p class="error">Veuillez remplir les champs ci-dessus avec votre informations.</p>
    <?php elseif ($error_value == "201"): ?>
        <p class="error">Cette email n'est pas valide.</p>
    <?php elseif ($error_value == "202"): ?>
        <p class="error">Ce mot de passe n'est pas valide.</p>
    <?php elseif ($error_value == "500"): ?>
        <p class="error">Il semblerait que l'on est rencontré une erreur. Veuillez essayer plus tard.</p>
    <?php endif;
endif; ?>
