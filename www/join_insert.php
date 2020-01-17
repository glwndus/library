<?php
include "common.php";

$userid = addslashes($_POST['userid']);
$userpw = $_POST['userpw'];
$userpw = password_hash($userpw, PASSWORD_DEFAULT, ['cost' => 10 ]);
$username = addslashes($_POST['username']);
$phone = $_POST['phone'];
$RRN = $_POST['RRN'];
$address = $_POST['address'];
$date = date("Y-m-d");

mysqli_query($conn, "INSERT INTO L_member (userid, userpw, username, RRN, phone, address, date, userlv ) 
                                VALUES ('$userid', '$userpw', '$username', '$RRN', '$phone', '$address', '$date', 1);") or die("데이터입력 오류");
warning("회원가입이 완료되었습니다. 로그인해 주세요.",'index.php');
?>