<?php

include_once "./layout.inc"; // 레이아웃을 include 함 
$base = new Layout; // Layout class 객체를 생성
$base->link='./style.css'; //style 
$base->content="<a href='#'> Link </a> Contents"; //본문을 만듦
$base->LayoutMain(); //위의 변수들이 입력된 객체를 출력

?>
