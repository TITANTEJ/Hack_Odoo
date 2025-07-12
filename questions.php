<?php include 'db.php'; include 'functions.php';
$id = intval($_GET['id']);
$question = $conn->query("SELECT * FROM questions WHERE id = $id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo htmlspecialchars($question['title']); ?> - StackIt</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({ selector: '#answer' });
  </script>
</head>
<body>
<header><h1><?php echo htmlspecialchars($question['title']); ?></h1></header>
<nav>
  <a href="index.php">Home</a>
  <a href="ask.php">Ask Question</a>
  <?php if (!is_logged_in()): ?>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
  <?php else: ?>
    <a href="logout.php">Logout</a>
  <?php endif; ?>
</nav>
<main>
  <div class="card">
    <?php echo $question['description']; ?>
    <p><strong>Tags:</strong> <?php echo htmlspecialchars($question['tags']); ?></p>
  </div>

  <h3>Answers</h3>
  <?php
    $answers = $conn->query("SELECT * FROM answers WHERE question_id = $id ORDER BY votes DESC");
    while($ans = $answers->fetch_assoc()) {
      echo "<div class='card'>";
      echo $ans['content'];
      echo "<p>Votes: " . $ans['votes'] . " ";
      echo "<a href='vote.php?id=" . $ans['id'] . "&type=up'>Upvote</a> ";
      echo "<a href='vote.php?id=" . $ans['id'] . "&type=down'>Downvote</a></p>";
      if (is_logged_in() && $_SESSION['user_id'] == $question['user_id']) {
        echo "<a href='mark_accepted.php?answer_id=" . $ans['id'] . "&question_id=" . $question['id'] . "'>Mark as Accepted</a> ";
      }
      if ($ans['accepted']) {
        echo "<strong style='color:green;'>✔ Accepted Answer</strong>";
      }
      echo "</div>";
    }
  ?>

  <?php if (is_logged_in()): ?>
    <h3>Post your Answer</h3>
    <form action="submit_answer.php" method="POST">
      <textarea id="answer" name="content"></textarea>
      <input type="hidden" name="question_id" value="<?php echo $id; ?>">
      <button type="submit">Submit Answer</button>
    </form>
  <?php else: ?>
    <p><a href="login.php">Login</a> to post an answer.</p>
  <?php endif; ?>
</main>
</body>
</html>
