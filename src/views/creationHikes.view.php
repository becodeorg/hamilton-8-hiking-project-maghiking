<h1>Créer votre hike</h1>
<form action="#" method="post">
    <fieldset>
        <label for="name">Titre de votre hike</label>
        <input type="text" name="name" id="name" placeholer="Titre" required>
    </fieldset>
    <fieldset>
        <label for="distance">Distance kilométrique</label>
        <input type="number" step="0.1" name="distance" id="distance" placeholder="200" required>
        <span>km</span>
    </fieldset>
    <fieldset>
        <label for="duree">Durée</label>
        <input type="time" name="duree" id="duree" required>
    </fieldset>
    <fieldset>
        <label for="denivele">Dénivelé positif</label>
        <input type="number" step="0.1" name="denivele" id="denivele" placeholder="200" required>
        <span>Mètres</span>
    </fieldset>
    <fieldset>
        <label for="description">Description</label>
        <textarea cols="20" rows="20" name="description" id="description" placeholder="Description de votre Hike" required></textarea>

    </fieldset>
    <button type="submit">Créer votre Hike</button>
</form>