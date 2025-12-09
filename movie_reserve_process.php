<?php
session_start();
<?php
session_start();
$conn = new mysqli("localhost", "swu25", "0717", "sample");

$userid = $_SESSION['userid'];
$movie_title = $_POST['movie_title'];
$showtime = $_POST['showtime'];
$people_count = $_POST['people_count'];
$total_price = $_POST['total_price'];
$coupon_id = $_POST['coupon_id'];

$stmt = $conn->prepare("INSERT INTO reservations (userid, movie_title, showtime, people_count, total_price) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssii", $userid, $movie_title, $showtime, $people_count, $total_price);
$stmt->execute();

if (!empty($coupon_id)) {
    $coupon_sql = "UPDATE couponbox SET is_used = 1, used_date = CURDATE() WHERE id = $coupon_id";
    mysqli_query($conn, $coupon_sql);
}

echo "<script>alert('예매가 완료되었습니다.'); location.href='index.php';</script>";
?>