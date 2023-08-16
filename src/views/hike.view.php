<?php foreach ($hikeDetails as $detail): 
extract($detail); ?>

<h1><?= $name ?></h1>
<p> <?= $description ?></p>
<?php endforeach; ?>