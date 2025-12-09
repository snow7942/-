<?php
$conn = new mysqli("localhost", "swu25", "0717", "sample");
if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}

$userid = $_POST["userid"] ?? '';
$password = password_hash($_POST["password"] ?? '', PASSWORD_DEFAULT);
$name = $_POST["name"] ?? '';
$email = $_POST["email"] ?? '';
$address = $_POST["address"] ?? '';
$is_univ = isset($_POST["is_univ"]) ? 1 : 0;
$is_swu = isset($_POST["is_swu"]) ? 1 : 0;

$sql = "INSERT INTO cgvtable
(userid, password, name, email, address, is_univ, is_swu)
VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssii", $userid, $password, $name, $email, $address, $is_univ, $is_swu);

$success = $stmt->execute();
$error_message = $stmt->error;
?>
<!DOCTYPE html>
<html lang="ko-KR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>회원가입 완료</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700&display=swap');
        body {
            font-family: 'Nanum+Myeongjo', serif;
            background-color: #f0f7f4; 
            color: #333333; 
            text-align: center;
            padding-top: 80px;
        }
        .box {
            background-color: #ffffff; 
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            margin: auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); 
        }
        h2 {
            color: #4d695c; 
        }
        p {
            margin-top: 20px;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background-color: #608670;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #4d695c; 
        }
    </style>
  </head>
  <body>
    <div class="box">
        <?php if ($success): ?>
            <h2>회원가입 완료</h2>
            <p><strong><?= htmlspecialchars($name) ?></strong>님, 환영합니다!</p>
            <p>이제 CGV 영화 예매 서비스를 이용하실 수 있습니다.</p>
            <a href="11w-251121-pj-member_list.php" class="btn">회원 목록 보기</a>
            <a href="11w-251121-pj.php" class="btn" style="margin-left: 10px;">홈으로</a>
        <?php else: ?>
            <h2>오류 발생</h2>
            <p><?= htmlspecialchars($error_message) ?></p>
            <a href="11w-251121-pj.php" class="btn">돌아가기</a>
        <?php endif; ?>
    </div>
  </body>
</html>
<?php
$stmt->close();
$conn->close();
?>