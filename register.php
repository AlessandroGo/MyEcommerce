<?php
require_once './dbcon.php';
$name = $email = $password = $confirm_password = '';
$name_err = $email_err = $password_err = $confirm_password_err = '';
// Process form when post submit
// Process form when post submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize POST
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Put post vars in regular vars
    $name =  validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $confirm_password = validate($_POST['confirm_password']);

    // Validate email
    if (empty($email)) {
        $email_err = 'Please enter email';
    } else {
        // Prepare a select statement
        $sql = 'SELECT id FROM users WHERE email = :email';

        if ($stmt = $db->prepare($sql)) {
            // Bind variables
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Attempt to execute
            if ($stmt->execute()) {
                // Check if email exists
                if ($stmt->rowCount() === 1) {
                    $email_err = 'Email is already taken';
                }
            } else {
                die('Something went wrong');
            }
        }

        unset($stmt);
    }

    // Validate name
    if (empty($name)) {
        $name_err = 'Please enter name';
    }

    // Validate password
    if (empty($password)) {
        $password_err = 'Please enter password';
    } elseif (strlen($password) < 6) {
        $password_err = 'Password must be at least 6 characters ';
    }

    // Validate Confirm password
    if (empty($confirm_password)) {
        $confirm_password_err = 'Please confirm password';
    } else {
        if ($password !== $confirm_password) {
            $confirm_password_err = 'Passwords do not match';
        }
    }

    // Make sure errors are empty
    if (empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // Hash password
        // echo "Valid";
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare insert query
        $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';

        if ($stmt = $db->prepare($sql)) {
            // Bind params
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);

            // Attempt to execute
            if ($stmt->execute()) {
                // Redirect to login
                header('location: login.php');
            } else {
                die('Something went wrong');
            }
        }
        unset($stmt);
    }

    // Close connection
    unset($db);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include_once('./template/navtop.php'); ?>
    <main class="mb-auto mt-5 pt-3">
        <div class="d-flex justify-content-center align-items-center">
            <form method="POST">
                <fieldset>
                    <legend>Registration</legend><br>

                    <label for="name">Username</label><br><br>
                    <input type="text" name="name" placeholder="Username"><br><br>
                    <p><?php echo $name_err; ?></p><br><br>

                    <label for="email">Email</label><br><br>
                    <input type="text" name="email" placeholder="Email"><br><br>
                    <p><?php echo $email_err; ?></p><br><br>

                    <label for="password">Password</label><br><br>
                    <input type="password" name="password"><br><br>
                    <p><?php echo $password_err; ?></p><br><br>

                    <label for="confirm_password">Confirm Password</label><br><br>
                    <input type="password" name="confirm_password"><br><br>
                    <p><?php echo $confirm_password_err; ?></p><br><br>

                    <input type="submit" name="register" value="Register">
                </fieldset>
            </form>
        </div>
    </main>
    <?php include_once('./template/navbot.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>