<?php
session_start();
$conn = mysqli_connect("localhost", "swu25", "0717", "sample");
$id = (int)$_GET['id'];
$mode = isset($_GET['mode']) ? $_GET['mode'] : ''; // 모드 확인

$check_sql = "SELECT expiration_date FROM couponbox WHERE id = $id";
$check_result = mysqli_query($conn, $check_sql);
$row = mysqli_fetch_assoc($check_result);

$today = date('Y-m-d');
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
$isAdmin = ($userid == 'admin' || $userid == 'swu25');

if ($mode == 'mine') {
    if ($today < $row['expiration_date']) {
        echo "<script>alert('만료일이 지나지 않아 삭제할 수 없습니다.'); location.href='13-coupon_view.php?id=$id&mode=mine';</script>";
        exit;
    }
} else {
    if (!$isAdmin && $today < $row['expiration_date']) {
        echo "<script>alert('만료일이 지나지 않아 삭제할 수 없습니다.'); location.href='13-coupon_view.php?id=$id';</script>";
        exit;
    }
}

$sql = "DELETE FROM couponbox WHERE id = $id";
mysqli_query($conn, $sql);

if ($mode == 'mine') {
    header("Location: 13-coupon_mine.php");
} else {
    header("Location: 13-coupon_list.php");
}
?>