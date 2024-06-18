<?php
include_once 'dbcon.php';
session_start();
/* if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
  $_SESSION['user_id'] = '';
  // echo "hello";
} */
if (!isset($_POST['category']) || empty($_POST['category'])) {
  $category = "Afrikaans";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  function validate($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $category = validate($_POST['category']);
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="./css/mystyle.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php include_once('./template/navtop.php'); ?>
  <main class="mb-auto mt-5 pb-2 pt-3">
    <div class="container-fluid">
      <div class="row mb-4">
        <form method="POST">
          <label for="category">Search By Category:</label>
          <select name="category" id="category">
            <option value="Afrikaans">Afrikaans</option>
            <option value="English">English</option>
            <option value="Zulu">Zulu</option>
          </select>
          <button type="submit">Search Category</button>
        </form>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 gy-2">

        <?php
        $stmt = $db->prepare("SELECT * FROM books WHERE categories = :category and statusBook = 'Active'");
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($books as $book) {
        ?>
          <div class="col">
            <div class="card">
              <div class="d-flex justify-content-center">
                <form method="post" action="proccessCart.php" class="product">
                  <div class="d-flex justify-content-center">
                    <img style="width:200px; height: 200px;" src="./images/<?= $book['image_path'] ?>" alt="No Image Found">
                  </div>
                  <input type="hidden" name="product_id" value="<?= $book['id'] ?>">
                  <input type="hidden" name="quantity" value="1">
                  <div class="name" id="name1"><?php echo $book['name']; ?></div>
                  <div class="price">
                    R<span class="priceValue"><?php echo $book['price']; ?></span>
                  </div>
                  <div class="description"><?php echo $book['description']; ?></div>
                  <div class="d-flex justify-content-center">
                    <input type='submit' title="ADD to cart" class="addToCart" data-product-id="<?= $book['id'] ?>" />
                  </div>
                  <div class="messageAdd" id="messageID<?= $book['id'] ?>">Added To Cart</div>
                </form>
              </div>
            </div>
          </div>

        <?php
        }
        ?>

      </div>
    </div>
  </main>
  <?php include_once('./template/navbot.php'); ?>


  <!-- <script src="./scripts/cart.js"></script> -->
  <script src="./scripts/addToCart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>