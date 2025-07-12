<?php
include 'db.php';
include 'functions.php';
if (!is_logged_in()) header("Location: login.php");

$answer_id = intval($_GET['answer_id']);
$question_id = intval($_GET['question_id']);

// Only the question owner can mark
$q = $conn->query("SELECT user_id FROM questions WHERE id = $question_id")->fetch_assoc();
if ($q['user_id'] != $_SESSION['user_id']) {
  echo "You are not allowed to mark this answer.";
  exit;
}

// Reset all to unaccepted first (if needed)
// Add an 'accepted' column to answers:
// ALTER TABLE answers ADD accepted TINYINT(1) DEFAULT 0;

$conn->query("UPDATE answers SET accepted = 0 WHERE question_id = $question_id");
$conn->query("UPDATE answers SET accepted = 1 WHERE id = $answer_id");

header("Location: question.php?id=$question_id");
?>
