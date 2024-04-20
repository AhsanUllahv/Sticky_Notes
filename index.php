<?php
// Include session management code
require_once("sessionchk.php");
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sticky Notes</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Welcome to Sticky Notes</h1>
    <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
    <a href="add_note.php">Add New Note</a>
    <a href="show_notes.php">Show Notes</a>
    <a href="logout.php">Logout</a>
</body>
<br><br><br>
<!--<img src="dancing_monkey.gif" alt="Pic">-->
<!-- <img id="dancing-monkey-img" name="dancing-monkey" src="https://i.giphy.com/z8pi6Q8wTxuFO.webp" alt="Dancing Monkey" > -->

<!-- <audio controls autoplay id="shakira-audio" class="shakira-audio">
  <source src="shakira.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio> -->

</html>
