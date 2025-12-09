<!DOCTYPE html>
<html lang="ko-KR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>로그인</title>
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
            max-width: 400px;
            margin: 100px auto;
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
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: none;
            border-radius: 6px;
            background-color: #eeeeee;
            color: #333;
            box-sizing: border-box;
        }
        .submit-btn {
            width: 100%;
            background-color: #608670;
            color: #fff;
            padding: 14px;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        .submit-btn:hover {
            background-color: #4d695c;
        }
        .links {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .links a {
            color: #666;
            text-decoration: none;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h2>로그인</h2>
        <form action="login_process.php" method="post">
            <input type="text" name="userid" placeholder="아이디" required>
            <input type="password" name="password" placeholder="비밀번호" required>
            <input type="submit" value="로그인" class="submit-btn">
        </form>
        <div class="links">
            <a href="11w-251121-pj.php">회원가입</a> | <a href="index.php">홈으로</a>
        </div>
    </div>
  </body>
</html>