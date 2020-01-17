<?php
include "common.php";
$userid = $_POST['userid'];

if($userid != $_SESSION['id']){
    warning("잘못된 접근 입니다.","index.php");
}

$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$userpw = password_hash($userpw, PASSWORD_DEFAULT, ['cost' => 10 ]);
$phone = $_POST['phone'];
$RRN = $_POST['RRN'];
$address = $_POST['address'];

if(!empty($userpw)){
    $userpw = password_hash($userpw, PASSWORD_DEFAULT, ['cost' => 10 ]);
    mysqli_query($conn, "UPDATE L_member SET userpw='$userpw' WHERE userid='$userid';") or die("데이터입력 오류");
}

mysqli_query($conn,"UPDATE L_member SET phone='$phone',RRN='$RRN', address='$address' WHERE userid='$userid';") or die("데이터입력 오류");
warning("회원정보수정이 완료되었습니다.",'index.php');

?>