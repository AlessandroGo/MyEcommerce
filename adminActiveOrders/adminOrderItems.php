<?php
include_once '../dbcon.php';
session_start();
if (!isset($_SESSION['user_type']) || empty($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('location: index.php?error=Access Denied');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['viewItemsAdmin'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $order_id = validate($_POST['order_id']);
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
        <?php include_once('../template/navtopAdmin.php'); ?>
    </header>

    <main class="mb-auto mt-5 pt-3">
        <div class="container-fluid">
            <h1>Items for Order <?php echo $order_id ?></h1>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <tr>
                    <th>id</th>
                    <th>order_id</th>
                    <th>product_id</th>
                    <th>quantity</th>
                </tr>
                <tbody class="table-group-divider">
                    <?php
                    $stmt1 = $db->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
                    $stmt1->bindParam(':order_id', $order_id, PDO::PARAM_STR);
                    $stmt1->execute();
                    $orderItems = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($orderItems as $orderItem) {
                    ?>
                        <tr>
                            <td><?php echo $orderItem['id'] ?></td>
                            <td><?php echo $orderItem['order_id'] ?></td>
                            <td><?php echo $orderItem['product_id'] ?></td>
                            <td><?php echo $orderItem['quantity'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="container-fluid">
            <a href="../adminOrdersActive.php">Back to Active Orders</a><br>
            <a href="../adminOrdersHistory.php">Back to Order History</a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>