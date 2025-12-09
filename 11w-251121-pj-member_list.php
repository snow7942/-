<?php
$conn = new mysqli("localhost", "swu25", "0717", "sample");
if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}

$sql = "SELECT id, userid, name, email, address, is_univ, is_swu, regdate,
        (SELECT COUNT(*) FROM couponbox WHERE userid = cgvtable.userid) AS coupon_count,
        CASE
            WHEN is_univ=1 AND is_swu=1 THEN '20%'
            WHEN is_univ=1 OR is_swu=1 THEN '10%'
            ELSE '0%'
        END AS discount
        FROM cgvtable";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ko-KR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>회원 목록 조회 - 관리자용</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700&display=swap');
        body {
            font-family: 'Nanum+Myeongjo', serif;
            background-color: #f0f7f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        table {
            width: 95%; 
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #608670; 
            color: white;
        }

        tr:nth-child(even) {
            background-color: #e5ece8; 
        }

        .note {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin-top: 20px;
        }

        .home-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            color: #666;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }
        .home-link:hover {
            color: #333;
            text-decoration: underline;
        }
        .admin-controls {
            text-align: center;
            margin-top: 20px;
        }
        .admin-controls a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #608670;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
  </head>
  <body>
    <h2>CGV 회원 목록 (관리자용)</h2>
    <table>
        <tr>
            <th>NO</th>
            <th>아이디</th>
            <th>이름</th>
            <th>이메일</th>
            <th>주소</th>
            <th>대학생</th>
            <th>서울여대</th>
            <th>할인율</th>
            <th>쿠폰수</th>
            <th>가입일시</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            $num = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $num++ . "</td>"; 
                echo "<td>" . htmlspecialchars($row["userid"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["address"]) . "</td>";
                echo "<td>" . ($row["is_univ"] ? "✅" : "❌") . "</td>";
                echo "<td>" . ($row["is_swu"] ? "✅" : "❌") . "</td>";
                echo "<td><strong>" . $row["discount"] . "</strong></td>";
                echo "<td style='color:#e67e22; font-weight:bold;'>" . $row["coupon_count"] . "개</td>";
                echo "<td>" . $row["regdate"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan = '10'>등록된 회원이 없습니다.</td></tr>";
        }
        ?>

    </table>
    <p class="note">* 할인율은 대학생(10%) + 서울여대 학생(10%) 기준으로 계산됩니다.</p>
    
    <div class="admin-controls">
        <a href="index.php">🏠 홈으로 돌아가기</a>
        <a href="13-coupon_list.php">🎟️ 전체 쿠폰 관리</a>
    </div>

  </body>
</html>

<?php
$conn->close();
?>