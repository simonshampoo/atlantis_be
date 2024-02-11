<?php
include 'db.php';

$sql = "SELECT id, firstname, lastname, email, linkedin, major, picture FROM Alumni";
$result = $conn->query($sql);

$alumni = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['picture'] !== null) {
            $row['picture'] = base64_encode($row['picture']);
        }
        $alumni[] = $row;
    }
    echo json_encode($alumni);
} else {
    echo json_encode([]);
}
$conn->close();
