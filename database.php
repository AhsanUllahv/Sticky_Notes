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
    $sql = "INSERT INTO notes (user_id, date, time, note, submit_dt) VALUES ('$user_id', '$date', '$time', '$note', '$submit_dt')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

function deleteNote($sno) {
    global $conn;
    $sql = "DELETE FROM notes WHERE sno='$sno'";
    return $conn->query($sql);
}

function deleteAllNotes() {
    global $conn;
    $sql = "TRUNCATE TABLE notes";
    return $conn->query($sql);
}

function getNotes($user_id) {
    global $conn;
    $sql = "SELECT sno, date, time, note FROM notes WHERE user_id='$user_id'";
    $result = $conn->query($sql);
    $notes = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $notes[] = $row;
        }
    }
    return $notes;
}
?>