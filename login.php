
<?php
session_start();

include("db.php");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (empty($username)) {
        $errors[] = "Username is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($errors)) {
        $result = pg_query_params(
            $conn,
            'SELECT * FROM users WHERE username = $1',
            [$username]
        );

        if (!$result) {
            $errors[] = "Database query failed";
        } else {
            $user = pg_fetch_assoc($result);

            if ($user && password_verify($password, $user["password"])) {
                session_regenerate_id(true);

                $_SESSION["username"] = $user["username"];

                header("Location: dashboard.php");
                exit();
            } else {
                $errors[] = "Invalid username or password";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <h3>Login</h3>

    <form method="POST" action="">
        <label for="username">Enter Username:</label>
        <input type="text" name="username" id="username" required>

        <br><br>

        <label for="password">Enter Password:</label>
        <input type="password" name="password" id="password" required>

        <br><br>

        <button type="submit">Login</button>
    </form>

    <?php foreach ($errors as $error) { ?>
        <p style="color: red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php } ?>

    <p>Don't have an account?
        <a href="register.php">Register here</a>
    </p>

</body>
</html>
