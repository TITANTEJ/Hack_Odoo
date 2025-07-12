<?php include 'db.php'; include 'functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>StackIt - Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* General Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f4f7fa;
      color: #333;
      line-height: 1.6;
    }

    /* Header */
    header {
      background-color: #2563eb;
      color: #fff;
      padding: 20px 40px;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    header h1 {
      font-size: 2.5rem;
      margin-bottom: 5px;
    }

    header p {
      font-size: 1.1rem;
      opacity: 0.9;
    }

    /* Navigation */
    nav {
      background-color: #1e40af;
      padding: 12px 40px;
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s ease;
    }

    nav a:hover {
      color: #facc15;
    }

    /* Main Content */
    main {
      max-width: 900px;
      margin: 40px auto;
      padding: 0 20px;
    }

    main h2 {
      font-size: 1.8rem;
      margin-bottom: 20px;
      color: #1e3a8a;
    }

    /* Card Style for Questions */
    .card {
      background-color: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      position: relative;
    }

    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
    }

    .card h3 {
      font-size: 1.3rem;
      margin-bottom: 8px;
    }

    .card a {
      color: #2563eb;
      text-decoration: none;
    }

    .card a:hover {
      text-decoration: underline;
    }

    /* Voting Buttons */
    .vote-box {
      position: absolute;
      left: -60px;
      top: 50%;
      transform: translateY(-50%);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 5px;
    }

    .vote-btn {
      background-color: #e5e7eb;
      border: none;
      border-radius: 6px;
      padding: 6px 8px;
      cursor: pointer;
      transition: background-color 0.2s ease;
      font-size: 1rem;
    }

    .vote-btn:hover {
      background-color: #d1d5db;
    }

    .vote-count {
      font-weight: bold;
      color: #1f2937;
    }

    /* Forms: Login, Register, Ask */
    .form-container {
      background-color: #fff;
      max-width: 500px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      border: 1px solid #e5e7eb;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #1d4ed8;
    }

    form label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"],
    form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 6px;
      border: 1px solid #cbd5e1;
      background-color: #f9fafb;
    }

    form textarea {
      height: 120px;
      resize: vertical;
    }

    form button {
      background-color: #2563eb;
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    form button:hover {
      background-color: #1d4ed8;
    }

    /* Admin Dashboard */
    .admin-dashboard {
      background-color: #fff;
      max-width: 1000px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 10px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }

    .admin-dashboard h2 {
      font-size: 1.6rem;
      color: #1e3a8a;
      margin-bottom: 20px;
    }

    .admin-dashboard table {
      width: 100%;
      border-collapse: collapse;
      background-color: #f9fafb;
    }

    .admin-dashboard th,
    .admin-dashboard td {
      padding: 12px 15px;
      border-bottom: 1px solid #e2e8f0;
      text-align: left;
    }

    .admin-dashboard th {
      background-color: #eff6ff;
      color: #1e40af;
    }

    .admin-dashboard tr:hover {
      background-color: #e0f2fe;
    }

    .admin-btn {
      background-color: #dc2626;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 0.9rem;
      transition: background-color 0.2s ease;
    }

    .admin-btn:hover {
      background-color: #b91c1c;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      nav {
        flex-direction: column;
        align-items: center;
      }

      .vote-box {
        left: -40px;
      }

      .card {
        padding-left: 60px;
      }

      .admin-dashboard table,
      .admin-dashboard thead,
      .admin-dashboard tbody,
      .admin-dashboard th,
      .admin-dashboard td,
      .admin-dashboard tr {
        display: block;
      }

      .admin-dashboard td {
        border: none;
        position: relative;
        padding-left: 50%;
      }

      .admin-dashboard td::before {
        position: absolute;
        left: 10px;
        top: 12px;
        font-weight: bold;
        color: #6b7280;
        content: attr(data-label);
      }
    }
  </style>
</head> 
<body>

<header>
  <h1>StackIt</h1>
  <p>Minimal Q&A Platform</p>
</header>

<nav>
  <a href="index.php">Home</a>
  <a href="ask.php">Ask Question</a>
  <?php if (!is_logged_in()): ?>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
  <?php else: ?>
    <a href="logout.php">Logout</a>
    <?php if (is_admin()): ?><a href="admin.php">Admin</a><?php endif; ?>
  <?php endif; ?>
</nav>

<main>
  <h2>Recent Questions</h2>
  <?php
    $result = $conn->query("SELECT id, title FROM questions ORDER BY id DESC");
    if ($result && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<div class='vote-box'>";
        echo "<form method='post' action='vote.php'>";
        echo "<input type='hidden' name='question_id' value='" . $row["id"] . "'>";
        echo "<button class='vote-btn' name='vote' value='up'>&#9650;</button>";
        echo "<div class='vote-count'>" . (int)$row["votes"] . "</div>";
        echo "<button class='vote-btn' name='vote' value='down'>&#9660;</button>";
        echo "</form>";
        echo "</div>";
        echo "<h3><a href='question.php?id=" . $row["id"] . "'>" . htmlspecialchars($row["title"]) . "</a></h3>";
        echo "</div>";
      }
    } else {
      echo "<p>No questions yet. Be the first to <a href='ask.php'>ask a question</a>.</p>";
    }
  ?>
</main>

<script src="assets/js/script.js"></script>
</body>
</html>