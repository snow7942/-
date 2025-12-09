<?php
session_start();
$id = $_GET['id'];
$conn = new mysqli('localhost', 'swu25', '0717', 'sample');
$conn->query("DELETE FROM board WHERE id = $id");
header("Location: 12-board_list.php");
?>