<?php
include "common.php";

$no = $_POST['no'];



mysqli_query($conn, "UPDATE L_book SET title='$title', autor='$autor', publisher='$publisher', public_date='$public_date', division='$division', isbn='$isbn', location='$location' WHERE book_no=$no; ");
warning("게시물이 수정되었습니다.",-2);
?>