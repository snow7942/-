<?php
session_start();
$conn = new mysqli('localhost', 'swu25', '0717', 'sample');
$id = $_GET['id'];
$conn->query("UPDATE board SET hits = hits + 1 WHERE id = $id");
$result = $conn->query("SELECT * FROM board WHERE id = $id");
$row = $result->fetch_assoc();

$likes_result = $conn->query("SELECT COUNT(*) AS cnt FROM board_likes WHERE board_id = $id");
$like_count = $likes_result->fetch_assoc()['cnt'];
?>
<!DOCTYPE html>
<html lang="ko-KR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>글 보기</title>
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
            max-width: 700px;
            margin: 80px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }
        h2 {
            text-align: center;
            color: #608670;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px 16px;
            border-bottom: 1px solid #ddd;
            vertical-align: top;
        }
        th {
            width: 100px;
            background-color: #e5ece8;
            color: #333;
            text-align: left;
            font-weight: bold;
        }
        .btn-group {
            text-align: center;
            margin-top: 30px;
        }
        .btn-group a {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 5px;
            background-color: #608670;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-group a:hover {
            background-color: #4d695c;
        }
        .btn-delete {
            background-color: #d9534f !important; 
        }
        .btn-delete:hover {
            background-color: #c9302c !important;
        }

        form button {
            background: none;
            border: 2px solid #ff3c3c;
            padding: 5px 15px;
            border-radius: 20px;
            color: #ff3c3c;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s;
        }
        form button:hover {
            background-color: #fff0f0;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h2><?= htmlspecialchars($row['title']) ?></h2>
        <table>
            <tr><th>글쓴이</th><td><?= htmlspecialchars($row['userid']) ?></td></tr>
            <tr><th>등록일</th><td><?= $row['created_at'] ?></td></tr>
            <tr><th>조회수</th><td><?= $row['hits'] ?></td></tr>
            <tr><th>내용</th><td><?= nl2br(htmlspecialchars($row['content'])) ?></td></tr>
        </table>

        <form method="post" action="12-board_like.php">
            <input type="hidden" name="board_id" value="<?= $id ?>">
            <div style="text-align:center;">
                <button type="submit">❤️ 공감하기 (<?= $like_count ?>)</button>
            </div>
        </form>

        <div class="btn-group">
            <a href='12-board_list.php'>← 목록으로</a>
            
            <?php 
            if (isset($_SESSION['userid']) && $_SESSION['userid'] == $row['userid']) { 
            ?>
                <a href='12-board_delete.php?id=<?= $id ?>' class="btn-delete" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
            <?php } ?>
        </div>
    </div>
  </body>
</html>