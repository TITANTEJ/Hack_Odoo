<?php
include 'db.php';
include 'functions.php';
if (!is_logged_in()) {
  echo "Login to vote.";
  exit;
}

$question_id = intval($_GET['id']);
$type = $_GET['type'];

if ($type == 'up') {
  $conn->query("UPDATE questions SET votes = votes + 1 WHERE id = $question_id");
} elseif ($type == 'down') {
  $conn->query("UPDATE questions SET votes = votes - 1 WHERE id = $question_id");
}

header("Location: " . $_SERVER['HTTP_REFERER']);
?>
