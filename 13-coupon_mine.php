<?php
session_start();
$conn = mysqli_connect("localhost", "swu25", "0717", "sample");
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';

if (!$userid) {
    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.href='login.php';</script>";
    exit;
}

$sql = "SELECT * FROM couponbox WHERE userid = '$userid' ORDER BY issued_date DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>내 쿠폰함</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .status-used { color: #e74c3c; font-weight: bold; }
        .status-active { color: #2ecc71; font-weight: bold; }
    </style>
</head>
<body>

    <h2>📂 내 쿠폰함 (<?= $userid ?>님)</h2>

    <div style="margin-bottom: 15px;">
        <a href="index.php"><button style="background-color: #608670;">🏠 홈으로</button></a>
    </div>

    <table>
        <thead>
            <tr>
                <th>쿠폰명</th>
                <th width="40%">내용</th>
                <th>발급일</th>
                <th>상태</th>
                <th>관리</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan='5'>발급받은 쿠폰이 없습니다.</td></tr>";
            } else {
                while($row = mysqli_fetch_assoc($result)) { 
            ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['content']) ?></td>
                <td><?= $row['issued_date'] ?></td>
                <td>
                    <?php if($row['is_used']) { ?>
                        <span class="status-used">사용완료</span>
                    <?php } else { ?>
                        <span class="status-active">사용가능</span>
                    <?php } ?>
                </td>
                <td>
                    <a href="13-coupon_view.php?id=<?= $row['id'] ?>&mode=mine">
                        <button style="padding: 5px 10px; font-size: 12px;">상세보기</button>
                    </a>
                </td>
            </tr>
            <?php 
                } 
            }
            ?>
        </tbody>
    </table>

</body>
</html>