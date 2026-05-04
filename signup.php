<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body>
    <h1>Sign Up</h1>

    <?php
    include 'database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if ($username === '' || $email === '' || $password === '') {
            echo "<p>All fields are required.</p>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

            if ($stmt) {
                $stmt->bind_param("sss", $username, $email, $hashed_password);
                if ($stmt->execute()) {
                    echo "<p>Sign up successful!</p>";
                } else {
                    echo "<p>Unable to sign up with those details.</p>";
                }
                $stmt->close();
            } else {
                echo "<p>Something went wrong. Please try again.</p>";
            }
        }
    }
    ?>

    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" value="Sign Up">
    </form>
    <p>To login <a href="signin.php">Sign in</a></p>
</body>
</html>
