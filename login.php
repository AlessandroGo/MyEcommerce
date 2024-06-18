<?php
require_once './dbcon.php';
$name = $email = $password = '';
$name_err = $email_err = $password_err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /* Sanitize Post */
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    /* Post data Goes into Regular php variables */
    $name =  validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    // Validate email
    if (empty($email)) {
        $email_err = 'Please enter email';
    }

    // Validate password
    if (empty($password)) {
        $password_err = 'Please enter password';
    }

    // Make sure errors are empty
    if (empty($email_err) && empty($password_err)) {
        // Prepare query
        $sql = 'SELECT name, email, password, user_type, id FROM users WHERE email = :email';

        // Prepare statement
        if ($stmt = $db->prepare($sql)) {
            // Bind params
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Attempt execute
            if ($stmt->execute()) {
                // Check if email exists
                if ($stmt->rowCount() === 1) {
                    if ($row = $stmt->fetch()) {
                        $hashed_password = $row['password'];
                        if (password_verify($password, $hashed_password)) {
                            // SUCCESSFUL LOGIN
                            session_start();
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['username'] = $row['name'];
                            $_SESSION['user_type'] = $row['user_type'];
                            $_SESSION['user_id'] = $row['id'];
                            if ($_SESSION['user_type'] == 'user') {
                                header('location: index.php');
                            } else if ($_SESSION['user_type'] == 'admin') {
                                header('location: adminpanel.php');
                            }
                        } else {
                            // Display wrong password message
                            $password_err = 'The password you entered is not valid';
                        }
                    }
                } else {
                    $email_err = 'No account found for that email';
                    $name_err = 'Make sure username account is for correct email';
                }
            } else {
                die('Something went wrong');
            }
            // Close statement
            unset($stmt);
        }

        // Close connection
        unset($db);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/mystyle.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include_once('./template/navtop.php'); ?>
    <main class="mb-auto mt-5 pt-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <form method="POST" id="loginForm">
                    <fieldset id="loginFieldset">
                        <legend>Login</legend><br>

                        <label for="name">Username</label><br><br>
                        <input type="text" name="name" id="name" placeholder="Username"><br><br>
                        <p><?php echo $name_err; ?></p><br><br>

                        <label for="email">Email</label><br><br>
                        <input type="text" name="email" id="email" placeholder="Email"><br><br>
                        <p><?php echo $email_err; ?></p><br><br>

                        <label for="password">Password</label><br><br>
                        <input type="password" name="password" id="password"><br><br>
                        <p><?php echo $password_err; ?></p><br><br>

                        <input type="submit" name="login" value="Login" id="loginButton">
                    </fieldset>
                </form>
            </div>
        </div>
    </main>
    <?php include_once('./template/navbot.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>