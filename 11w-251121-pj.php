<!DOCTYPE html>
<html lang="ko-KR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>회원가입 - CGV 영화 예매</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700&display=swap');
        body {
            font-family: 'Nanum+Myeongjo', serif;
            background-color: #f0f7f4;
            color: #333333; 
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 480px;
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
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        .id-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .id-group input[type="text"] {
            margin-bottom: 0;
            flex-grow: 1; 
            margin-right: 10px;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 6px;
            background-color: #eeeeee; 
            color: #333; 
            box-sizing: border-box;
        }
        input[type="checkbox"] {
            margin-right: 6px;
        }
        .btn-check {
            background-color: #92a884; 
            color: #fff;
            border: none;
            padding: 10px 12px;
            border-radius: 6px;
            cursor: pointer;
            height: 40px;
            flex-shrink: 0;
        }
        .btn-check:hover { background-color: #7e9471; }

        .submit-btn {
            width: 100%;
            background-color: #4d695c; 
            color: #fff;
            padding: 14px;
            margin-top: 20px;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }
        .submit-btn:hover { background-color: #3a5348; }

        .home-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
        }

        .checkbox-group { margin-bottom: 20px; }
        .note { font-size: 13px; color: #888; display: block; margin-top: 5px; }
    </style>

    <script>
        function checkPasswordMatch() {
            const pw = document.getElementById("password").value;
            const pw2 = document.getElementById("password2").value;
            if (pw !== pw2) {
                alert("비밀번호가 일치하지 않습니다.");
                return false;
            }
            return true;
        }

        function checkDuplicate() {
            const userid = document.getElementById("userid").value;
            if (userid === "") {
                alert("ID를 입력하세요.");
                return;
            }
            fetch("11w-251121-pj-check_duplicate.php?userid=" + userid)
            .then(res => res.text())
            .then(msg => alert(msg))
            .catch(error => console.error('Error:', error));
        }

        function validateForm(event) {
            if (!checkPasswordMatch()) {
                event.preventDefault();
                return false;
            }
            return true;
        }
    </script>
  </head>
  <body>
    <div class="container">
        <h2>회원가입</h2>
        <form action = "11w-251121-pj-register_process.php" method="post" onsubmit="return validateForm(event);">
            <label for ="userid">ID</label>
            <div class="id-group">
                <input type = "text" name = "userid" id = "userid" required>
                <button type = "button" class = "btn-check" onclick="checkDuplicate()">중복 확인</button>
            </div>

            <label for = "name">이름</label>
            <input type = "text" name = "name" id = "name" required>

            <label for = "password">비밀번호</label>
            <input type = "password" name = "password" id = "password" required>

            <label for = "password2">비밀번호 확인</label>
            <input type = "password" name = "password2" id = "password2" required>

            <label for = "email">이메일</label>
            <input type = "email" name = "email" id = "email">

            <label for = "address">주소</label>
            <input type = "text" name="address" id="address">

            <div class="checkbox-group">
                <label>
                    <input type = "checkbox" name = "is_univ" value="yes">
                    대학생 할인 적용 (10%)
                </label><br>
                <label>
                    <input type = "checkbox" name="is_swu" value="yes">
                    서울여자대학교 학생 여부 (추가 할인 10%)
                </label>
                <small class = "note">* 총 할인율 최대 20% 적용 가능</small>
            </div>
            <input type = "submit" class = "submit-btn" value = "회원가입">
        </form>
        <a href="index.php" class="home-link">🏠 홈으로 돌아가기</a>
    </div>
  </body>
</html>