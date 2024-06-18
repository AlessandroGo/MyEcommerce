<?php
include_once 'dbcon.php';
session_start();
if (!isset($_SESSION['user_type']) || empty($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('location: index.php?error=Access Denied');
    exit;
}

/* Sanitize Post */
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (!isset($_GET['category']) || empty($_GET['categoryDelete'])) {
    $categoryDelete = "Afrikaans";
}
if (!isset($_GET['category']) || empty($_GET['categoryAdd'])) {
    $categoryRestore = "Afrikaans";
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['delete'])) {
    $categoryDelete = validate($_GET['category']);
    header("Location: adminpanel.php?categoryDelete={$categoryDelete}");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['restore'])) {
    $categoryRestore = validate($_GET['category']);
    header("Location: adminpanel.php?categoryRestore={$categoryRestore}");
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
            <h1>Welcome to the Admin Panel</h1>
            <p>Hello, <?php echo $_SESSION['username'] ?></p>
            <a href="logout.php">Log Out</a>
            <?php if (isset($_GET['message'])) { ?>
                <p><?php echo $_GET['message']  ?></p>
            <?php } ?>
            <a href="adminAddPage.php" class="btn btn-primary bg-dark">Add Item</a>
            <form method="GET">
                <label for="category">Search By Category:</label>
                <select name="category" id="category">
                    <option value="Afrikaans">Afrikaans</option>
                    <option value="English">English</option>
                    <option value="Zulu">Zulu</option>
                </select>
                <input type="submit" value="Category" name="delete">
            </form>
        </div>
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image Name</th>
                        <th>Description</th>
                        <th>Categories</th>
                        <th>Delete</th>
                        <th>Set Price</th>
                    </tr>
                    <tbody class="table-group-divider">
                        <?php
                        $stmt1 = $db->prepare("SELECT * FROM books WHERE categories = :category AND statusBook = 'Active'");
                        // If there is no category set in url then the category default is to display Afrikaans
                        $categoryDelete = (isset($_GET['categoryDelete'])) ? $_GET['categoryDelete'] : 'Afrikaans';
                        $stmt1->bindParam(':category', $categoryDelete, PDO::PARAM_STR);
                        $stmt1->execute();
                        $books = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($books as $book) {
                        ?>
                            <tr>
                                <td><?php echo $book['id'] ?></td>
                                <td><?php echo $book['name'] ?></td>
                                <td><?php echo $book['price'] ?></td>
                                <td><?php echo $book['image_path'] ?></td>
                                <td><?php echo $book['description'] ?></td>
                                <td><?php echo $book['categories'] ?></td>
                                <td>
                                    <form action="adminDelete.php" method="post">
                                        <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                        <button type="submit" name="delete" value="delete">Delete Product</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="adminSetPrice.php" method="post">
                                        <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                        <input type="hidden" name="category" value=<?= $categoryDelete ?>>
                                        <input type="text" name="price">
                                        <button type="submit" name="setPrice">Set Price</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <div class="container-fluid">
                <form method="GET">
                    <label for="category">Search By Category:</label>
                    <select name="category" id="category">
                        <option value="Afrikaans">Afrikaans</option>
                        <option value="English">English</option>
                        <option value="Zulu">Zulu</option>
                    </select>
                    <input type="submit" value="Category" name="restore">
                </form>
            </div>
            <div class="container-fluid">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image Name</th>
                            <th>Description</th>
                            <th>Categories</th>
                            <th>Restore</th>
                        </tr>
                        <tbody class="table-group-divider">
                            <?php
                            $stmt2 = $db->prepare("SELECT * FROM books WHERE categories = :category AND statusBook = 'Inactive'");
                            // Category Restore isn't present then default Afrikaans
                            $categoryRestore = (isset($_GET['categoryRestore'])) ? $_GET['categoryRestore'] : 'Afrikaans';
                            $stmt2->bindParam(':category', $categoryRestore, PDO::PARAM_STR);
                            $stmt2->execute();
                            $books = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($books as $book) {
                            ?>
                                <tr>
                                    <td><?php echo $book['id'] ?></td>
                                    <td><?php echo $book['name'] ?></td>
                                    <td><?php echo $book['price'] ?></td>
                                    <td><?php echo $book['image_path'] ?></td>
                                    <td><?php echo $book['description'] ?></td>
                                    <td><?php echo $book['categories'] ?></td>
                                    <td>
                                        <form action="adminRestore.php" method="post">
                                            <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                            <button type="submit" name="delete" value="add">Restore Product</button>
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