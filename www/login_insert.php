<?php
include "common.php";

$logid = $_POST['logid'];
$logpw = $_POST['logpw'];

$findid = mysqli_query($conn, "SELECT userid, userpw, userlv FROM L_member WHERE userid='$logid';");
$findidlen = mysqli_num_rows($findid);
if($findidlen==0){
    warning("아이디와 비밀번호를 확인해주세요.","index.php");
}else{
    $data = mysqli_fetch_array($findid);
    $hashpw = $data['userpw'];
    if(password_verify($logpw, $hashpw)){
        $_SESSION['log'] = true;
        $_SESSION['id'] = $data['userid'];
        $_SESSION['userlv'] = $data['userlv'];
        warning('로그인 완료',"index.php");
    }else{
        warning('아이디와 비밀번호를 확인해주세요.',"index.php");
    }
    
}

?>