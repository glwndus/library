<?php
include "common.php";
?>
<!doctype HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="autor" content="Cho Arim" />
        <meta name="viewport" content="initial-scale=1, width=device-width" />
        <title>도서관 시스템</title>
        <link href="css/common.css" rel="stylesheet" />
        <script
          src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    <body>
        <header class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <a class="navbar-brand" href="index.php">도서관 시스템</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                  <div class="navbar-nav">
                    <a class="nav-item nav-link" href="book_list.php">도서정보</a>
                      <?php
                        if($_SESSION['log']){                            
                            echo"<a class='nav-item nav-link' href='index.php'>내정보</a>";
                            echo "<a class='nav-item nav-link' id='logout' href='#'>로그아웃({$_SESSION['id']})</a>";
                        }else{
                            echo"<a class='nav-item nav-link' href='index.php'>로그인</a>";                            
                        }
                        if($_SESSION['userlv'] >= 8){
                            echo"<a class='nav-item nav-link' href='index.php'>관리자페이지</a>";                            
                        }
                      ?>
                  </div>
              </div>
            </nav>
        </header>        
        <script>
            $("#logout").click(function(){
                if(confirm("정말로 로그아웃 하시겠습니까?")){
                    location.href='logout.php';   
                }
            });
        </script>
        <section class="container">
