<?php
include 'db.php';
session_start();

// Assuming username is stored in session (else you can hardcode as 'xyz')
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'xyz';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "INSERT INTO questions (username, title, description) VALUES ('$username', '$title', '$description')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
