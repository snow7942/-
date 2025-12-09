<?php
$conn = new mysqli("localhost", "swu25", "0717", "sample");

if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}

$userid = $_GET["userid"] ?? '';

if (empty($userid)) {
    echo "ID를 입력해 주세요.";
    $conn->close();
    exit;
}

$sql = "SELECT userid FROM cgvtable WHERE userid = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "쿼리 준비 실패: " . $conn->error;
    $conn->close();
    exit;
}

$stmt->bind_param("s", $userid);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "이미 사용 중인 ID입니다.";
} else {
    echo "사용 가능한 ID입니다.";
}

$stmt->close();
$conn->close();
?>