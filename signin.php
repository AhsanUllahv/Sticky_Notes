<?php
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username = '$username_email' OR email = '$username_email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            echo "<p>Incorrect password</p>";
        }
    } else {
        echo "<p>User not found</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body>
    <h1>Sign In</h1>
    
    <form action="" method="POST">
        <label for="username_email">Username or Email:</label>
        <input type="text" name="username_email" id="username_email" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" value="Sign In">
    </form>

    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
</body>
</html>
