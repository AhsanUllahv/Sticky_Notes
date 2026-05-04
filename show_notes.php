<?php
require_once("sessionchk.php");
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

    $user_id = (int) $_SESSION['user_id'];
    $notes = getNotes($user_id);

    if (!empty($notes)) {
        foreach ($notes as $note) {
            ?>
            <div class="sticky-note">
                <p>Date: <?= htmlspecialchars($note['date']) ?></p>
                <p>Time: <?= htmlspecialchars($note['time']) ?></p>
                <p>Note: <?= nl2br(htmlspecialchars($note['note'])) ?></p>
                <button onclick="deleteNote(<?= (int) $note['sno'] ?>)" class="single_note_delete">Delete</button>
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
