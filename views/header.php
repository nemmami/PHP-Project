<!DOCTYPE HTML>
<html lang="fr">
	<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo VIEWS_PATH ?>css/base.css" media="screen">

    </head>
	<body>
        <header>
            <title>Big Spicy</title>
            <br>
            <?php  if(isset($_SESSION['authentifie']) ){?>
                <a href="index.php?action=default">
                    <img  src="<?php echo VIEWS_PATH ?>images/logo-removebg-preview.png" alt="logo" class="logo">
                </a>
            <?php} else {  ?>
            <?php } ?>
            <?php  if(!isset($_SESSION['authentifie']) ){?>
                <img  src="<?php echo VIEWS_PATH ?>images/logo-removebg-preview.png" alt="logo" class="logo">
            <?php} else {  ?>
            <?php } ?>
            <strong class="slogan">High in spices but small in price</strong>
            <br>
            <hr>

        </header>
