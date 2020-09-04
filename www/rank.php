<?php

/**
 * @author Kyumin Chang
 * @copyright 2016
 */

    require_once 'sql_conn.php';
    require_once 'util_string.php';
    
    echo "<html><head>";
    echo '<meta charset="utf-8">';
    echo "<style>";
    echo "  table {";
    echo "    display: table;";
    echo "    border-collapse: collapse;";
    echo "    border-spacing: 2px;";
    echo "    border-color: gray;";
    echo "  }";
    echo "  table, th, td {";
    echo "    border: 1px solid black;";
    echo "  }";
    echo "</style>";
    echo "</head><body>";
    echo "<br>";   
    
    
    $olv=0;
    $FailStr = "";
    
    echo "<br>";   
    echo "Rank <br>";
    
    echo "<br>";
    echo "<form>";
    echo "<table>";
    echo '<tr><td>ID</td><td> <input type="text" name="id" value="'. $_GET['id'] . '" size="30"> </td></tr>'; 
    echo '<tr><td>  </td><td> <input type="submit" size="30"></td></tr>';
    echo "</table>";
    echo "</form>";
    echo "<br><br>";
    
    //display user data 
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error){ 
        die($conn->connect_error);
        echo "DB connection failed" . "<br>";
        return;
    }
    else{
        $query = "SELECT * FROM user";
        $result = $conn->query($query);
        if (!@result){ 
            die($conn->error);
            echo "Query failed" . "<br>";
            return;
        }
        
        $flag = 0;
        
        echo "<table>";
        $rows = $result->num_rows;
        echo "<tr><td>ID</td> <td>Name</td> <td>clv</td> <td>olv</td> <td>gold</td></tr>";
        for ($j = 0 ; $j < $rows; ++$j )
        {
            $tid = "";
            $tolv = 0;
            
            echo "<tr>";
            $result->data_seek($j);
            $tid = $result->fetch_assoc() ['id'];
            echo "<td>" . $tid . "</td>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['name'] . "</td>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['clv'] . "</td>";
            $result->data_seek($j);
            $tolv = $result->fetch_assoc() ['olv'];
            echo "<td>" . $tolv . "</td>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['gold'] . "</td>";
            
           
            echo "</tr>";
            
            if( (!empty($_GET['id'])) && ($flag==0) ){
                $get_id = $_GET['id'];
                $get_id = trim($get_id);
                $tid = trim($tid);
                //echo $get_id . " " . $tid . "<br>";
                if( strcmp($get_id, $tid) == 0){
                    $id = $tid;
                    $result->data_seek($j);
                    $FailStr = $result->fetch_assoc() ['olvd'];
                    $olv = $tolv;
                    $flag = 1;
                }
            } 
        }
        echo "</table>";
    }   
    
   
    if( !empty($_GET['id']) && ($flag==1) ){
       
        $arr_bool = FailStringToBoolArray( $FailStr, $olv);
        $max = count($arr_bool);
        
        $query_st = "SELECT * FROM sentences ORDER BY main_key";
        $result_st = $conn->query($query_st);
        if (!@result_st){ 
            die($conn->error);
            echo "Query failed" . "<br>";
            return;
        }
       
        echo "<br><br> Sentenses that " . $get_id . " does not know. (Lv1~Lv". $olv.")<br>";
        echo "<table>";
        echo "<tr><td>No</td><td>Lv</td><td>Kor</td><td>Eng</td></tr>";
        $rows = $result_st->num_rows;
        for ($j = 0 ; $j < $rows; ++$j )
        {
            
            $result_st->data_seek($j);
            $main_key = $result_st->fetch_assoc() ['main_key'];
            $indx = (int)$main_key;
            
            if( ($olv * 5) < $indx)
                break;
                
            if($arr_bool[$indx] == 0){
                echo "<tr>";
                echo "<td>" . $main_key . "</td>";
                $result_st->data_seek($j);
                echo "<td>" . $result_st->fetch_assoc() ['level'] . "</td>";
                $result_st->data_seek($j);
                echo "<td>" . $result_st->fetch_assoc() ['korean'] . "</td>";
                $result_st->data_seek($j);
                echo "<td>" . $result_st->fetch_assoc() ['english'] . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }
    
 
    
  
    
    
    
     echo "</body></html>";
?>