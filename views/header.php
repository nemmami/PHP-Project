<!DOCTYPE HTML>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo VIEWS_PATH ?>css/base.css" media="screen">
</head>
<body>
<div class="contenue">
    <header>
        <title>Big Spicy</title>
        <br>
        <?php if (!empty($_SESSION['authentifie'])) { ?>
            <a href="index.php?action=default">
                <img src="<?php echo VIEWS_PATH ?>images/logo-removebg-preview.png" alt="logo" class="logo">
            </a>
            <strong class="slogan">High in spices but small in price</strong>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=default">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=exploration">Exploration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <br>
            <hr>
        <?php } else { ?>
            <img src="<?php echo VIEWS_PATH ?>images/logo-removebg-preview.png" alt="logo" class="logo">
            <strong class="slogan">High in spices but small in price</strong>
            <br>
            <hr>
        <?php } ?>
    </header>
