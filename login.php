
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

        if (pg_num_rows($result) > 0) {
            $errors[] = "Username already exists";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $result = pg_query_params(
                $conn,
                'INSERT INTO users (username, password) VALUES ($1, $2)',
                [$username, $hashedPassword]
            );

            if ($result) {
                header("Location: index.php");
                exit();
            } else {
                $errors[] = "Registration failed";
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
    <title>Register</title>
</head>
<body>
    <h3>Register</h3>

    <form method="POST">
        <label for="username">Enter Username:
            <input type="text" name="username" id="username"
                   placeholder="Username" required>
        </label>

        <br><br>

        <label for="password">Enter Password:
            <input type="password" name="password" id="password"
                   placeholder="Password" required>
        </label>

        <br><br>

        <button type="submit">Register</button>
    </form>

    <?php foreach ($errors as $error) { ?>
        <p style="color: red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php } ?>

    <p>Already have an account? <a href="index.php">Login here</a></p>
</body>
</html>
