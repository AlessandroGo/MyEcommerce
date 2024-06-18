<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./css/mystyle.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <header>
    <?php include_once('./template/navtop.php'); ?>
  </header>

  <main class="mb-auto mt-5 pt-3">
    <div class="container-fluid" id="heroImage">
      <img src="./images/heroImage.jpg" class="img-fluid" alt="...">
    </div>
    <div class="d-flex flex-column">
      <div class="d-flex justify-content-center">
        <h1>Welcome to Phambili Agencies</h1>
      </div>
      <div class="d-flex justify-content-center">
        <p>We are a book distributor</p>
      </div>
      <div class="d-flex justify-content-center">
        <h2>Checkout our Catalogues page to see the available catalogues</h2>
      </div>
    </div>
    <div class="container-fluid" id="popularProducts">
      <div class="d-flex justify-content-center">
        <h3>Look at our popular books</h3>
      </div>
      <div class="row">
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="./images/book1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Book Name</h5>
              <p class="card-text">Description</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="./images/book1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Book Name</h5>
              <p class="card-text">Description</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="./images/book1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Book Name</h5>
              <p class="card-text">Description</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="./images/book1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Book Name</h5>
              <p class="card-text">Description</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid" id="popularPlushies">
      <div class="d-flex justify-content-center">
        <h3>Look at our popular plushies</h3>
      </div>
      <div class="row">
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="./images/corgi.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Plushy Name</h5>
              <p class="card-text">Description</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="./images/corgi.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Plushy Name</h5>
              <p class="card-text">Description</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="./images/corgi.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Plushy Name</h5>
              <p class="card-text">Description</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="./images/corgi.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Plushy Name</h5>
              <p class="card-text">Description</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>


  <footer>
    <?php include_once('./template/navbot.php'); ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>