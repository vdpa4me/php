<?php

include_once "./layout.inc"; // ���̾ƿ��� include �� 
$base = new Layout; // Layout class ��ü�� ����
$base->link='./style.css'; //style 
$base->content="<a href='#'> Link </a> Contents"; //������ ����
$base->LayoutMain(); //���� �������� �Էµ� ��ü�� ���

?>
