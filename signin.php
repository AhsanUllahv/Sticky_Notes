<?php
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];
    
    // Prepare and execute the SQL query to retrieve the user
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set the 'user_id' and 'username' in the session after successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // Redirect the user to the index page or any desired page after successful login
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
    <link rel="stylesheet" type="text/css" href="signin.css">
</head>
<body>
    <h1>Sign In</h1>
    
    <div class="form">
        <form action="" method="POST" id="signin_form" class="signin_form">
            <label for="username_email">Username or Email:</label>
            <input type="text" name="username_email" id="username_email" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <input class="btn-left" type="submit" value="Sign In">
            <p class="btn-right"><a class="btn-look" href="signup.php">Sign Up</a></p>
        </form>
    </div>
    <div class="image">
        <img src="https://cdn-icons-png.freepik.com/512/5087/5087607.png" alt="Pic">
    </div>
</body>
</html>
