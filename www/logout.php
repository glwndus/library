<?php
include "common.php";

unset($_SESSION['log']);
unset($_SESSION['id']);
unset($_SESSION['userlv']);

echo "<script>history.go(-2);</script>";

?>