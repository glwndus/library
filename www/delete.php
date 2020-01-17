<?php
include "common.php";

$no = $_GET['no'];

if($no == ""){
    $no = $_POST['delno'];
    if($no == ""){
        warning("잘못된 접근입니다.",-1);
    }
}

$data = mysqli_query($conn, "SELECT * FROM L_book WHERE book_no=$no;");
$row = mysqli_fetch_assoc($data);

mysqli_query($conn, "DELETE FROM L_book WHERE book_no=$no");

warning("게시물이 삭제되었습니다.",-2);












?>