<?php
include 'db.php';
include 'functions.php';
if (!is_logged_in()) header("Location: login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $tags = $conn->real_escape_string($_POST['tags']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO questions (user_id, title, description, tags) VALUES ('$user_id', '$title', '$description', '$tags')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Ask Question - StackIt</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Ask a Question</h1></header>
<nav>
  <a href="index.php">Home</a>
  <a href="logout.php">Logout</a>
</nav>
<main class="form-container">
  <form method="POST">
    <label>Title:</label>
    <input type="text" name="title" required>
    <label>Description:</label>
    <textarea name="description" required></textarea>
    <label>Tags (comma separated):</label>
    <input type="text" name="tags">
    <button type="submit">Post Question</button>
  </form>
</main>
</body>
</html>
