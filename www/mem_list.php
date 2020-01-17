<?php
include "header.php";

if($_SESSION['userlv'] < 8){
    warning("잘못된 접근입니다.","index.php");
}

//보고있는 페이지 번호
$page = $_GET['page'];
if($page == ""){
    $page = 0;
}

$data = mysqli_query($conn, "SELECT user_no FROM L_member ORDER BY user_no DESC;");
$len = mysqli_num_rows($data);
$pagelen = ceil($len / $postlen);
$blocklen = ceil($pagelen/$pbtnlen);
$firstpostno = $postlen * $page;
$blockno = floor($page/$pbtnlen);
$firstbtnno = $blockno*$pbtnlen;
?>

<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>ID</th>
            <th>이름</th>
            <th>주민등록번호</th>
            <th>전화번호</th>
            <th>주소</th>
            <th>현재대여수</th>
            <th>누적대여수</th>
            <th>연체여부</th>
            <th>가입일</th>
            <th>회원등급</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $data2 = mysqli_query($conn, "SELECT * FROM L_member ORDER BY user_no DESC LIMIT $firstpostno, $postlen;");
            for($i=0; $i<$postlen; $i++){
                $row = mysqli_fetch_array($data2);
                if($row['user_no']!=""){                    
                    echo "<tr>";
                    echo "<td>{$row['user_no']}</td>";
                    echo "<td>{$row['userid']}</td>";
                    echo "<td>{$row['username']}</td>";
                    echo "<td>{$row['RRN']}</td>";
                    echo "<td>{$row['phone']}</td>";
                    echo "<td>{$row['address']}</td>";
                    echo "<td>{$row['user_rent']}</td>";
                    echo "<td>{$row['user_accum']}</td>";
                    if($row['Delinquent'] == 0){
                        echo "<td></td>";
                    }else {
                        echo "<td class='text-danger'>연체중</td>";
                    }
                    echo "<td>{$row['date']}</td>";
                    echo "<td>";
                    echo "<select class='lvsel' data='{$row['userlv']}'>";
                        for($k=0; $k<9; $k++){
                            $num = $k+1;
                            if($row['userlv']==$num){
                                echo "<option selected disabled value='$num'>$num</option>";
                            }else {
                                echo "<option value='$num'>$num</option>";
                            }
                        }
                    echo "</select>";
                    echo "</td>";
                    echo "</tr>";
                }

            }
        ?>
        
        <tr>
            <td colspan="11">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                        $prevdisabled="";
                        $prevurl="";
                        if($blockno - 1 <0){
                            $prevdisabled="disabled";
                        }else{
                            $prevno = $firstbtnno -1;
                            $prevurl = "?page=".$prevno;
                        }
                        
                        $nextdisabled="";
                        $nexturl="";
                        if($blockno >= $blocklen -1){
                            $nextdisabled="disabled";
                        }else{
                            $nextno = $firstbtnno + $pbtnlen;
                            $nexturl = "?page=".$nextno;
                        }
                        ?>
                        
                        <li class="page-item <?php echo $prevdisabled; ?>">
                            <a class="page-link" href="<?php echo $prevurl; ?>">&laquo;</a>
                        </li>
                        
                        <?php
                            for($j=0; $j<$pbtnlen; $j++){
                                $btnno = $firstbtnno + $j + 1;
                                if($btnno <= $pagelen){
                                    $active = "";
                                    if($page+1 == $btnno){
                                        $active = "active";
                                    }
                                    $pageurl = "?page=".($btnno-1);
                                    echo "<li class='page-item $active'><a class='page-link' href='$pageurl'>$btnno</a></li>";
                                }
                            }
                        ?>
                        <li class="page-item <?php echo $nextdisabled; ?>">
                            <a class="page-link" href="<?php echo $nexturl; ?>">&raquo;</a>
                        </li>
                    </ul>
                </nav>
            </td>
        </tr>
    </tbody>
    <form id="levelform" action="mem_list_insert.php" method="post">
        <input type="text" id="memno" name="memno" hidden />
        <input type="text" id="memlv" name="memlv" hidden />
    </form>
    <script>
        $(".lvsel").change(function(){
            if(confirm("정말로 수정하시겠습니까?")){
                var memno = $(this).parent().parent().children().eq(0).text();
                var memlv = $(this).val();
                $("#memno").attr("value",memno);
                $("#memlv").attr("value",memlv);
                $("#levelform").submit();
            }else{
                var origin = $(this).attr("data");
                $(this).children("option").removeAttr("selected");
                $(this).children("option").eq(origin-1).attr("selected","true");
            }
        });
    </script>
</table>

<?php
include "footer.php";
?>











