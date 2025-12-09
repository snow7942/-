<?php
session_start();
$conn = new mysqli("localhost", "swu25", "0717", "sample");

$userid = $_POST['userid'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT password, name FROM cgvtable WHERE userid = ?");
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['userid'] = $userid;
        $_SESSION['name'] = $row['name'];
        echo "<script>location.href='index.php';</script>";
    } else {
        echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>";
    }
} else {
    echo "<script>alert('존재하지 않는 아이디입니다.'); history.back();</script>";
}
?>