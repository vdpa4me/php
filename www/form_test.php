<?php
     require_once 'sql_conn.php';
?>

<html>
    <body>
    <?php
         if( empty($_GET)){
            echo "There is no GET value <br>";
         }
         else{
            echo "GET value is " . $_GET['lv'] . "<br>";
            
            $level = 0;
            $level = $_GET['lv'];
            echo "Level : " . $level . "<br>";
            
            $level_p_3 = $level + 3;
            echo "Level + 3 : " . $level_p_3 . "<br>";
            
         }
        
         $conn = new mysqli($hn, $un, $pw, $db);
         if($conn->connect_error){ 
            die($conn->connect_error);
            echo "DB connection failed" . "<br>";
            return;
         }
         
         $query = 'SELECT * FROM sentences';
         $result = $conn->query($query);
         if (!@result){ 
            die($conn->error);
            echo "Query failed" . "<br>";
            return;
         }
         
         $rows = $result->num_rows;
         $ex_lv = 0;
         $lv_arr = array();
         for ($j = 0 ; $j < $rows; ++$j )
         {
            $result->data_seek($j);
            $tmp_lv = $result->fetch_assoc() ['level'];
            
            if($ex_lv != $tmp_lv){
                $ex_lv = $tmp_lv;
                $lv_arr[] = $tmp_lv;
            }
        }
 
    echo '<form>';
    echo '<select name="lv">';
    //$lv_arr = array_values($lv_arr);
    for($i=0; $i<count($lv_arr); $i++){
        $indx = $lv_arr[$i];
        
        if( (!empty($_GET)) && ( $level == $indx  ))
            echo '<option value=' . $indx . ' selected > LV' . $indx . '</option>';
        else
            echo '<option value=' . $indx . '> LV' . $indx . '</option>';
    }
    echo '</select>';
    echo '<input type="submit" name="goto">';
    echo '</form>';
?>

<?php
    echo "<br><br>";
    echo "<table>";
    $cnt5 = 0;
    $rows = $result->num_rows;
    echo "<tr><td>No</td><td>Level</td><td>Korean</td><td>English</td></tr>";
    for ($j = 0 ; $j < $rows; ++$j )
    {
     
        $result->data_seek($j);
        $temp_lv = $result->fetch_assoc() ['level'];  
        
        if( !empty($_GET) ){
            if( $level == $temp_lv ){
                echo "<tr>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['main_key'] . "</td>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['level'] . "</td>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['korean'] . "</td>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['english'] . "</td>";
                echo "</tr>";
                
                $cnt5 = $cnt5 + 1;
                if( $cnt5 >= 5 ){
                    echo "cnt5: " . $cnt5 . "<br>";
                    break;
                }
            }
        }
        else{
            echo "<tr>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['main_key'] . "</td>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['level'] . "</td>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['korean'] . "</td>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['english'] . "</td>";
            echo "</tr>";
        }
    }
    
    echo "</table>";
        
?>
    </body>
</html>
