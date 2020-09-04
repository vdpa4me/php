<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
	<title>CodeIgniter</title>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel='stylesheet' href="/todo/include/css/bootstrap.css" />
</head>
<body>
<div id="main">

	<header id="header" data-role="header" data-position="fixed"><!-- Header Start -->
		<blockquote>
			<p>Uncle Ben`s English</p>
			<small>Practice English Everyday</small>
		</blockquote>
	</header><!-- Header End -->

	<nav id="gnb"><!-- gnb Start -->
		<ul>
			<li><a rel="external" href="/todo/index.php/main/lists/">todo 어플리케이션 프로그램</a></li>
		</ul>
	</nav><!-- gnb End -->
	<article id="board_area">
		<header>
			<h1>Todo 목록</h1>
		</header>
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<!--<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">contents</th>
					<th scope="col">started date</th>
					<th scope="col">ended date</th>
				</tr>
			</thead>
			<tbody> -->
            <tr>
<?php
$com = 0;
foreach ($list as $lt)
{
?>
			
					<th>
						<?php echo $lt->main_key;?>
					</th>
					
				
					

<?php
}
?>
            </tr>
		<!--	</tbody> -->
			<tfoot>
				<tr>
					<th colspan="4"><a href="/todo/index.php/main/write/" class="btn btn-success">쓰기</a></th>
				</tr>
			</tfoot>
		</table>
		<div><p></p></div>

	</article>

	<footer id="footer">
		<blockquote>
			<p><a class="azubu" href="http://www.cikorea.net/" target="blank">CodeIgniter한국사용자포럼</a></p>
			<small>Copyright by <em class="black"><a href="mailto:advisor@cikorea.net">웅파</a></small>
		<blockquote>
	</footer>

</div>

</body>
</html>