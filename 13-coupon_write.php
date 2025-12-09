<?php
$conn = mysqli_connect("localhost", "swu25", "0717", "sample");

$sql_users = "SELECT userid, name FROM cgvtable ORDER BY userid ASC";
$result_users = mysqli_query($conn, $sql_users);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>쿠폰 발급</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <h2>쿠폰 발급</h2>

    <form method="post" action="13-coupon_save.php">
        <div>
            <label>회원 ID (대상 선택)</label><br>
            
            <select name="userid" required style="width: 92%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">회원을 선택하세요</option>
                <?php 
                while($user = mysqli_fetch_assoc($result_users)) { 
                    $uid = $user['userid'];
                    $uname = $user['name'];
                ?>
                    <option value="<?= $uid ?>"><?= $uname ?> (<?= $uid ?>)</option>
                <?php } ?>
            </select>
        </div>
        
        <div>
            <label>쿠폰명</label><br>
            <input type="text" name="title" placeholder="쿠폰 이름을 입력하세요" required>
        </div>
        
        <div>
            <label>내용</label><br>
            <textarea name="content" rows="5" placeholder="내용을 입력하세요"></textarea>
        </div>
        
        <button type="submit">발급하기</button>
        <a href="13-coupon_list.php"><button type="button" style="background-color:#95a5a6;">취소</button></a>
    </form>

</body>
</html>