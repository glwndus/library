<?php
header("Content-Type:text/html; charset=utf-8;");
$conn = mysqli_connect("localhost", "kimpitang01", "dkssud24!") or die("sql접속이 실패했습니다.");
$select = mysqli_select_db($conn,"kimpitang01") or die("db선택에 실패했습니다.");
mysqli_query($conn, "SET SESSION CHARACTER_SET_CONNECTION=utf8");
mysqli_query($conn, "SET SESSION CHARACTER_SET_RESULTS=utf8");
mysqli_query($conn, "SET SESSION CHARACTER_SET_CLIENT=utf8");

session_start();

if(!isset($_SESSION['log'])){    
    $_SESSION['log'] = false;
    $_SESSION['id'] = "";
    $_SESSION['userlv'] = 0;
}

function warning($message, $move){
    echo "<script>";
    echo "alert('$message');";
    if(is_numeric($move)){
        //숫자라면
        echo "history.go($move);";
    }else{
        //숫자가 아니라면
        echo "location.href='$move';";
    }
    echo "</script>";
    exit;
}

//한페이지 당 보여줄 게시물 갯수
$postlen = 1;

//한블록당 넣을 페이지 번호의 갯수
$pbtnlen = 5;



?>











