<?php
include "header.php";
$memdata = mysqli_query($conn, "SELECT * FROM L_member WHERE userid='{$_SESSION['id']}';");
$memrow = mysqli_fetch_assoc($memdata);
?>

<div id="userinfo" class="card">
    <h5 class="card-header">내 정보</h5>
    <div class="card-body">                                           
        <h5 class="card-title"><?php echo $memrow['username'];?></h5>
        <p class="card-text"><?php echo $memrow['userid'];?></p>
        <a href="mem_modify.php" class="btn btn-primary">내 정보 수정</a>
        <hr/>
        <?php
            if($memrow['userlv'] >= 8){
                echo "<a href='mem_list.php' class='btn btn-primary'>회원정보조회</a>";
                echo "<a href='regist.php' class='btn btn-primary'>신규도서등록</a>";
                echo "<a href='rental.php' class='btn btn-primary'>대여 / 반납</a>";
                echo "<hr />";
            }
        ?>
        <p class="card-text">현재 대여수 : <?php echo $memrow['user_rent'];?> / 5</p>        
        <p class="card-text">누적 대여수 : <?php echo $memrow['user_accum'];?> </p>
        <?php
            if($memrow['user_rent'] >= 5 || $memrow['Delinquent'] == 1){
                echo"<span class='card-text text-muted'><small>대여 불가능</small></span>";
            }else {
                echo"<span class='card-text text-muted'><small>대여 가능</small></span>";                
            }
            if($memrow['Delinquent'] == 1){
                echo"<span class='card-text text-danger'><small> 연체중</small></span>";
            }
        ?>
    </div>    
</div>

<div id="login" class="card border-primary mb-3" >
    <form id="logform" action="login_insert.php" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="text" class="form-control" id="logid" name="logid"/>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="logpw" name="logpw" />
        </div>
        <button id="logsubmit" type="button" class="btn btn-primary">Login</button>
        <a href="join.php" class="btn btn-primary">Join</a>
    </form>
</div>

<script>
    $("#logsubmit").click(function(){
        var l1 = $("#logid").val().length;
        var l2 = $("#logpw").val().length;
        var result = l1*l2;
        if(result == 0){
            alert("아이디와 비밀번호를 확인해 주세요.");
        }else{
            $("#logform").submit();
        }
    });
    
    $("#logpw").keydown(function(e){
        var key = e.keyCode;
        if(key==13){
            $("#logsubmit").trigger("click");
        }
    });    
</script>

<?php

if($_SESSION['log']){
    echo "<script>$('#login').hide();</script>";    
}else{
    echo "<script>$('#userinfo').hide();</script>";        
}

include "footer.php";
?>