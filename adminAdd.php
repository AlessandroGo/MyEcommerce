<?php
// session_start();
include_once 'dbcon.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $name = validate($_POST['book_name']);
    $price = validate($_POST['price']);
    $description = validate($_POST['description']);
    $categories = validate($_POST['category']);
    $file = $_FILES['file'];
    // print_r($file);
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                // This just makes sure that if a user uploads a file, that it does not overwrite an existing file if the files have the same name
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'images/' . $fileNameNew;
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $sql = "INSERT INTO books (name,price,image_path,description,categories) VALUES (:name,:price,:image_path,:description,:categories)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':categories', $categories);
                    $stmt->bindParam(':image_path', $fileNameNew);
                    $stmt->execute();
                    header('location: adminAddPage.php?success=File Uploaded');
                    exit;
                } else {
                    header('location: adminAddPage.php?error=File Could Not be Uploaded');
                    exit;
                }
            } else {
                header('location: adminAddPage.php?error=Upload too Big');
                exit;
            }
        } else {
            header('location: adminAddPage.php?error=Upload Failed');
            exit;
        }
    } else {
        header('location: adminAddPage.php?Error=Not Valid File');
        exit;
    }
    // echo $fileName;

}
