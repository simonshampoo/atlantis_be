<?php
include 'db.php';

$id = $conn->real_escape_string($_POST['id']);

$sql = "DELETE FROM Alumni WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
