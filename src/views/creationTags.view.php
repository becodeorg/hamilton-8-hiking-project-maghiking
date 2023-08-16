<form action="#" method="post">
    <label for="name">Créer votre #Tag</label>
    <input type="text" name="name" id="nametag">
    <button type="submit">Valider</button>
</form>

<?php if (isset($error_value)):
    if ($error_value == "101"): ?>
        <p class="error">Veuillez remplir les champs ci-dessus avec votre informations.</p>
    <?php elseif ($error_value == "500"): ?>
        <p class="error">Il semblerait que l'on est rencontré une erreur. Veuillez essayer plus tard.</p>
        <?php else: echo $error_value; ?>
        <?php endif;
endif; ?>