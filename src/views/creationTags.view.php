<form action="#" method="POST">
    <label for="name">Tag :</label>
    <input type="text" id="tag_name" name="name" required>
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