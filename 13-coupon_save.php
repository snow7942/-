<?php
$conn = mysqli_connect("localhost", "swu25", "0717", "sample");

$userid = mysqli_real_escape_string($conn, $_POST['userid']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$expiration_date = date('Y-m-d', strtotime('+45 days'));
$sql = "INSERT INTO couponbox (userid, title, content, issued_date, expiration_date) 
        VALUES ('$userid', '$title', '$content', NOW(), '$expiration_date')";

mysqli_query($conn, $sql);

header("Location: 13-coupon_list.php");
?>