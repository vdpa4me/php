<?php

/**
 * Input Sentenses 
 * @author Kyumin Chang
 * @copyright 2016
 */

    require_once 'sql_conn.php';
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
    echo "Input Sentences <br>";
    $max_index = 0;
    $temp_index = 0;
    
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error){ 
        die($conn->connect_error);
        echo "DB connection failed" . "<br>";
    }
    else{  
        if( !empty($_GET)){
            
            $query1 = 'INSERT INTO sentences (main_key,  level, item, korean, english, foot_eng, foot_pronun, foot_kor) VALUES(' 
                      . $_GET['no1'] . ', ' . $_GET['level'] . ', 1 , ' . '\'' . $_GET['kor1'] . '\', ' . '\'' . $_GET['eng1'] . '\', ' . '\'\',' . '\'\',' . '\'\')';
            $result = $conn->query($query1);
            if (!@result){ 
                die($conn->error);
                echo "Query failed" . "<br>";
            }
            $query1 = 'INSERT INTO sentences (main_key,  level, item, korean, english, foot_eng, foot_pronun, foot_kor) VALUES(' 
                      . $_GET['no2'] . ', ' . $_GET['level'] . ', 2 , ' . '\'' . $_GET['kor2'] . '\', ' . '\'' . $_GET['eng2'] . '\', ' . '\'\',' . '\'\',' . '\'\')';
            $result = $conn->query($query1);
            if (!@result){ 
                die($conn->error);
                echo "Query failed" . "<br>";
            }
            $query1 = 'INSERT INTO sentences (main_key,  level, item, korean, english, foot_eng, foot_pronun, foot_kor) VALUES(' 
                      . $_GET['no3'] . ', ' . $_GET['level'] . ', 3 , ' . '\'' . $_GET['kor3'] . '\', ' . '\'' . $_GET['eng3'] . '\', ' . '\'\',' . '\'\',' . '\'\')';
            $result = $conn->query($query1);
            if (!@result){ 
                die($conn->error);
                echo "Query failed" . "<br>";
            }
            $query1 = 'INSERT INTO sentences (main_key,  level, item, korean, english, foot_eng, foot_pronun, foot_kor) VALUES(' 
                      . $_GET['no4'] . ', ' . $_GET['level'] . ', 4 , ' . '\'' . $_GET['kor4'] . '\', ' . '\'' . $_GET['eng4'] . '\', ' . '\'\',' . '\'\',' . '\'\')';
            $result = $conn->query($query1);
            if (!@result){ 
                die($conn->error);
                echo "Query failed" . "<br>";
            }
            $query1 = 'INSERT INTO sentences (main_key,  level, item, korean, english, foot_eng, foot_pronun, foot_kor) VALUES(' 
                      . $_GET['no5'] . ', ' . $_GET['level'] . ', 5 , ' . '\'' . $_GET['kor5'] . '\', ' . '\'' . $_GET['eng5'] . '\', ' . '\'\',' . '\'\',' . '\'\')';
            $result = $conn->query($query1);
            if (!@result){ 
                die($conn->error);
                echo "Query failed" . "<br>";
            }
  
            
            //$query1 = "INSERT INTO sentences (main_key,  level, item, korean, english, foot_eng, foot_pronun, foot_kor) VALUES("; 
            //+ $_GET['no1']+" , "+$_GET['level']+" ,1 , "+ $_GET['kor1']+ " , " + $_GET['eng1'] + ", '','' ,'' )";
            
            //echo "INSERT INTO sentences (main_key,  level, item, korean, english, foot_eng, foot_pronun, foot_kor) VALUES(" + "<br>"; 
        }

        $query = "SELECT * FROM sentences ORDER BY main_key";
        $result = $conn->query($query);
        if (!@result){ 
            die($conn->error);
            echo "Query failed" . "<br>";
        }
        else{
            //Get the max index
            $rows = $result->num_rows;
            for ($j = 0 ; $j < $rows; ++$j )
            {
                $result->data_seek($j);
                $temp_index = $result->fetch_assoc() ['main_key'];
                if( $max_index < $temp_index )
                    $max_index = $temp_index;
            }
            echo "Maximum index =" . $max_index . "<br>";
            $current_lv = $max_index / 5;
            $current_lv = $current_lv + 1;
            echo "Inputed level =" . $max_index . "<br>";
            
            $first = $max_index + 1;
            $second = $max_index + 2;
            $third = $max_index + 3;
            $forth = $max_index + 4;
            $fifth = $max_index + 5;
            
            //input
            echo "<form>";
            echo '<br> Level = <input type="text" name="level" value="' . $current_lv . '"> <br>';
            echo "<table>";
            echo "<tr><td>no</td> <td>item</td> <td>Korean</td> <td>English</td> </tr>";
            //1st
            echo "<tr>";
            echo '<td> <input type="text" name="no1" size="10" value="' .$first . '"> </td>'; 
            echo "<td> 1 </td>"; 
            echo '<td> <input type="text" name="kor1" size="35"> </td>'; 
            echo '<td> <input type="text" name="eng1" size="35"> </td>'; 
            echo "</tr>";
            //2nd
            echo "<tr>";
            echo '<td> <input type="text" name="no2" size="10" value="' .$second . '"> </td>'; 
            echo "<td> 2 </td>"; 
            echo '<td> <input type="text" name="kor2" size="35"> </td>'; 
            echo '<td> <input type="text" name="eng2" size="35"> </td>'; 
            echo "</tr>";
            //3rd
            echo "<tr>";
            echo '<td> <input type="text" name="no3" size="10" value="' .$third . '"> </td>'; 
            echo "<td> 3 </td>"; 
            echo '<td> <input type="text" name="kor3" size="35"> </td>'; 
            echo '<td> <input type="text" name="eng3" size="35"> </td>'; 
            echo "</tr>";
            //4th
            echo "<tr>"; 
            echo '<td> <input type="text" name="no4" size="10" value="' .$forth. '"> </td>'; 
            echo "<td> 4 </td>"; 
            echo '<td> <input type="text" name="kor4" size="35"> </td>'; 
            echo '<td> <input type="text" name="eng4" size="35"> </td>'; 
            echo "</tr>";
            //5th
            echo "<tr>"; 
            echo '<td> <input type="text" name="no5" size="10" value="' .$fifth. '"> </td>'; 
            echo "<td> 5 </td>"; 
            echo '<td> <input type="text" name="kor5" size="35"> </td>'; 
            echo '<td> <input type="text" name="eng5" size="35"> </td>'; 
            echo "</tr>";
            echo '<tr><td></td> <td></td> <td></td>  <td><input type="submit" size="35"></td></tr>';
            echo "</table>";
            echo "</form>";
            
    
            echo "<br><br><br><br><br>";
            
            echo "<table>";
            $rows = $result->num_rows;
            echo "<tr><td>No</td><td>Level</td><td>Korean</td><td>English</td><td>foot eng</td><td>foot pronun</td><td>foor kor</td></tr>";
            for ($j = 0 ; $j < $rows; ++$j )
            {
                
                echo "<tr>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['main_key'] . "</td>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['level'] . "</td>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['korean'] . "</td>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['english'] . "</td>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['foot_eng'] . "</td>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['foot_pronun'] . "</td>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['foot_kor'] . "</td>";
                echo "</tr>";
         
            }
            echo "</table>";
            
            
        }
        
        
        
        
    }
    
    echo "</body></html>";
      
    
?>