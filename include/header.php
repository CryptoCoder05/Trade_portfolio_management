<?php
// require function file...
require 'functions.php';
// require helper file...
require 'helper.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Anirudh singh">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trade Portfolio Management</title>

    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!--Owl carousel-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!--Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/594354d0d4.js" crossorigin="anonymous"></script>

    <!--sass stylesheet-->
    <link rel="stylesheet" href="style.css">

    <!--slick slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!--Custom stylesheet-->
    <link rel="stylesheet" href="./css/style.css">

    <!--custom style for trade portfolio Management-->
    <link rel="stylesheet" href="./css/mystyle.css">

    <!--jQuery lib-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!--sweetalert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--google chart-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  

  </head>
  <body>
    <!-- header -->
    <header>
      <div class="container-fluid p-0">
      <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
        <a href="index.php" class="navbar-brand">Trade portfolio Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav m-auto font-rubik">
            <li class="nav-item active">
              <a class="nav-link" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_coin.php">Add Coin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="portfolio.php">My Portfolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Buy/Sell</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="exchange.php">Add Exchange</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    </header>
   <!-- !header -->

   <!-- start main site -->
   <main id="main-site">
