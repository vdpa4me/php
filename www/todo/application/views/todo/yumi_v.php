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
            <p>Yumi`s English Study </p>
		</blockquote>
	</header><!-- Header End -->

	<nav id="gnb"><!-- gnb Start -->
         <li> <a href="http://mystamptour.com/input_yumi.php" class="btn btn-success">Goto Input</a> 
              <a href="http://mystamptour.com/yumi_del.php" class="btn btn-warning">Goto Delete</a>
              <a href="http://mystamptour.com/todo/index.php/main/yumi/" class="btn btn-success">Refresh</a>
        </li>
	</nav><!-- gnb End -->
	<article id="board_area">
		<header>
			<h1>Yumi`s Memo</h1>
		</header>
        
 <?php
        $cate=NULL;
        $keyword=NULL;
        
        if( !empty($_GET)){
            if(  !empty($_GET['cate']) ){
                $cate = $_GET['cate'];
                $cate = trim($cate);
                $keyword = NULL;
            }
            
            if(!empty($_GET['key']) ){
                $keyword = $_GET['key'];
                $keyword = trim($keyword);
                $cate = NULL;
                if(strlen($keyword) < 1)
                    $keyword = NULL;
            }
        }
        else{
            $keyword = NULL;
            $cate = NULL;
        }
        
        //
        //for select items
        $cate_arr = array();
        foreach ($yumi as $lt)
        {
            $tmp_cate = $lt->category;
            $tmp_cate = trim($tmp_cate);
            $found=0;
            
            if( count($cate_arr) == 0){
                $cate_arr[] = $tmp_cate;
                continue;
            }
            
            for($j=0; $j<count($cate_arr); $j++){
                $indx = $cate_arr[$j];
                if(strcmp($indx, $tmp_cate) == 0 ){ //different 
                    $found=1;
                    break;
                }
            }
            
            if($found == 0)
                $cate_arr[] = $tmp_cate;
         }
         //
         
         sort($cate_arr);
      
        echo '<table cellspacing="0" cellpadding="0" class="table table-striped">';
        echo '<tbode>';
        echo '<tr>';
        echo '<td>';
        echo '<form>';
        echo '<select name="cate" style="width: 100%" onchange=\'this.form.submit()\'>';
        for($i=0; $i<count($cate_arr); $i++){
            $indx = $cate_arr[$i];
            if( ( !empty($_GET['cate'])) && (strcmp($cate, $indx) == 0) )
                echo '<option value=' . $indx . ' selected >'. $indx . '</option>';
            else
                echo '<option value=' . $indx . '>' . $indx . '</option>';
        }
        echo '</select> <noscript><td><input type="submit" value="Show up.."></noscript>';
        echo '</form>';
        echo '<form><td><input type="text" name="key" style="width: 100%"> </td>';
        echo '<td><input type="submit" value="Search"></td></form>';
        echo '</tbody>';
        echo '</table>';
        echo '</form>';
        echo "<br>"; 
        
 if( $keyword != NULL )
       echo '<h3>Search for ' . $keyword . '</h3><br />';
 else if( $cate != NULL )
       echo '<h3>Category: ' . $cate . '</h3><br />';   
 else
       echo '<h3>All Lists</h3><br />';
    
 ?>
        
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Category</th>
					<th scope="col">English</th>
					<th scope="col">Korean</th>
				</tr>
			</thead>
			<tbody>
<?php
    foreach ($yumi as $lt)
    {
        if( $keyword != NULL ){
            $korean = $lt->kor;
            $korean = trim($korean);
            $english = $lt->eng;
            $english = trim($english);
            if( (strstr($korean, $keyword) == FALSE) && 
                (stristr($english, $keyword) == FALSE))
                continue;
            //echo $korean ."  ". $english ."  ". $keyword ."<br>"; 
        }
        
        if( $cate != NULL ){
            $temp_cate = $lt->category;
            $temp_cate = trim($temp_cate);
            if($temp_cate == NULL)
                continue;
            if( (strstr($cate, $temp_cate) == FALSE))
                continue;
        }
        
        
?>
        <tr>
			<th scope="row">
				<?php echo $lt->main_key;?>
			</th>
			<td><?php echo $lt->category;?></td>
			<td><?php echo $lt->eng;?></td>
			<td><?php echo $lt->kor;?></td>
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