<?php
session_start();
$conn = mysqli_connect("localhost", "swu25", "0717", "sample");

$id = (int)$_GET['id'];
$mode = isset($_GET['mode']) ? $_GET['mode'] : '';

$sql = "SELECT * FROM couponbox WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$today = date('Y-m-d');
$expiration_date = $row['expiration_date'];

$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
$isAdmin = ($userid == 'admin' || $userid == 'swu25');

$canDelete = false;

if ($mode == 'mine') {
    if ($today >= $expiration_date) {
        $canDelete = true;
    }
} else {
    if ($isAdmin || $today >= $expiration_date) {
        $canDelete = true;
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쿠폰 상세</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container { max-width: 700px; margin: 30px auto; background-color: white; padding: 40px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.05); border: 1px solid #e5ece8; }
        h2 { border-bottom: 2px solid #608670; padding-bottom: 15px; margin-top: 0; }
        p { font-size: 16px; line-height: 1.6; margin: 15px 0; border-bottom: 1px solid #f2f2f2; padding-bottom: 10px; }
        .label { display: inline-block; width: 80px; font-weight: bold; color: #608670; }
        .content-box { background-color: #f9fbf9; padding: 15px; border-radius: 5px; margin-top: 5px; }
        .used { color: #e74c3c; font-weight: bold; }
        .status-active { color: #2ecc71; font-weight: bold; }
        .button-group { margin-top: 30px; text-align: center; }
        .button-group a { margin: 0 5px; }
        .btn-disabled { background-color: #ccc !important; cursor: not-allowed; }
    </style>
</head>
<body>

    <div class="container">
        <h2>쿠폰 상세 정보</h2>
        
        <p><span class="label">쿠폰명</span> <strong><?= htmlspecialchars($row['title']) ?></strong></p>
        <p><span class="label">회원 ID</span> <?= $row['userid'] ?></p>
        <p><span class="label">발급일</span> <?= $row['issued_date'] ?></p>
        <p><span class="label">만료일</span> <span style="color:#e74c3c; font-weight:bold;"><?= $expiration_date ?></span></p>
        
        <p>
            <span class="label">상태</span> 
            <?php if($row['is_used']) { ?>
                <span class="used">사용됨 (Used)</span>
            <?php } else { ?>
                <span class="status-active">미사용 (Active)</span>
            <?php } ?>
        </p>

        <div style="margin-top: 20px;">
            <span class="label" style="vertical-align: top;">내용</span>
            <div class="content-box">
                <?= nl2br(htmlspecialchars($row['content'])) ?>
            </div>
        </div>

        <div class="button-group">
            
            <?php if(!$row['is_used']) { ?>
                <a href="13-coupon_use.php?id=<?= $id ?>">
                    <button>쿠폰 사용</button>
                </a>
            <?php } ?>

            <a href="13-coupon_like.php?id=<?= $id ?>">
                <button>좋아요 (<?= $row['likes'] ?? 0 ?>)</button>
            </a>
            
            <?php if ($canDelete) { ?>
                <a href="13-coupon_delete.php?id=<?= $id ?>&mode=<?= $mode ?>" onclick="return confirm('정말로 삭제하시겠습니까?');">
                    <button style="background-color: #e74c3c;">삭제</button> 
                </a>
            <?php } else { ?>
                <button class="btn-disabled" onclick="alert('만료일(<?= $expiration_date ?>)이 지나야 삭제할 수 있습니다.');">삭제 불가</button>
            <?php } ?>

            <?php if ($mode == 'mine') { ?>
                <a href="13-coupon_mine.php">
                    <button style="background-color: #95a5a6;">목록으로</button> 
                </a>
            <?php } else { ?>
                <a href="13-coupon_list.php">
                    <button style="background-color: #95a5a6;">목록으로</button> 
                </a>
            <?php } ?>
        </div>
    </div>

</body>
</html>