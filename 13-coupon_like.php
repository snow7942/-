<?php
$conn = mysqli_connect("localhost", "swu25", "0717", "sample");
$id = (int)$_GET['id'];
$sql = "UPDATE couponbox SET likes = likes + 1 WHERE id = $id";
mysqli_query($conn, $sql);
header("Location: 13-coupon_view.php?id=$id");
?>