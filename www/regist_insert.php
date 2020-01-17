<?php
include "common.php";

$title = $_POST['title'];
$autor = $_POST['autor'];
$publisher = $_POST['publisher'];
$public_date = $_POST['public_date'];
$division = $_POST['division'];
$isbn = $_POST['isbn'];
$location = $_POST['location'];
$regist_date = date("Y-m-d");

mysqli_query($conn, "INSERT INTO L_book (title, autor, publisher, public_date, division, isbn, location, regist_date) 
                                VALUES ('$title', '$autor', '$publisher', '$public_date','$division', '$isbn', '$location','$regist_date');") or die("데이터입력 오류");
warning("도서등록이 완료되었습니다.",'regist.php');
?>