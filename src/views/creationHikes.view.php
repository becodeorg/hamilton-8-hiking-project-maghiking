<h1>Créer votre hike</h1>
<form action="#" method="post">
    <fieldset>
        <label for="name">Titre de votre hike</label>
        <input type="text" name="name" id="name" placeholer="Titre..." placeholder="Nom..." required>
    </fieldset>
    <fieldset>
        <label for="distance">Distance kilométrique</label>
        <input type="number" step="0.1" min="0" name="distance" id="distance" placeholder="200..." required>
    </fieldset>
    <fieldset>
        <label for="duration">Durée</label>
        <input type="time" name="duration" id="duration" required>
    </fieldset>
    <fieldset>
        <label for="denivele">Dénivelé positif</label>
        <input type="number" step="0.1" min="0" name="elevation_gain" id="elevation_gain" placeholder="200..." required>
        <span>Mètres</span>
    </fieldset>
    <fieldset>
        <label for="description">Description</label>
        <textarea cols="20" rows="20" name="description" id="description" placeholder="Description..." required></textarea>
    </fieldset>
    <?php
    $i = 0;
    foreach ($tags as $tag): extract($tag); ?>
        <fieldset>
            <label for="tag"><?= $name ?></label>
            <input type="checkbox" name="tag[<?= $tid ?>]" id="tag">
        </fieldset>
    <?php $i++;
        endforeach; ?>
    <button type="submit">Créer votre Hike</button>
</form>
<?php if (isset($error_value)):
    if ($error_value == "101"): ?>
        <p class="error">Veuillez remplir les champs ci-dessus avec votre informations.</p>
    <?php elseif ($error_value == "500"): ?>
        <p class="error">Il semblerait que l'on est rencontré une erreur. Veuillez essayer plus tard.</p>
        <?php else: echo $error_value; ?>
        <?php endif;
endif; ?>