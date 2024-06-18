<?php
include_once '../dbcon.php';
session_start();
if (!isset($_SESSION['user_type']) || empty($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('location: ../index.php?error=Access Denied');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancelOrder'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $order_id = validate($_POST['order_id']);

    $sql = "UPDATE order_details SET order_status = 'Cancelled' WHERE id = :order_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_STR);
    if ($stmt->execute()) {
        header("location: ../adminOrdersActive.php?cancel=Success");
        exit;
    } else {
        header("location: ../adminOrdersActive.php?message=Stmt Not Executed");
        exit;
    }
} else {
    header("location: ../adminOrdersActive.php?message=Error Occurred");
    exit;
}
