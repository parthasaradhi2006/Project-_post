<?php
session_start();
include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];
        header("Location: dashboard.php");
    } else {
        echo "Invalid login.";
    }
}
?>
<html>
    <head>
          <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>

<form method="POST">
  Username: <input type="text" name="username" required placeholder="username"><br>
  Password: <input type="password" name="password" required placeholder="password"><br>
  <button type="submit">Login</button>
</form>
</body>
</html>