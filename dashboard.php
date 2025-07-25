<?php
session_start();
include "config.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
$isAdmin = ($_SESSION["role"] === "admin");
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="dbstyle.css">
</head>
<body>
<h1>Welcome, <?php echo $_SESSION["username"]; ?> (<?php echo $_SESSION["role"]; ?>)</h1>
<a href="create.php">Add Post</a> | <a href="logout.php">Logout</a>
<hr>
<?php while ($row = $result->fetch_assoc()) { ?>
  
  <div><h2><?php echo htmlspecialchars($row["title"]); ?></h2>
  <h3>*<?php  echo htmlspecialchars($row["content"]); ?></h3>
</div>
  <?php if ($isAdmin): ?>
    <a href="edit.php?id=<?php echo $row["id"]; ?> ">Edit</a> |         
    <a href="delete.php?id=<?php echo $row["id"]; ?> style="color:red;" >Delete</a>
  <?php endif; ?>
  <hr>
<?php } ?>
  </body>
  </html>