<?php
require_once("sessionchk.php");
include 'database.php';

$user_id = (int) $_SESSION['user_id'];

if (isset($_GET['sno']) && $_GET['sno'] !== '') {
    $delete_id = (int) $_GET['sno'];
    if (deleteNote($delete_id, $user_id)) {
        header("Location: show_notes.php");
        exit;
    }

    echo "<p>Error deleting note!</p>";
} elseif (isset($_GET['all']) && $_GET['all'] === 'true') {
    if (deleteAllNotes($user_id)) {
        header("Location: show_notes.php");
        exit;
    }

    echo "<p>Error deleting all notes!</p>";
} else {
    echo "<p>No action specified.</p>";
}
?>
