<?php
include "header.php";
if($_SESSION['userlv'] < 8){
    warning("잘못된 접근입니다.","index.php");
}

$memdata = mysqli_query($conn, "SELECT * FROM L_member WHERE userid='{$_SESSION['id']}';");
$memrow = mysqli_fetch_assoc($memdata);
?>


<div class="card border-primary">
    <div class="card-header">
        대여 / 반납
    </div>
    <div class="card-body">
        <style>
            form label {
                display: block;
                width: 100%;
                max-width: 700px;
                margin: auto;
                margin-top: 1em;
            }
        </style>
        <form id="form4" action="rental_insert.php" method="post">
            <label>
                회원ID
                <input name="userid" id="userid" type="text" class="form-control" />
            </label>
            <label>
                책ID
                <input name="bookid" id="bookid" type="text" class="form-control" />
            </label>
            <hr>
            <div class="text-center">
                <button type="button" id="submit4" class="btn btn-primary">대여</button>
                <button type="reset" class="btn btn-secondary">초기화</button>
                <button type="button" id="submit5" class="btn btn-warning">반납</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        
        $("#submit4").click(function(){
            var a1 = $("#userid").val().length;
            var a2 = $("#bookid").val().length;
            var result = a1*a2;
            if(result == 0){
                alert("필수 입력칸을 채워주세요.");
            }else{
                $("#form4").submit();  
            }           
        });
        
        $("#submit5").click(function(){
            var a1 = $("#userid").val().length;
            var a2 = $("#bookid").val().length;
            var result = a1*a2;
            if(result == 0){
                alert("필수 입력칸을 채워주세요.");
            }else{
                $("#form4").submit();  
            }           
        });
        
    });
</script>