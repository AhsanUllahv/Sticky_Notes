<?php
include 'database.php';

if (isset($_GET['sno']) && !empty($_GET['sno'])) {
    $delete_id = $_GET['sno'];
    if (deleteNote($delete_id)) {
        header("Location: show_notes.php");
        exit;
    } else {
        echo "<p>Error deleting note!</p>";
    }
} elseif (isset($_GET['all']) && $_GET['all'] === 'true') {
    if (deleteAllNotes()) {
        header("Location: show_notes.php");
        exit;
    } else {
        echo "<p>Error deleting all notes!</p>";
    }
} else {
    echo "<p>No action specified.</p>";
}
?>
