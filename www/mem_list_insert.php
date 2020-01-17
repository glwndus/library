<?php
include "common.php";

if($_SESSION['userlv'] <8 ){
    warning("잘못된 접근입니다.","index.php");
}

$memno = $_POST['memno'];
$memlv = $_POST['memlv'];

mysqli_query($conn, "UPDATE L_member SET userlv=$memlv WHERE user_no=$memno;");
warning("회원정보가 수정되었습니다.",-1);

?>