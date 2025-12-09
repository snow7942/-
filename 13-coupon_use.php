<?php
$conn = mysqli_connect("localhost", "swu25", "0717", "sample");
$id = (int)$_GET['id'];
$sql = "UPDATE couponbox SET is_used=1, used_date=CURDATE() WHERE id=$id";
mysqli_query($conn, $sql);
header("Location: 13-coupon_view.php?id=$id");
?>