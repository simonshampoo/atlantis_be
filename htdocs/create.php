<?php
include 'db.php';

$firstname = $conn->real_escape_string($_POST['firstname']);
$lastname = $conn->real_escape_string($_POST['lastname']);
$email = $conn->real_escape_string($_POST['email']);
$linkedin = $conn->real_escape_string($_POST['linkedin']);
$major = $conn->real_escape_string($_POST['major']);

$picture = NULL;
$pictureType = NULL;

if (isset($_FILES['picture']) && $_FILES['picture']['error'] == UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = $_FILES['picture']['type'];
    if (in_array($fileType, $allowedTypes)) {
        $picture = file_get_contents($_FILES['picture']['tmp_name']);
        $pictureType = $fileType; 
    } else {
        die("Unsupported file type.");
    }
}

$sql = "INSERT INTO alumni (firstname, lastname, email, linkedin, picture, filetype, major) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sssssss", $firstname, $lastname, $email, $linkedin, $picture, $pictureType, $major);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
