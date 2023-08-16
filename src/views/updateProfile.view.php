<h1>Modifier mes données</h1>
<form action="/modify?value=account" method="post">
    <fieldset>
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" value="<?= $_SESSION['hiking_user']['firstname'] ?>" placeholder="Prénom..." required>
    </fieldset>
    <fieldset>
        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname" value="<?= $_SESSION['hiking_user']['lastname'] ?>" placeholder="Nom..." required>
    </fieldset>
    <fieldset>
        <label for="password">Confirmer les modifications</label>
        <input type="password" name="password" id="password" placeholder="Confirmer les modifications avec votre mot de passe" required>
    </fieldset>
    <button type="submit">Modifier</button>
</form>
<?php if (isset($error_value)):
    if ($error_value == "101"): ?>
        <p class="error">Veuillez remplir les champs ci-dessus avec votre informations.</p>
    <?php elseif ($error_value == "202"): ?>
        <p class="error">Ce mot de passe n'est pas valide.</p>
    <?php elseif ($error_value == "500"): ?>
        <p class="error">Il semblerait que l'on est rencontré une erreur. Veuillez essayer plus tard.</p>
    <?php elseif ($error_value == "301"): ?>
        <p class="warning">Aucune modification n'a été détecté.</p>
    <?php endif; ?>
<?php endif; ?>
<?php if (isset($modify)): ?>
    <?php if ($modify == "true"): ?>
        <p class="success">Vos informations on bien été modifié.</p>
    <?php endif; ?>
<?php endif; ?>
