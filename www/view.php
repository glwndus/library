<?php
include "header.php";

$no=$_GET['no'];

$data = mysqli_query($conn, "SELECT * FROM L_book WHERE book_no=$no;");
$row = mysqli_fetch_assoc($data);

?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h4><?php echo $row['title'];?></h4>
            </div>
            <div class="col-4" text-right>
                <?php 
                if($row['limituse'] == 1){
                        echo "<p class='text-danger'>이용제한</p>";
                    }
                    if($row['rental'] == 0){
                        echo "<br />";
                        echo "<p class='text-primary'>대여가능</p>";
                    }else {
                        echo "<p class='text-danger'>대여중</p>";
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="card-body">
        
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td>저자</td>
                    <td><?php echo $row['autor']; ?></td>
                </tr>
                <tr>
                    <td>출판사</td>
                    <td><?php echo $row['publisher']; ?></td>
                </tr>
                <tr>
                    <td>출판일</td>
                    <td><?php echo $row['public_date']; ?></td>
                </tr>
                <tr>
                    <td>ISBN</td>
                    <td><?php echo $row['isbn']; ?></td>
                </tr>
                <tr>
                    <td>등록일</td>
                    <td><?php echo $row['regist_date']; ?></td>
                </tr>
                <tr>
                    <td>서고위치</td>
                    <td><?php echo $row['location']; ?></td>
                </tr>
                <tr>
                    <td>누적대여수</td>
                    <td><?php echo $row['book_accum']; ?></td>
                </tr>
            </tbody>
        </table>
        
        <hr/>
        <?php
        $prevpost = mysqli_query($conn, "SELECT * FROM L_book WHERE book_no<{$row['book_no']} ORDER BY book_no DESC LIMIT 1");
        $prevrow = mysqli_fetch_assoc($prevpost);
        $nextpost = mysqli_query($conn, "SELECT * FROM L_book WHERE book_no>{$row['book_no']} ORDER BY book_no ASC LIMIT 1");
        $nextrow = mysqli_fetch_assoc($nextpost);        
        ?>
        <div class="row">
                <?php
                if($prevrow['book_no']!=""){
                    echo "<a class='col-6' href='view.php?no={$prevrow['book_no']}'>";
                    echo "<h5>Prev Post</h5>";
                    echo "<div>{$prevrow['title']}</div>";
                    echo "</a>";
                }else{
                    echo "<a class='col-6'>";
                    echo "<h5>&nbsp</h5>";
                    echo "<div>&nbsp</div>";
                    echo "</a>";
                }
                if($nextrow['book_no']!=""){
                    echo "<a class='col-6 text-right $nextsec' href='view.php?no={$nextrow['book_no']}'>";
                    echo "<h5>next Post</h5>";
                    echo "<div>{$nextrow['title']}</div>";
                    echo "</a>";
                }else{
                    echo "<a class='col-6'>";
                    echo "<h5>&nbsp</h5>";
                    echo "<div>&nbsp</div>";
                    echo "</a>";
                }
                ?>
        </div>
    </div>
    
    <div class="card-footer">
        <div class="row">
        <div class="col-6">
            <?php
            //지금 보고있는 이 게시물이 몇번째 게시물인가?
            //유의사항:몇번째 게시물인가 이지 몇번 게시물인가가 아니다.
            $nth = mysqli_query($conn,"SELECT book_no FROM L_book WHERE book_no>{$row['book_no']};");
            $nth = mysqli_num_rows($nth);
            $newpage = "book_list.php?page=".floor($nth / $postlen);
            ?>
            <a href="<?php echo $newpage; ?>" class="btn btn-primary">List</a>
        </div>
        <div class="col-6 text-right">
            <?php
            $permit = false;
            if($_SESSION['userlv'] >= 8){
                echo "<a id='modbtn' href='modify.php?no={$row['book_no']}' class='btn btn-primary'>Modify</a>";
                echo "<a id='delbtn' href='delete.php?no={$row['book_no']}' class='btn btn-primary'>delete</a>";
            }
            ?>
            <form id="delform" action="delete.php" method="post">
                <input id="delbotable" name="delbotable" type="text" value="<?php echo L_book; ?>" hidden />
                <input id="delno" name="delno" type="text" value="<?php echo $no; ?>" hidden />
            </form>
            <script>
                $("#delbtn, #modbtn").click(function(e){
                    e.preventDefault();

                    var who;
                    var txt;
                    if($(this).attr("id") == "delbtn"){
                        who = "delete";
                        txt = "삭제";
                    }else{
                        who = "modify";
                        txt = "수정";
                    }                
                    $("#delform").attr("action",who+".php");

                    if(confirm("정말로 게시물을" + txt + "하시겠습니까?")){
                        location.href = $(this).attr("href");    
                    }
                });
            </script>
        </div>
    </div>
</div>

    
</div>

<?php
include "footer.php";
?>
