<?php include 'db.php'; include 'functions.php';
if (!is_admin()) header("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin - StackIt</title>
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header><h1>Admin Panel</h1></header>
<nav>
  <a href="index.php">Home</a>
  <a href="logout.php">Logout</a>
</nav>
<main>
  <h2>All Users</h2>
  <?php
    $result = $conn->query("SELECT id, name, email, role FROM users");
    while($row = $result->fetch_assoc()) {
      echo "<div class='card'>";
      echo "<p><strong>Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
      echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
      echo "<p><strong>Role:</strong> " . htmlspecialchars($row['role']) . "</p>";
      echo "</div>";
    }
  ?>
</main>
</body>
</html>
