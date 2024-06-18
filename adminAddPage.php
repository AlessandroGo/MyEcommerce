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
        <div class="d-flex justify-content-center align-items-center">
            <form action="adminAdd.php" method="post" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <label for="book_name">Name of Book: </label>
                    <input type="text" class="form-control" id="book_name" placeholder="Name of Book" name="book_name">
                </div>
                <div class="mb-3 mt-3">
                    <label for="price">Price of Book: </label>
                    <input type="text" class="form-control" id="price" placeholder="Price of Book" name="price">
                </div>
                <div class="mb-3 mt-3">
                    <label for="description">Description of Book: </label>
                    <input type="text" class="form-control" id="description" placeholder="Description of Book" name="description">
                </div>
                <div class="mb-3 mt-3">
                    <label for="description">Category of Book: </label>
                    <input type="text" class="form-control" id="category" placeholder="Category of Book" name="category">
                </div>
                <div class="mb-3 mt-3">
                    <label for="file">Image of Book: </label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>