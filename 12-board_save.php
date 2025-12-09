<?php
session_start();
$userid = $_SESSION['userid'] ?? 'guest'; 
$title = $_POST['title'];
$content = $_POST['content'];
$conn = new mysqli('localhost', 'swu25', '0717', 'sample');
$stmt = $conn->prepare("INSERT INTO board (userid, title, content) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $userid, $title, $content);
$stmt->execute();

header("Location: 12-board_list.php");
?>