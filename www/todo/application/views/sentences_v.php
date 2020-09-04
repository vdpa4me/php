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
		<blockquote>
            <p><a class="azubu" href="http://www.unclebenenglish.com/" target="_top">Uncle Ben`s English </a></p>
			<small>Practice English Everyday !</small>
		</blockquote>
	</header><!-- Header End -->

	<nav id="gnb"><!-- gnb Start -->
		<ul>
            <li> <a href="/todo/index.php/main/sentences/?lv=1" class="btn btn-success">Sentences</a> 
                 <a href="/todo/index.php/main/rank/" class="btn btn-warning">Rank</a></li>
		</ul>
	</nav><!-- gnb End -->
	<article id="board_area">
		<header>
			<h1>Sentences</h1>
		</header>
        
 <?php
         if( empty($_GET))
            $level = -1;  
         else
            $level = $_GET['lv']; 
      
         $ex_lv = 0;
         $lv_arr = array();
         foreach ($list as $lt)
         {
            $tmp_lv = $lt->level;
            if($ex_lv != $tmp_lv){
                $ex_lv = $tmp_lv;
                $lv_arr[] = $tmp_lv;
            }
         }
       
        echo '<form>';
        echo '<table cellspacing="0" cellpadding="0" class="table table-striped">';
        echo '<tbode>';
        echo '<tr>';
        echo '<td> Select a level </td>';
        echo '<td> <select name="lv" style="width: 100%">';
        //$lv_arr = array_values($lv_arr);
        for($i=0; $i<count($lv_arr); $i++){
            $indx = $lv_arr[$i];
            
            if( ($level>0) && ( $level == $indx  ))
                echo '<option value=' . $indx . ' selected > LV' . $indx . '</option>';
            else
                echo '<option value=' . $indx . '> LV' . $indx . '</option>';
        }
        echo '</select></td>';
        echo '<td><input type="submit" value="Show up.."></td>';
        echo '</table>';
        echo '</form>';
        echo "<br>"; 
 if( $level > 0 ){
       echo '<h3>Level' . $level . '</h3><br />';
 ?>
        
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Korean</th>
					<th scope="col">English</th>
				</tr>
			</thead>
			<tbody>
<?php
    $com = 0;
    $cnt5=0;
    foreach ($list as $lt)
    {
        $tmp_lv = $lt->level;
        if( $tmp_lv == $level) {
?>
            <tr>
    			<th scope="row">
    				<?php echo $lt->main_key;?>
    			</th>
    			<td><?php echo $lt->korean;?></td>
    			<td><?php echo $lt->english;?></td>
            </tr>
<?php
            $cnt5 = $cnt5 + 1;
            if($cnt5 >= 5 ) {
                break;
            }
        }
    }
?>
          
	   	   </tbody>
			<tfoot>
				<tr>
					<th colspan="4">The end of the table</a></th>
				</tr>
			</tfoot>
		</table>
        
    <?php
    }
    ?>
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