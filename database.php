<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sticky_notes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addNote($user_id, $date, $time, $note) {
    global $conn;

    $submit_dt = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("INSERT INTO notes (user_id, date, time, note, submit_dt) VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("issss", $user_id, $date, $time, $note, $submit_dt);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

function deleteNote($sno, $user_id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM notes WHERE sno = ? AND user_id = ?");
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("ii", $sno, $user_id);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

function deleteAllNotes($user_id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM notes WHERE user_id = ?");
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("i", $user_id);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

function getNotes($user_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT sno, date, time, note FROM notes WHERE user_id = ? ORDER BY date ASC, time ASC, sno ASC");
    if (!$stmt) {
        return [];
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $notes = [];
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }

    $stmt->close();
    return $notes;
}
?>
