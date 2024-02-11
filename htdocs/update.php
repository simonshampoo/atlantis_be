<?php
include 'db.php';

$id = $conn->real_escape_string($_POST['id']);
$firstname = $conn->real_escape_string($_POST['firstname']);
$lastname = $conn->real_escape_string($_POST['lastname']);
$email = $conn->real_escape_string($_POST['email']);
$linkedin = $conn->real_escape_string($_POST['linkedin']);
$major = $conn->real_escape_string($_POST['major']);

$picture = NULL;
$pictureType = NULL;
$pictureUpdated = false;

if (isset($_FILES['picture']) && $_FILES['picture']['error'] == UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = $_FILES['picture']['type'];
    if (in_array($fileType, $allowedTypes)) {
        $picture = file_get_contents($_FILES['picture']['tmp_name']);
        $pictureType = $fileType; 
        $pictureUpdated = true;
    } else {
        die("Unsupported file type.");
    }
}

if ($pictureUpdated) {
    $sql = "UPDATE Alumni SET firstname=?, lastname=?, email=?, linkedin=?, major=?, picture=?, filetype=? WHERE id=?";
} else {
    $sql = "UPDATE Alumni SET firstname=?, lastname=?, email=?, linkedin=?, major=? WHERE id=?";
}

$stmt = $conn->prepare($sql);

if ($pictureUpdated) {
    $stmt->bind_param("sssssssi", $firstname, $lastname, $email, $linkedin, $major, $picture, $pictureType, $id);
} else {
    $stmt->bind_param("sssssi", $firstname, $lastname, $email, $linkedin, $major, $id);
}

if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();
$conn->close();
