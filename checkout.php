<?php
include_once 'dbcon.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['user_id'])) {
    // echo $_POST['user_id'];
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user_id = validate($_POST['user_id']);
    $email = validate($_POST['email']);
    $payment_type = validate($_POST['paymentType']);
    $address = validate($_POST['address']);
    // $sql = 'SELECT email FROM users WHERE id = :user_id LIMIT 1';
    // $stmt1 = $db->prepare($sql);
    // $stmt1->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    // $stmt1->execute();
    // $userEmail = $stmt1->fetch(PDO::FETCH_ASSOC);
    // echo $userEmail['email'];
    // header("location: cart.php");
    // exit;
    $sql = 'SELECT * FROM cart WHERE user_id = :user_id';
    $stmt1 = $db->prepare($sql);
    $stmt1->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    if ($stmt1->execute()) {
        $cartItems = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $grandTotal = 0;
        foreach ($cartItems as $cartItem) {
            $book_id = $cartItem['product_id'];
            $stmt2 = $db->prepare("SELECT price FROM books WHERE id = :id");
            $stmt2->bindParam(':id', $book_id, PDO::PARAM_INT);
            if ($stmt2->execute()) {
                $books = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                foreach ($books as $book) {
                    $subtotal = (int)$cartItem['quantity'] * $book['price'];
                    $grandTotal += $subtotal;
                }
            } else {
                header("location: cart.php?error=Error Occurred");
                exit;
            }
        }
        // echo $grandTotal;
        $payment_id = random_int(10000, 20000);
        // echo $payment_id;
        $sqlOrder = 'INSERT INTO order_details (user_id,total,payment_id) VALUES (:user_id,:total,:payment_id)';
        $stmtOrder = $db->prepare($sqlOrder);
        $stmtOrder->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtOrder->bindParam(':total', $grandTotal, PDO::PARAM_STR);
        $stmtOrder->bindParam(':payment_id', $payment_id, PDO::PARAM_INT);
        if ($stmtOrder->execute()) {
            //Get the order id auto incremented
            $sqlOrderId = 'SELECT * FROM order_details WHERE user_id = :user_id AND payment_id =:payment_id';
            $stmtOrderId = $db->prepare($sqlOrderId);
            $stmtOrderId->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmtOrderId->bindParam(':payment_id', $payment_id, PDO::PARAM_INT);
            $stmtOrderId->execute();
            $order = $stmtOrderId->fetch(PDO::FETCH_ASSOC);
            // Loop through cart items and insert into order_items table
            foreach ($cartItems as $cartItem) {
                $sqlInsertCartItem = 'INSERT INTO order_items (order_id,product_id,quantity) VALUES(:order_id,:product_id,:quantity)';
                $stmtInsertCartItem = $db->prepare($sqlInsertCartItem);
                $stmtInsertCartItem->bindParam(':order_id', $order['id'], PDO::PARAM_INT);
                $stmtInsertCartItem->bindParam(':product_id', $cartItem['product_id'], PDO::PARAM_INT);
                $stmtInsertCartItem->bindParam(':quantity', $cartItem['quantity'], PDO::PARAM_INT);
                $stmtInsertCartItem->execute();
            }
            $sqlClearCart = "DELETE FROM cart WHERE user_id = :user_id";
            $stmtClearCart = $db->prepare($sqlClearCart);
            $stmtClearCart->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmtClearCart->execute();
            header("location: cart.php?success=Payment Successful");
            exit;
        } else {
            header("location: cart.php?error=Error Occurred");
            exit;
        }
    } else {
        header("location: cart.php?error=Error Occurred");
        exit;
    }
}
