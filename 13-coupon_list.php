<?php
$conn = mysqli_connect("localhost", "swu25", "0717", "sample");
$sql = "SELECT * FROM couponbox ORDER BY issued_date DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>쿠폰 목록</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <h2>전체 쿠폰 목록</h2>
    
    <div style="margin-bottom: 10px;">
        <a href="index.php"><button style="background-color: #608670;">🏠 홈으로</button></a>
        <a href="13-coupon_write.php"><button>+ 새 쿠폰 등록</button></a>
        <a href="13-coupon_mine.php"><button style="background-color:#3498db;">내 쿠폰함</button></a>
    </div>

    <table>
        <thead>
            <tr>
                <th>번호</th>
                <th>쿠폰명</th>
                <th>회원ID</th>
                <th>좋아요</th>
                <th>발급일</th>
                <th>만료일</th>
                <th>상세</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= $row['userid'] ?></td>
                <td><?= $row['likes'] ?? $row['like'] ?></td> 
                <td><?= $row['issued_date'] ?></td>
                <td style="color: #e74c3c;"><?= $row['expiration_date'] ?></td>
                <td>
                    <a href="13-coupon_view.php?id=<?= $row['id'] ?>">
                        <button style="padding: 5px 10px; font-size: 12px;">보기</button>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>