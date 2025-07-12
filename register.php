<?php include 'db.php'; include 'functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register - StackIt</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f4f8;
      margin: 0;
      padding: 0;
    }
    header {
      background: #2563eb;
      color: white;
      padding: 20px;
      text-align: center;
    }
    nav {
      background: #1e40af;
      padding: 10px;
      text-align: center;
    }
    nav a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-weight: bold;
      transition: color 0.2s ease;
    }
    nav a:hover {
      color: #facc15;
    }
    main {
      max-width: 500px;
      background: white;
      margin: 40px auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    form label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
      color: #333;
    }
    form input[type="text"],
    form input[type="email"],
    form input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
      background: #f9fafb;
    }
    button {
      background: #2563eb;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
      transition: background 0.3s ease;
    }
    button:hover {
      background: #1d4ed8;
    }
    p {
      text-align: center;
      margin-top: 15px;
    }
    p a {
      color: #2563eb;
      text-decoration: none;
      font-weight: 500;
    }
    p a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<header><h1>Register</h1></header>
<nav>
  <a href="index.php">Home</a>
  <a href="login.php">Login</a>
</nav>
<main>
  <form method="POST">
    <label>Name:</label>
    <input type="text" name="name" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <button type="submit" name="register">Register</button>
  </form>
  <?php
  if (isset($_POST['register'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'user')";
    if ($conn->query($sql) === TRUE) {
      echo "<p>Registered successfully! <a href='login.php'>Login here</a></p>";
    } else {
      echo "<p>Error: " . $conn->error . "</p>";
    }
  }
  ?>
</main>
</body>
</html>
