<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ko-KR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>나만의 CGV - 홈</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700;800&display=swap');

        body {
            font-family: 'Nanum+Myeongjo', serif;
            background-color: #f0f7f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 60px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            text-align: center;
        }
        
        h2 {
            color: #608670;
            margin-bottom: 20px;
            font-size: 48px; 
            font-weight: 800; 
            letter-spacing: -2px;
        }
        
        p {
            color: #666;
            margin-bottom: 40px;
            font-size: 17px; 
        }
        .menu-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .menu-item {
            display: block;
            background-color: #eeeeee;
            padding: 18px;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: 0.3s;
            font-size: 17px; 
        }
        .menu-item:hover {
            background-color: #e5ece8;
            color: #608670;
        }
        .menu-icon {
            display: block;
            font-size: 25px; 
            margin-bottom: 10px;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 30px;
            color: #888;
            text-decoration: underline;
            font-size: 14px;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h2>Welcome to CGV</h2>
        
        <?php if(isset($_SESSION['userid'])): ?>
            <p><strong><?= $_SESSION['name'] ?></strong>님, 안녕하세요!</p>
            
            <div class="menu-grid">
                <a href="movie_reserve.php" class="menu-item">
                    <span class="menu-icon">🎬</span>영화 예매
                </a>
                <a href="12-board_list.php" class="menu-item">
                    <span class="menu-icon">📝</span>한줄평 게시판
                </a>
                <a href="11w-251121-pj-member_list.php" class="menu-item">
                    <span class="menu-icon">👥</span>회원 목록
                </a>
                
                <a href="13-coupon_mine.php" class="menu-item">
                    <span class="menu-icon">🎟️</span>내 쿠폰함
                </a>
            </div>
            
            <a href="logout.php" class="logout-btn">로그아웃</a>

        <?php else: ?>
            <p>로그인 후 서비스를 이용해 주세요.</p>
            
            <div class="menu-grid">
                <a href="login.php" class="menu-item">
                    <span class="menu-icon">🔑</span>로그인
                </a>
                <a href="11w-251121-pj.php" class="menu-item">
                    <span class="menu-icon">👤</span>회원가입
                </a>
                <a href="13-coupon_list.php" class="menu-item">
                    <span class="menu-icon">🎁</span>진행중인 이벤트
                </a>
                <a href="12-board_list.php" class="menu-item">
                    <span class="menu-icon">📝</span>게시판 구경하기
                </a>
            </div>
        <?php endif; ?>
    </div>
  </body>
</html>