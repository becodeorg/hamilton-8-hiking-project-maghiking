<?php foreach ($hikeDetails as $detail):
    extract($detail); ?>
    <h1>Créer votre hike</h1>
    <form action="#" method="post">
        <fieldset>
            <label for="name">Titre de votre hike</label>
            <input type="text" name="name" id="name" value="<?= $name ?>" placeholder="Nom..." required>
        </fieldset>
        <fieldset>
            <label for="distance">Distance kilométrique</label>
            <input type="number" step="0.01" min="0" name="distance" id="distance" value="<?= $distance ?>" placeholder="200..." required>
            <span>km</span>
        </fieldset>
        <fieldset>
            <label for="duration">Durée</label>
            <input type="time" name="duration" id="duration" value="<?= $duration ?>" required>
        </fieldset>
        <fieldset>
            <label for="denivele">Dénivelé positif</label>
            <input type="number" step="0.01" min="0" name="elevation_gain" id="elevation_gain" value="<?= $elevation_gain ?>" placeholder="200..." required>
            <span>Mètres</span>
        </fieldset>
        <fieldset>
            <label for="description">Description</label>
            <textarea cols="20" rows="20" name="description" id="description" placeholder="Description..." required><?= $description ?></textarea>
        </fieldset>
        <?php
        $i = 0;
        foreach ($tags_delete as $tag): extract($tag); ?>
            <fieldset>
                <label for="tag"><?= $name ?></label>
                <input type="checkbox" name="tag_delete[<?= $tid ?>]" id="tag" checked>
            </fieldset>
            <?php $i++;
        endforeach; ?>
        <?php foreach ($tags_add as $tag): extract($tag); ?>
            <fieldset >
                <label for="tag"><?= $name ?></label>
                <input type="checkbox" name="tag_add[<?= $tid ?>]" id="tag">
            </fieldset>
        <?php endforeach; ?>
        <button type="submit">Modifier votre Hike</button>
    </form>
    <?php if (isset($error_value)):
        if ($error_value == "101"): ?>
            <p class="message error">Veuillez remplir les champs ci-dessus avec votre informations.</p>
        <?php elseif ($error_value == "401"): ?>
            <p class="message warning">Aucune modification n'a été détecté.</p>
        <?php elseif ($error_value == "500"): ?>
            <p class="message error">Il semblerait que l'on est rencontré une erreur. Veuillez essayer plus tard.</p>
        <?php else: echo $error_value; ?>
        <?php endif;
    endif; ?>
    <a href="/delete-hike?hid=<?= $hid ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer cette randonnée ?')">Supprimer le hike</a>
<?php endforeach; ?>
