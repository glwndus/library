<?php
include "header.php";
?>

<div class="card border-primary">
    <div class="card-header">
        Join
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
        <form id="form1" action="join_insert.php" method="post">
            <label>
                ID
                <span id="chkresult" class="badge badge-danger"></span>
                <input name="userid" id="userid" type="text" class="form-control" placeholder="input your id." />
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
                <input name="username" id="username" type="text" class="form-control" />
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
                <button type="button" id="submit1" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        var chk = false;
        
        $("#submit1").click(function(){
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
                    if(chk){
                        $("#form1").submit();                        
                    }else{
                        alert("아이디를 확인해 주세요.");
                    }
                }else{
                    alert("비밀번호를 확인해 주세요.");
                }
            }           
            
        });    
    
    $("#userid").keyup(function(){
        var key = $(this).val();
        $.ajax({
            method: "get",
            url:"chkid.php",
            data: "userid="+key,
            dataType: "html",
            success: function(result){
                if(result == 0){
                    $("#chkresult").text("사용할 수 있는 아이디입니다.");
                    $("#chkresult").removeClass("badge-danger");
                    $("#chkresult").addClass("badge-success");
                    chk = true;
                }else if(result == 1){
                    $("#chkresult").text("사용할 수 없는 아이디입니다.");
                    $("#chkresult").removeClass("badge-success");
                    $("#chkresult").addClass("badge-danger");
                    chk = false;
                }else if(result == "empty"){
                    $("#chkresult").text("아이디를 입력하세요.");
                    $("#chkresult").removeClass("badge-success");
                    $("#chkresult").addClass("badge-danger");                    
                    chk = false;
                }
            }
        });
    });
        
});
</script>