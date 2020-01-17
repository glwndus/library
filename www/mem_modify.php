<?php
include "header.php";

if(!isset($_SESSION['log'])){
    warning("로그인이 필요한 서비스 입니다.","login.php");
}

$memdata = mysqli_query($conn, "SELECT * FROM L_member WHERE userid='{$_SESSION['id']}';");
$memrow = mysqli_fetch_assoc($memdata);
?>


<div class="card border-primary">
    <div class="card-header">
        내 정보 수정
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
        <form id="form3" action="mem_modify_insert.php" method="post">
            <label>
                ID
                <input name="userid" id="userid" type="text" class="form-control" value="<?php echo $memrow['userid'];?>" readonly />
            </label>
            <label>
                Password
                <input name="userpw" id="userpw" type="password" class="form-control" />
            </label>
            <label>
                비밀번호확인
                <input name="cpw" id="cpw" type="password" class="form-control" />
            </label>
            <hr>
            <label>
                성명
                <input name="username" id="username" type="text" class="form-control" value="<?php echo $memrow['username'];?>" disabled/>
            </label>
            <label>
                전화번호
                <p><small>-제외하여 입력해 주세요.</small></p>
                <input id="phone" name="phone" type="text" class="form-control" />
            </label>
            <label>
                주민등록번호
                <p><small>-제외하여 입력해 주세요.</small></p>
                <input name="RRN" id="RRN" type="text" class="form-control" />
            </label>
            <label>
                주소
                <input id="address" name="address" type="text" class="form-control" />
            </label>
            <hr>
            <div class="text-center">
                <button type="button" id="submit3" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        var chk = false;
        
        $("#submit3").click(function(){
            var a1 = $("#userid").val().length;
            var a2 = $("#userpw").val().length;
            var a3 = $("#cpw").val().length;
            var a4 = $("#username").val().length;
            var a5 = $("#phone").val().length;
            var a8 = $("#RRN").val().length;
            var a0 = $("#address").val().length;
            var result = a1*a2*a3*a4*a5*a8*a0;
            if(result == 0){
                alert("필수 입력칸을 채워주세요.");
            }else{
                if($("#userpw").val() == $("#cpw").val()){
                        $("#form3").submit();  
                }else{
                    alert("비밀번호를 확인해 주세요.");
                }
            }           
            
        });    
    

        
});
</script>