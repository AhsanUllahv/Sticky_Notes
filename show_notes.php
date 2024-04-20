<?php
require_once("sessionchk.php"); // Include session management code
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notes</title>
    <link rel="stylesheet" type="text/css" href="show_style.css">
</head>
<body>
    <h1>Your Notes</h1>
    
    <?php
    include 'database.php';
    
    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];
    
    $notes = getNotes($user_id);
    
    // Sort notes by date
    usort($notes, function($a, $b) {
        return strtotime($a['date']) - strtotime($b['date']);
    });
    
    if (!empty($notes)) {
        foreach ($notes as $note) {
            ?>
            <div class="sticky-note">
                <p>Date: <?= $note['date'] ?></p>
                <p>Time: <?= $note['time'] ?></p>
                <p>Note: <?= $note['note'] ?></p>
                <button onclick="deleteNote(<?= $note['sno'] ?>)" class="single_note_delete">Delete</button>
            </div>
            <?php
        }
    } else {
        echo "<p>No notes found.</p>";
    }
    ?>
    
    <br>
    <button onclick="deleteAllNotes()" class="delete-btn">Delete All Notes</button>
    <br>
    <button onclick="goBack()" class="back-btn">Back</button>
    
    <script>
        function deleteNote(sno) {
            if (confirm("Are you sure you want to delete this note?")) {
                window.location.href = "delete_note.php?sno=" + sno;
            }
        }

        function deleteAllNotes() {
            if (confirm("Are you sure you want to delete all notes?")) {
                window.location.href = "delete_note.php?all=true";
            }
        }

        function goBack() {
            window.location.href = "index.php";
        }
    </script>
</body>
</html>
