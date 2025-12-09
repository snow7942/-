<?php 
session_start(); 
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko-KR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>글쓰기</title>
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
            max-width: 600px;
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
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #4d695c;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #eeeeee;
            color: #333;
            font-size: 16px;
            box-sizing: border-box;
        }
        .btn-group {
            display: flex;
            gap: 10px;
        }
        .submit-btn, .cancel-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            box-sizing: border-box;
        }
        .submit-btn {
            background-color: #608670;
            color: #fff;
            flex: 2;
        }
        .submit-btn:hover { background-color: #4d695c; }
        
        .cancel-btn {
            background-color: #ccc;
            color: #fff;
            flex: 1;
        }
        .cancel-btn:hover { background-color: #999; }
    </style>
  </head>
  <body>
    <div class="container">
        <h2>글쓰기</h2>
        <form method="post" action="12-board_save.php">
            <label for="title">제목</label>
            <input type="text" id="title" name="title" required>
            
            <label for="content">내용</label>
            <textarea id="content" name="content" rows="10" required></textarea>

            <div class="btn-group">
                <a href="12-board_list.php" class="cancel-btn">취소</a>
                <input type="submit" value="저장" class="submit-btn">
            </div>
        </form>
    </div>
  </body>
</html>