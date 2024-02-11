<?php
include 'db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

// Assuming 'id' is always an integer
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

// Prepared statement
$sql = "DELETE FROM Alumni WHERE id = ?";

// Prepare
$stmt = $conn->prepare($sql);

// Bind and execute
if ($stmt) {
    $stmt->bind_param("i", $id); // "i" denotes the type is "integer"
    if ($stmt->execute()) {
        echo "Record {$id} deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
?>
