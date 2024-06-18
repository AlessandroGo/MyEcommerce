<?php
// session_start();
include_once 'dbcon.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['book_id'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $book_id = validate($_POST['book_id']);
    // echo $book_id;
    $sql = "UPDATE books SET statusBook = 'Active' WHERE id = :book_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':book_id', $book_id, PDO::PARAM_STR);
    if ($stmt->execute()) {
        header("location: adminPanel.php?message=Success");
        exit;
    } else {
        header("location: adminPanel.php?message=Stmt Not Executed");
        exit;
    }
} else {
    $book_id = $_POST['book_id'];
    // echo var_dump($book_id);
    header("location: adminPanel.php?message=Error Occurred");
    exit;
}
