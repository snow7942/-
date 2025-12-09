<?php
session_start();
$conn = new mysqli("localhost", "swu25", "0717", "sample");

$search_query = "";
$search_keyword = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_keyword = $_GET['search'];
    $search_query = " WHERE title LIKE '%$search_keyword%' ";
}

$sql = "SELECT * FROM board" . $search_query . " ORDER BY id DESC";
$result = $conn->query($sql);
$total = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="ko-KR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>영화 한줄평</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700&display=swap');
        body {
            font-family: 'Nanum+Myeongjo', serif;
            background-color: #f0f7f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 60px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #608670;
        }
        a {
            color: #333;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        
        .controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
        }
        .btn-group a {
            display: inline-block;
            background-color: #608670;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
            margin-right: 5px;
        }
        .btn-group a:hover {
            background-color: #4d695c;
        }
        .coupon-btn {
            background-color: #e67e22 !important;
        }
        .coupon-btn:hover {
            background-color: #d35400 !important;
        }
        
        .search-form {
            display: flex;
            gap: 5px;
        }
        .search-form input[type="text"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #eee;
        }
        .search-form button {
            background-color: #4d695c;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #608670;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #e5ece8;
        }
        tr:hover {
            background-color: #dbe4df;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h2>영화 한줄평</h2>
        
        <div class="controls">
            <div class="btn-group">
                <a href="index.php">🏠 홈</a>
                <a href="13-coupon_list.php" class="coupon-btn">🎟️ 쿠폰 이벤트</a>
                <a href="12-board_write.php">글쓰기</a>
            </div>
            
            <form action="12-board_list.php" method="get" class="search-form">
                <input type="text" name="search" placeholder="제목 검색" value="<?= htmlspecialchars($search_keyword) ?>">
                <button type="submit">검색</button>
            </form>
        </div>

        <table>
            <tr>
                <th>번호</th><th>한줄평</th><th>작성자</th><th>날짜</th><th>조회수</th>
            </tr>
            <?php 
            if ($total > 0) {
                while($row = $result->fetch_assoc()) { 
            ?>
            <tr>
                <td><?= $total-- ?></td>
                <td><a href="12-board_view.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a></td>
                <td><?= htmlspecialchars($row['userid']) ?></td>
                <td><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
                <td><?= $row['hits'] ?></td>
            </tr>
            <?php 
                } 
            } else {
                echo "<tr><td colspan='5'>등록된 글이 없습니다.</td></tr>";
            }
            ?>
        </table>
    </div>
  </body>
</html>