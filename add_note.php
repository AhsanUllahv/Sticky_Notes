<?php
// Include session management code
require_once("sessionchk.php");

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: signin.php");
    exit(); // Stop further execution
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $note = $_POST['note'];

    if (addNote($user_id, $date, $time, $note)) {
        echo "Note added successfully!";
    } else {
        echo "Error adding note!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Note</title>
    <link rel="stylesheet" type="text/css" href="add_style.css">
</head>
<body>
    <h1>Add Your Note</h1>
<form action="" method="POST" onsubmit="return validateForm()">
    <label for="date">Date:</label>
    <input type="date" name="date" id="date" required><br>
    <label for="time">Time:</label>
    <input type="time" name="time" id="time" required><br>
    <label for="note">Note:</label>
    <textarea name="note" id="note" placeholder="Enter your note" required></textarea><br>
    <input type="submit" value="Add Note">
</form>

<script>
    function validateForm() {
        var note = document.getElementById("note").value;
        if (note.trim() == "") {
            alert("Note field cannot be empty");
            return false;
        }
        return true;
    }
</script>

<button onclick="goBack()">Back to Index</button> <!-- Button to go back to index page -->
    
    <script>
        function goBack() {
            window.location.href = "index.php"; // Replace "index.php" with the actual filename of your index page
        }
    </script>
    
</body>
</html>
