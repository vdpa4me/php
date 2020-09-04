<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
	<title>Uncle Ben`s American English</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel='stylesheet' href="/todo/include/css/bootstrap.css" />
</head>
<body>
<div id="main">

	<header id="header" data-role="header" data-position="fixed"><!-- Header Start -->
            <p><a class="azubu" href="http://www.mystamptour.com/" target="_top"><center><img src="http://uncleben.cafe24.com/image/mainLogo.png" alt="Go Home" border="0"/></center></a></p>
			<center><small>Practice English Everyday !</small></center>
	</header><!-- Header End -->

	<nav id="gnb"><!-- gnb Start -->
		<ul>
            <li> <a href="/todo/index.php/main/sentences/?lv=1" class="btn btn-success">Sentences</a> 
                 <a href="/todo/index.php/main/rank/" class="btn btn-warning">Rank</a>
                 <a href="/todo/index.php/main/Search/" class="btn btn-success">Search</a></li>
		</ul>
	</nav><!-- gnb End -->
	<article id="board_area">
		<header>
			<h1>Search</h1>
		</header>
        
 <?php
        if( !empty($_GET)){
            $keyword = $_GET['key'];
            $keyword = trim($keyword);
        }
        else{
            $keyword = NULL;
        }
        
        echo '<form>';
        echo '<table cellspacing="0" cellpadding="0" class="table table-striped">';
        echo '<tbode>';
        echo '<tr>';
        echo '<td> Search for</td>';
        echo '<td><input type="text" name="key" style="width: 100%"> </td>';
        echo '<td><input type="submit" value="Search"></td>';
        echo '</tbody>';
        echo '</table>';
        echo '</form>';
        echo "<br>"; 
        
 if( $keyword != NULL )
       echo '<h3>Search for ' . $keyword . '</h3><br />';
 else
       echo '<h3>All Lists</h3><br />';
    
 ?>
        
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Level</th>
					<th scope="col">Korean</th>
					<th scope="col">English</th>
				</tr>
			</thead>
			<tbody>
<?php
    foreach ($list as $lt)
    {
        if( $keyword != NULL ){
            $korean = $lt->korean;
            $korean = trim($korean);
            $english = $lt->english;
            $english = trim($english);
            if( (strstr($korean, $keyword) == FALSE) && 
                (stristr($english, $keyword) == FALSE))
                continue;
            //echo $korean ."  ". $english ."  ". $keyword ."<br>"; 
        }
        
        
?>
        <tr>
			<th scope="row">
				<?php echo $lt->main_key;?>
			</th>
			<td><?php echo $lt->level;?></td>
			<td><?php echo $lt->korean;?></td>
			<td><?php echo $lt->english;?></td>
        </tr>
<?php
      

    }
?>
          
	   	   </tbody>
			<tfoot>
				<tr>
					<th colspan="4">The end of the table</a></th>
				</tr>
			</tfoot>
		</table>
        
		<div><p></p></div>

	</article>

	<footer id="footer">
		<blockquote>
			<p><a class="azubu" href="http://www.unclebenenglish.com/" target="blank">Uncle Ben`s English </a></p>
			<small>Copyright by <em class="black"><a href="mailto:vdpa4me@gmail.com"> Benjamin Chang</a></small>
		<blockquote>
	</footer>

</div>

</body>
</html>