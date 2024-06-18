<?php
// session_start();
include_once 'dbcon.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['user_id'])) {
    $product_id = htmlspecialchars($_POST['product_id']);
    $user_id = htmlspecialchars($_POST['user_id']);
    $sqlProduct = 'SELECT * from cart WHERE product_id = :product_id and user_id = :user_id';
    $stmtProduct = $db->prepare($sqlProduct);
    $stmtProduct->bindParam(':product_id', $product_id);
    $stmtProduct->bindParam(':user_id', $user_id);
    $stmtProduct->execute();
    $countProduct = $stmtProduct->rowCount();
    if ($countProduct === 1) {
        $row = $stmtProduct->fetch(PDO::FETCH_ASSOC);
        $quantity = (int)$row['quantity'];
        $quantity += 1;
        $update = 'UPDATE cart SET quantity = :quantity WHERE product_id = :product_id and user_id = :user_id';
        $stmt = $db->prepare($update);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        echo "There are so many  rows with product id: " . $product_id . " rows " . $countProduct . " quantity product: " . $quantity . " for user with id: " . $user_id;
        header("location: cart.php");
        exit;
    } else {
        header("location: cart.php?error=Cart Item Not Found");
        exit;
    }
} else {
    echo "Not logged in";
    header("location: cart.php?error=Not Logged In");
    exit;
}
