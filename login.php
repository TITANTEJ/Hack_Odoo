<?php
include 'db.php';
include 'functions.php';

// Start session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - StackIt</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      margin: 0;
      padding: 0;
    }
    header {
      background: rgba(255, 255, 255, 0.1);
      padding: 20px;
      text-align: center;
      color: #fff;
    }
    nav {
      text-align: center;
      margin: 20px 0;
    }
    nav a {
      color: #fff;
      text-decoration: none;
      margin: 0 15px;
      font-weight: bold;
      transition: color 0.3s;
    }
    nav a:hover {
      color: #ffd700;
    }
    main {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 70vh;
    }
    form {
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
    }
    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
      color: #333;
    }
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }
    button {
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      background-color: #2575fc;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s;
    }
    button:hover {
      background-color: #1a5ed1;
    }
    .message {
      text-align: center;
      color: #fff;
      margin-top: 15px;
      font-weight: bold;
    }
  </style>
</head>
<body>
<header><h1>Login to StackIt</h1></header>
<nav>
  <a href="index.php">Home</a>
  <a href="register.php">Register</a>
</nav>
<main>
  <form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <button type="submit" name="login">Login</button>
  </form>
</main>
<?php
if (isset($_POST['login'])) {
  $email = $conn->real_escape_string($_POST['email']);
  $password = $conn->real_escape_string($_POST['password']);

  $sql = "SELECT * FROM users WHERE email = '$email'";
  $res = $conn->query($sql);

  if ($res->num_rows > 0) {
    $user = $res->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['name'] = $user['name'];
      header("Location: index.php");
      exit();
    } else {
      echo "<p class='message'>Incorrect password!</p>";
    }
  } else {
    echo "<p class='message'>User not found!</p>";
  }
}
?>
</body>
</html>
