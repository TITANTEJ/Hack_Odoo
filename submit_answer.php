<?php
include 'db.php';
include 'functions.php';
if (!is_logged_in()) header("Location: login.php");

$content = $conn->real_escape_string($_POST['content']);
$question_id = intval($_POST['question_id']);
$user_id = $_SESSION['user_id'];

$sql = "INSERT INTO answers (question_id, user_id, content) VALUES ('$question_id', '$user_id', '$content')";
if ($conn->query($sql) === TRUE) {
  header("Location: question.php?id=" . $question_id);
} else {
  echo "Error: " . $conn->error;
}
?>
