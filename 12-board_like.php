<?php
session_start();
$userid = $_SESSION['userid'];
$board_id = $_POST['board_id'];

$conn = new mysqli('localhost', 'swu25', '0717', 'sample');

$check = $conn->query("SELECT * FROM board_likes WHERE board_id=$board_id AND user_id='$userid'");
if ($check->num_rows == 0) {
    $conn->query("INSERT INTO board_likes (board_id, user_id) VALUES ($board_id, '$userid')");
}

header("Location: 12-board_view.php?id=$board_id");
?>