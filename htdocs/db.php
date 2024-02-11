<?php
header("Access-Control-Allow-Origin: *"); // Allows all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allows specific HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // Allows specific headers

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // The request is a pre-flight request. We only need to send back the headers.
    exit(0);
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "atlantis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
