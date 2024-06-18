<?php
include_once 'dbcon.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['user_id'])) {
    $user_id = htmlspecialchars($_POST['user_id']);
    $sql = "DELETE FROM cart WHERE user_id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    header('location: cart.php');
    exit;
} else {
    header('location: cart.php?error=Not Signed In');
    exit;
}
