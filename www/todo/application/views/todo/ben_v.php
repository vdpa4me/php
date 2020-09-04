<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
	<title>Yumi`s memo</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel='stylesheet' href="/todo/include/css/bootstrap.css" />
</head>
<body>
<div id="main">

	<header id="header" data-role="header" data-position="fixed"><!-- Header Start -->
		<blockquote>
            <p>Ben`s English Study </p>
		</blockquote>
	</header><!-- Header End -->

	<nav id="gnb"><!-- gnb Start -->
         <li> <a href="http://unclebenenglish.com/input_ben.php" class="btn btn-success">Goto Input</a> 
              <a href="http://unclebenenglish.com/todo/index.php/main/ben/" class="btn btn-warning">Refresh</a>
        </li>
	</nav><!-- gnb End -->
	<article id="board_area">
		<header>
			<h1>Ben`s Memo</h1>
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
					<th scope="col">Korean</th>
					<th scope="col">English</th>
					<th scope="col">footnote</th>
				</tr>
			</thead>
			<tbody>
<?php
    foreach ($ben as $lt)
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
			<td><?php echo $lt->korean;?></td>
			<td><?php echo $lt->english;?></td>
			<td><?php echo $lt->foot;?></td>
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
			<p>Yumi`s Memo</p>
			<small>Copyright by <em class="black"><a href="mailto:vdpa4me@gmail.com"> Benjamin Chang</a></small>
		<blockquote>
	</footer>

</div>

</body>
</html>