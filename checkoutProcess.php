<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['user_id'])) {
    // echo $_POST['user_id'];
    // echo $_POST['total'];
}

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
        <div class="d-flex justify-content-center">
            <form action="checkout.php" method="post">
                <div class="mb-3">
                    <label for="name">Email</label><br><br>
                    <input type="text" name="email" id="email" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="name">Payment Type</label><br><br>
                    <input type="text" name="paymentType" id="paymentType" placeholder="Payment Type">
                </div>
                <div class="mb-3">
                    <label for="name">Address For Delivery</label><br><br>
                    <input type="text" name="address" id="address" placeholder="Address">
                </div>
                <div class="mb-3">
                    <p>The total for your order is: <?php echo $_POST['total'] ?></p>
                </div>
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                <div class="row mb-2">
                    <button type="submit" class="btn btn-primary">Pay</button>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="cart.php">Cancel</a>
                </div>
            </form>
        </div>
    </main>


    <footer>
        <?php include_once('./template/navbot.php'); ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>