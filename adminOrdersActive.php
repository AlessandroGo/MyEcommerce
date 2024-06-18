<?php
include_once 'dbcon.php';
session_start();
if (!isset($_SESSION['user_type']) || empty($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('location: home.php?error=Access Denied');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include_once('./template/navtopAdmin.php'); ?>
    </header>

    <main class="mb-auto mt-5 pt-3">
        <div class="container-fluid">
            <h1>Active Orders Page</h1>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <tr>
                    <th>id</th>
                    <th>user_id</th>
                    <th>total</th>
                    <th>payment_id</th>
                    <th>order_status</th>
                    <th>View Order Items</th>
                    <th>Set Order Completed</th>
                    <th>Set Order Cancelled</th>
                </tr>
                <tbody class="table-group-divider">
                    <?php
                    $stmt1 = $db->prepare("SELECT * FROM order_details WHERE order_status='Active'");
                    $stmt1->execute();
                    $orders = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($orders as $order) {
                    ?>
                        <tr>
                            <td><?php echo $order['id'] ?></td>
                            <td><?php echo $order['user_id'] ?></td>
                            <td><?php echo $order['total'] ?></td>
                            <td><?php echo $order['payment_id'] ?></td>
                            <td><?php echo $order['order_status'] ?></td>
                            <td>
                                <form action="./adminActiveOrders/adminOrderItems.php" method="post">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <input type="submit" name="viewItemsAdmin" value="View Items">
                                </form>
                            </td>
                            <td>
                                <form action="./adminActiveOrders/adminCompleteOrder.php" method="post">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <input type="submit" name="completeOrder" value="Complete Order">
                                </form>
                            </td>
                            <td>
                                <form action="./adminActiveOrders/adminCancelOrder.php" method="post">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <input type="submit" name="cancelOrder" value="Cancel Order">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>