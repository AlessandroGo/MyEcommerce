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
    <link rel="stylesheet" href="./css/mystyle.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include_once('./template/navtop.php'); ?>
    </header>

    <main class="mb-auto mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <h1>Contact Page</h1>
                </div>
                <div class="d-flex justify-content-center pb-4">
                    <h2>Contact us for respective queries</h2>
                </div>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center pb-4">
                <h3>Supplier</h3>
                <p>phambili.supplier.queries@gmail.com</p>
                <h3>Publisher</h3>
                <p>phambili.supplier.publisher@gmail.com</p>
                <h3>Interested Party</h3>
                <p>phambili.supplier.other@gmail.com</p>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center pb-5">
                <h4><i class="fa fa-phone-square" aria-hidden="true"></i>Landline</h4>
                <h5>+27 11 4550091</h5>
                <h4>Fax</h4>
                <h5>086 725 7062</h5>
                <h1><i class="fa fa-calendar" aria-hidden="true"></i>Business hours: Monday - Friday 8am to 4pm - UTC +02:00</h1>
            </div>
        </div>
    </main>


    <?php include_once('./template/navbot.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>