<?php
session_start();
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login.php';</script>";
    exit;
}

$conn = new mysqli("localhost", "swu25", "0717", "sample");
$userid = $_SESSION['userid'];

$result = $conn->query("SELECT is_univ, is_swu FROM cgvtable WHERE userid = '$userid'");
$user = $result->fetch_assoc();

$discount_percent = 0;
if ($user['is_univ']) $discount_percent += 10;
if ($user['is_swu']) $discount_percent += 10;

$today = date('Y-m-d');

$coupon_sql = "SELECT * FROM couponbox 
               WHERE userid = '$userid' 
               AND is_used = 0 
               AND expiration_date >= '$today'
               AND title NOT LIKE '%팝콘%'";

$coupon_result = $conn->query($coupon_sql);
?>
<!DOCTYPE html>
<html lang="ko-KR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>영화 예매</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700&display=swap');
        body { font-family: 'Nanum+Myeongjo', serif; background-color: #f0f7f4; color: #333; }
        .container { max-width: 600px; margin: 60px auto; padding: 40px; background-color: #ffffff; border-radius: 12px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.05); }
        h2 { text-align: center; color: #608670; margin-bottom: 30px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #4d695c; }
        select, input[type="text"] { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 6px; background-color: #eeeeee; color: #333; font-size: 16px; box-sizing: border-box; }
        .info-box { background-color: #e5ece8; padding: 15px; border-radius: 6px; margin-bottom: 20px; text-align: center; line-height: 1.6; }
        .submit-btn { width: 100%; background-color: #608670; color: #fff; padding: 14px; border: none; border-radius: 6px; font-size: 18px; font-weight: bold; cursor: pointer; }
        .submit-btn:hover { background-color: #4d695c; }
        .back-link { display: block; text-align: center; margin-top: 20px; color: #666; text-decoration: none; }
    </style>
    <script>
        function calculatePrice() {
            const baseMoviePrice = 15000;
            const popcornPrice = 10000; 
            const discountPercent = <?= $discount_percent ?>; 

            const showtimeSelect = document.querySelector('select[name="showtime"]');
            const couponSelect = document.getElementById('coupon_id');
            const displayPrice = document.getElementById('display_price');
            const totalPriceInput = document.getElementById('total_price');

            const showtime = showtimeSelect.value;
            const selectedOption = couponSelect.options[couponSelect.selectedIndex];
            
            const couponTitle = selectedOption.getAttribute('data-title') || "";
            const couponAmount = parseInt(selectedOption.getAttribute('data-amount')) || 0;
            
            let finalPrice = 0;

            if (couponTitle.includes("무료")) { finalPrice = 0; } 
            else if (couponTitle.includes("팝콘")) { finalPrice = popcornPrice * 0.5; }
            else {
                let memberDiscount = baseMoviePrice * (discountPercent / 100);
                let timeDiscount = 0;
                if (showtime === "09:00" || showtime === "22:00") { timeDiscount = 3000; }
                finalPrice = baseMoviePrice - memberDiscount - timeDiscount - couponAmount;
                finalPrice = Math.max(0, finalPrice);
            }
            finalPrice = Math.floor(finalPrice);
            displayPrice.value = finalPrice.toLocaleString() + "원";
            totalPriceInput.value = finalPrice;
        }
    </script>
</head>
<body onload="calculatePrice()">
    <div class="container">
        <h2>영화 예매</h2>
        <div class="info-box">
            <strong><?= $_SESSION['name'] ?></strong>님의 기본 할인율: <strong><?= $discount_percent ?>%</strong><br>(대학생 10% + 서울여대 10%)
        </div>
        <form action="movie_reserve_process.php" method="post">
            <input type="hidden" name="total_price" id="total_price" value="">

            <label>영화 선택</label>
            <select name="movie_title" required>
                <option value="">영화를 선택하세요</option>
                <option value="라라랜드">라라랜드</option>
                <option value="셜록: 유령신부">셜록: 유령신부</option>
                <option value="이터널 선샤인">이터널 선샤인</option>
            </select>

            <label>상영 시간 (조조/심야 3,000원 할인)</label>
            <select name="showtime" required onchange="calculatePrice()">
                <option value="09:00">09:00 (조조)</option>
                <option value="13:30">13:30</option>
                <option value="19:00">19:00</option>
                <option value="22:00">24:00 (심야)</option>
            </select>
            
            <label>쿠폰 할인</label>
            <select name="coupon_id" id="coupon_id" onchange="calculatePrice()">
                <option value="" data-amount="0" data-title="">쿠폰을 선택하지 않음</option>
                <?php while($coupon = $coupon_result->fetch_assoc()) { ?>
                    <option value="<?= $coupon['id'] ?>" data-title="<?= htmlspecialchars($coupon['title']) ?>" data-amount="5000">
                        <?= htmlspecialchars($coupon['title']) ?> (만료: <?= $coupon['expiration_date'] ?>)
                    </option>
                <?php } ?>
            </select>

            <label>인원 (현재 1명 고정)</label>
            <input type="text" name="people_count" value="1" readonly>
            <label>결제 예정 금액</label>
            <input type="text" id="display_price" readonly style="color: #ff3c3c; font-weight: bold;">
            <input type="submit" value="예매하기" class="submit-btn">
        </form>
        <a href="index.php" class="back-link">← 홈으로 돌아가기</a>
    </div>
</body>
</html>