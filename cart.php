<?php
include_once 'dbcon.php';
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = '';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include_once('./template/navtop.php'); ?>

    <main class="mb-auto mt-5 pt-3">
        <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
            <div class="container-fluid">
                <h1>Welcome to you cart <span id="username"><?php echo $_SESSION['username'] ?> </span></h1>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Subtract</th>
                            <th>Quantity</th>
                            <th>Add</th>
                            <th>Subtotal</th>
                        </tr>
                        <tbody class="table-group-divider">
                            <?php
                            $stmt = $db->prepare("SELECT product_id, quantity FROM cart WHERE user_id = :user_id");
                            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
                            $stmt->execute();
                            $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $grandTotal = 0;
                            foreach ($cartItems as $cartItem) {
                                $productID = $cartItem['product_id'];
                            ?>
                                <?php
                                $stmt1 = $db->prepare("SELECT id, name, price FROM books WHERE id = :id");
                                $stmt1->bindParam(':id', $productID, PDO::PARAM_INT);
                                $stmt1->execute();
                                $books = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($books as $book) {
                                    $subtotal = (int)$cartItem['quantity'] * $book['price'];
                                    $grandTotal += $subtotal;
                                ?>

                                    <tr>
                                        <td><?php echo $book['name'] ?></td>
                                        <td><?php echo $book['price'] ?></td>
                                        <td>
                                            <form action="cartProccessSubtract.php" method="post">
                                                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                                <input type="hidden" name="product_id" value="<?= $productID ?>">
                                                <button type="submit">-</button>
                                            </form>
                                        </td>
                                        <td><?php echo $cartItem['quantity'] ?></td>
                                        <td>
                                            <form action="cartProccessAdd.php" method="post">
                                                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                                <input type="hidden" name="product_id" value="<?= $productID ?>">
                                                <button type="submit">+</button>
                                            </form>
                                        </td>
                                        <td><?php echo (int)$cartItem['quantity'] * $book['price'] ?></td>
                                    </tr>

                                <?php } ?>
                            <?php } ?>
                            <tr>
                                <td colspan="6">Grand Total is: <?php echo number_format($grandTotal, 2) ?></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <?php if ($stmt->rowCount() > 0) { ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <form action="cartProcessClear.php" method="post">
                                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                    <button class="btn btn-secondary" type="submit">Clear Cart</button>
                                </form>
                            </div>
                            <div class="col">
                                <form action="checkoutProcess.php" method="post">
                                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                    <input type="hidden" name="total" value="<?= $grandTotal ?>">
                                    <button class="btn btn-secondary" type="submit">Checkout</button>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        <?php }  ?>
    <?php } else { ?>
        <div class="container-fluid">
            <p id="username"><?php echo $_SESSION['username'] ?></p>
            <div class="row">

                <div class="buyItems">
                    <div class="container-fluid">
                        <div class="row" id="cartItem">

                        </div>
                    </div>


                </div>


            </div>

            <div class="sumPrice">
                <span id="sumPrice"></span>
            </div>
            <a href="login.php">Do you want to Login to Purchase Items?</a>
        </div>

    <?php } ?>
    </main>
    <?php include_once('./template/navbot.php'); ?>
    <script src="./scripts/displayToCart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>