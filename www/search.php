<?php
include "header.php";

$searchtxt = txtini($_GET['searchtxt']);
$searchtype = $_GET['searchtype'];

if($searchtxt == "" || $searchtype == ""){
    warning("잘못된 접근입니다.","index.php");
}

//보고있는 페이지 번호
$page = $_GET['page'];
if($page == ""){
    $page = 0;
}

if($searchtype == 0){
    $data = mysqli_query($conn, "SELECT * FROM L_book WHERE title LIKE '%$searchtxt%' OR content LIKE '%$searchtxt%'; ");
}else if($searchtype == 1){
    $data = mysqli_query($conn, "SELECT * FROM L_book WHERE writerid LIKE '%$searchtxt%' OR writername LIKE '%$searchtxt%'; ");    
}

$len = mysqli_num_rows($data);

if($len == 0){
    warning("검색 결과가 없습니다.", -1);
}

$pagelen = ceil($len / $postlen);
$blocklen = ceil($pagelen/$pbtnlen);
$firstpostno = $postlen * $page;
$blockno = floor($page/$pbtnlen);
$firstbtnno = $blockno*$pbtnlen;

$aaa = $page +1;
    echo "총 $len 건 | 현재 페이지 / $aaa/$pagelen";
?>

<form id="search" action="search.php" method="get" class="input-group" style="max-width:400px; float:right;">
    <input type="text" name="botable" value="<?php echo $botable; ?>" hidden />
    <div class="input-group-prepend">
        <select id="searchtype" class="" name="searchtype">
            <option value="0">제목+내용</option>
            <option value="1">작성자</option>
        </select>
    </div>
    <input id="searchtxt" list="top5" class="form-control" type="text" name="searchtxt" placeholder="검색어를 입력하세요">
    <datalist id="top5">
        <?php
        $top5 = mysqli_query($conn, "SELECT keyword FROM top ORDER BY count DESC LIMIT 5");
        for($j=0; $j<5; $j++){
            $krow = mysqli_fetch_assoc($top5);
            echo "<option value='{$krow['keyword']}' />";
        }
        ?>
    </datalist>
    <div class="input-group-append">
        <button id="searchbtn" class="btn btn-outline-secondary" type="button">Search</button>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>제목</th>
            <th>저자</th>
            <th>출판사</th>
            <th>출판일</th>
            <th>분류</th>
            <th>서고위치</th>
            <th>이용제한여부</th>
            <th>대여중여부</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $data2 = mysqli_query($conn, "SELECT * FROM L_book ORDER BY book_no DESC LIMIT $firstpostno, $postlen;");
            for($i=0; $i<$postlen; $i++){
                $row = mysqli_fetch_array($data2);
                if($row['book_no']!=""){                    
                    echo "<tr>";
                    echo "<td>{$row['book_no']}</td>";
                    echo "<td><a href='view.php?no={$row['book_no']}'>{$row['title']}</a></td>";
                    echo "<td>{$row['autor']}</td>";
                    echo "<td>{$row['publisher']}</td>";
                    echo "<td>{$row['public_date']}</td>";
                    echo "<td>{$row['division']}</td>";
                    echo "<td>{$row['location']}</td>";
                    if($row['limituse'] == 0){
                        echo "<td></td>";
                    }else {
                        echo "<td class='text-danger'>이용제한</td>";
                    }
                    if($row['rental'] == 0){
                        echo "<td class='text-primary'>대여가능</td>";
                    }else {
                        echo "<td class='text-danger'>대여중</td>";
                    }
                    echo "</tr>";
                }

            }
        ?>
        
        <tr>
            <td colspan="9">
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
</table>

<?php
include "footer.php";
?>











