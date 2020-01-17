<?php
include "header.php";

$no = $_GET['no'];

if($no == ""){
    $no = $_POST['delno'];
    if($no == ""){
        warning("잘못된 접근입니다.",-1);
    }
}
$data = mysqli_query($conn, "SELECT * FROM L_book WHERE book_no=$no;");
$row = mysqli_fetch_assoc($data);

?>

<div class="card border-primary">
    <div class="card-header">
        신규도서등록
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
        <form id="form2" action="modify_insert.php" method="post">
            <label>
                제목
                <input name="title" id="title" type="text" class="form-control" value="<?php echo $row['title']; ?>"/>
            </label>
            <label>
                저자
                <input name="autor" id="autor" type="text" class="form-control" value="<?php echo $row['autor']; ?>"/>
            </label>
            <label>
                출판사
                <input name="publisher" id="publisher" type="text" class="form-control" value="<?php echo $row['publisher']; ?>"/>
            </label>
            <label>
                출판일
                <small>YYYY-mm-dd</small>
                <input id="public_date" name="public_date" type="text" class="form-control" value="<?php echo $row['public_date']; ?>"/>
            </label>
            <label>
                분류
                <input name="division" id="division" type="text" class="form-control" value="<?php echo $row['division']; ?>"/>
            </label>
            <label>
                IBSN
                <input id="isbn" name="isbn" type="text" class="form-control" value="<?php echo $row['isbn']; ?>"/>
            </label>
            <label>
                서고위치
                <input id="location" name="location" type="text" class="form-control" value="<?php echo $row['location']; ?>"/>
            </label>
            <hr>
            <div class="text-center">
                <button type="button" id="submit2" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        
        $("#submit2").click(function(){
            var a1 = $("#title").val().length;
            var a2 = $("#autor").val().length;
            var a3 = $("#publisher").val().length;
            var a4 = $("#public_date").val().length;
            var a5 = $("#division").val().length;
            var a8 = $("#isbn").val().length;
            var a0 = $("#location").val().length;
            var result = a1*a2*a3*a4*a5*a8*a0;
            if(result == 0){
                alert("필수 입력칸을 채워주세요.");
            }else{
                $("#form2").submit();                        
            }           
            
        });       

    });

</script>