<?php

/**
 * Modify_st
 * @author Kyumin Chang
 * @copyright 2016
 */

    require_once 'sql_conn.php';
    echo "<html><head>";
    echo '<meta charset="utf-8">';
    echo "<style>";
    echo "  table {";/**
     * 
     */
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
    echo "Modify Sentenses <br>";
    $max_index = 0;
    $temp_index = 0;
    
    $i_main_key = 0;
    $i_level = 0;
    $i_eng = "";
    $i_kor = "";
    $i_foot_eng = "";
    $i_foot_pronun = "";
    $i_foot_kor = "";
    
    $isModify = 0;
    $isKeyAlready = 0;
    
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error){ 
        die($conn->connect_error);
        echo "DB connection failed" . "<br>";
    }
    else{  
        if( !empty($_GET)){
            if(  !empty($_GET['main_key']) ){
                 //////////////////// Modify /////////////////
                 if(  empty($_GET['eng']) ){   
                    echo "<br> Modify <br>";
                    $isModify = 1;
                    $i_main_key = $_GET['main_key'];
                    $query1 = "SELECT * FROM sentences ORDER BY main_key";
                    $result1 = $conn->query($query1);
                    if (!@result1){ 
                        die($conn->error);
                        echo "Query failed" . "<br>";
                        return;
                    }
                    $rows = $result1->num_rows;
                    for ($j = 0 ; $j < $rows; ++$j )
                    {
                        $result1->data_seek($j);
                        $temp_main_key = $result1->fetch_assoc() ['main_key'];
                        if(  $temp_main_key == $i_main_key ){
                        
                            $result1->data_seek($j);
                            $i_level = $result1->fetch_assoc() ['level'];
                            $result1->data_seek($j);
                            $i_eng = $result1->fetch_assoc() ['english'];
                            $result1->data_seek($j);
                            $i_kor = $result1->fetch_assoc() ['korean'];
                            $result1->data_seek($j);
                            $i_foot_eng = $result1->fetch_assoc() ['foot_eng'];
                            $result1->data_seek($j);
                            $i_foot_pronun = $result1->fetch_assoc() ['foot_pronun'];
                            $result1->data_seek($j);
                            $i_foot_kor = $result1->fetch_assoc() ['foot_kor'];
                            echo "<br>i:" . $i_main_key . " level:" . $i_level . " eng:" . $i_kor;
                            break;
                        }
                    }
                 }
                 ////////////////// Input /////////////////////
                 else{ 
                    echo "<br> Input <br>";
                    //Check if there is the same key
                    $i_main_key = $_GET['main_key'];
                    $query1 = "SELECT * FROM sentences ORDER BY main_key";
                    $result1 = $conn->query($query1);
                    if (!@result1){ 
                        die($conn->error);
                        echo "Query failed" . "<br>";
                        return;
                    }
                    $rows = $result1->num_rows;
                    for ($j = 0 ; $j < $rows; ++$j )
                    {
                        $result1->data_seek($j);
                        $temp_main_key = $result1->fetch_assoc() ['main_key'];
                        if(  $temp_main_key ==  $i_main_key ){
                            $isKeyAlready = 1;
                            break;
                        }
                    }
                    
                    
                    if( $isKeyAlready ){
                        echo "<br> Update </br>";
                        $query1 = 'UPDATE sentences'. 'SET level=\'' . $_GET['level'] . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }
                        $query1 = 'UPDATE sentences '. 'SET english=\'' . $_GET['eng'] . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }
                        $query1 = 'UPDATE sentences '. 'SET korean=\'' . $_GET['kor'] . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }
                        $query1 = 'UPDATE sentences '. 'SET foot_eng=\'' . $_GET['foot_eng'] . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }
                        $query1 = 'UPDATE sentences '. 'SET foot_pronun=\'' . $_GET['foot_pronun'] . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }
                        $query1 = 'UPDATE sentences '. 'SET foot_kor=\'' . $_GET['foot_kor'] . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }        
                    }
                  
                   // echo "<br>" . $query1;
                 }
            }
        }

        $query = "SELECT * FROM sentences ORDER BY main_key";
        $result = $conn->query($query);
        if (!@result){ 
            die($conn->error);
            echo "Query failed" . "<br>";
            return;
        }

        //Get the max index
        $rows = $result->num_rows;
        //input
        echo "<form>";
        echo "<table>";
        echo '<tr><td>No</td>               <td><input type="text" name="main_key" value="'. $i_main_key . '" size="40"> </td></tr>'; 
        echo '<tr><td>level</td>         <td><input type="text" name="level" value="' . $i_level . '" size="40"> </td></tr>'; 
        echo '<tr><td>English</td>          <td><input type="text" name="eng" value="' . $i_eng .  '" size="40"> </td></tr>'; 
        echo '<tr><td>Korean</td>           <td><input type="text" name="kor" value="' . $i_kor .'"  size="40"> </td></tr>'; 
        echo '<tr><td>footnote Eng</td>     <td><input type="text" name="foot_eng" value="' . $i_foot_eng .  '" size="40"> </td></tr>'; 
        echo '<tr><td>footnote Pronu</td>     <td><input type="text" name="foot_pronun" value="' . $i_foot_pronun .  '" size="40"> </td></tr>'; 
        echo '<tr><td>footnote Kor</td>     <td><input type="text" name="foot_kor" value="' . $i_foot_kor .  '" size="40"> </td></tr>'; 
        echo '<tr><td></td><td><input type="submit" size="30"></td></tr>';
        echo "</table>";
        echo "</form>";

        echo "<br><br><br><br><br>";
        echo "All data <br>";
        
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
    
    echo "</body></html>";
      
    
?>