<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/513e9627f7.js" crossorigin="anonymous"></script>
    <title>MagHiking - hiking project</title>
</head>
<body>
<header>
    <h1><a href="/"><img src="assets/images/logo.svg" alt="Logo"></a></h1>
    <nav class="add">
    <?php if (isset($_SESSION['hiking_user'])): ?>
        <a href="/creation">Ajouter un Hike</a>
        <a href="/creationtag">Créer un Tag</a>
    <?php endif; ?>
    </nav>
    <ul>
        <?php if (!isset($_SESSION['hiking_user'])): ?>

            <li><a href="/login"><i class="fa-solid fa-user"></i></a></li>
            <li><a href="/register"><i class="fa-solid fa-user-plus"></i></a></li>
        <?php else: ?>
            <li><a href="/profile">Bonjour <?= $_SESSION['hiking_user']['nickname'] ?> !</a></li>
            <li><a href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        <?php endif; ?>
    </ul>
</header>
<main>