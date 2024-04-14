<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sticky Notes</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Welcome to Sticky Notes</h1>
    <div id="username-greeting">
        <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
    </div>
    
    <a href="add_note.php">Add New Note</a>
    <a href="show_notes.php">Show Notes</a>
    <a href="logout.php">Logout</a>
</body>
<br><br><br>
<!--<img src="dancing_monkey.gif" alt="Pic">-->
<img id="dancing-monkey-img" name="dancing-monkey" src="3monkey.gif" alt="Dancing Monkey" >

<!--<img id="dancing-monkey-img" name="dancing-monkey" src="dancing_monkey.gif" alt="Dancing Monkey">-->

<script>
    var img = document.getElementById("dancing-monkey-img");
    img.onclick = function() {
        alert("Ouch! Stop poking me! 🙈");
    }; 
</script>


<audio id="shakira-audio" name="shakira" control autoplay>
  <source src="shakira.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>




</html>
