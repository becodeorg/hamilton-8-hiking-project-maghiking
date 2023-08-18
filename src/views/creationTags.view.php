<h2>Créer un tag</h2>
<form action="#" method="POST">
    <fieldset>
        <label for="name">Tag</label>
        <input type="text" id="tag_name" name="name" required>
    </fieldset>
    <button type="submit">Valider</button>
</form>
<?php if (isset($error_value)):
    if ($error_value == "101"): ?>
        <p class="message error">Veuillez remplir les champs ci-dessus avec votre informations.</p>
    <?php elseif ($error_value == "500"): ?>
        <p class="message error">Il semblerait que l'on est rencontré une erreur. Veuillez essayer plus tard.</p>
        <?php else: echo $error_value; ?>
        <?php endif;
endif; ?>