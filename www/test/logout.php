<?php

require_once './layout.inc';




$base = new Layout;

$base->link = './style.css';




$base->LayoutMain();




unset($_SESSION['id']);

unset($_SESSION['permit']);

session_destroy();




echo "<script>alert('Logouted');location.replace('/')</script>";

?>
