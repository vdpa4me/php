<?php

/**
 * Input Yumi
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
    echo "Input Yumi <br>";
    $max_index = 0;
    $temp_index = 0;
    
    $i_main_key = 0;
    $i_category = "";
    $i_eng = "";
    $i_kor = "";
    $i_pronun = "";
    $i_foot = "";
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
                    $query1 = "SELECT * FROM yumi ORDER BY main_key";
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
                        $temp_main_key = trim($temp_main_key);
                        $i_main_key = trim($i_main_key);
                        $res = strcmp($temp_main_key, $i_main_key);
                        //$res = strcmp("????", "????");
                        //echo "<br>result :" . $res;
                        if(  $res == 0 ){
                            $result1->data_seek($j);
                            $i_category = $result1->fetch_assoc() ['category'];
                            $result1->data_seek($j);
                            $i_eng = $result1->fetch_assoc() ['eng'];
                            $result1->data_seek($j);
                            $i_kor = $result1->fetch_assoc() ['kor'];
                            $result1->data_seek($j);
                            $i_pronun = $result1->fetch_assoc() ['pronun'];
                            $result1->data_seek($j);
                            $i_foot = $result1->fetch_assoc() ['foot'];
                            break;
                        }
                        
                    }
                    
                 }
                 ////////////////// Input /////////////////////
                 else{ 
                    echo "<br> Input <br>";
                    //echo "<br>" . $_GET['main_key'];
                    //echo "<br>" . $_GET['category'];
                    //echo "<br>" . $_GET['eng'];
                    //echo "<br>" . $_GET['kor'];
                    //echo "<br>" . $_GET['pronun'];
                    //echo "<br>" . $_GET['foot'];
                    
                    //Check if there is the same key
                    $i_main_key = $_GET['main_key'];
                    $query1 = "SELECT * FROM yumi ORDER BY main_key";
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
                    
                    $eng = $_GET['eng'];
                    $kor = $_GET['kor'];
                    
                    if( strpos($eng, '\'') != FALSE){
                        $eng = str_replace("'", "\'",$eng);
                    }
                    
                    if( strpos($kor, '\'') != FALSE){
                        $kor = str_replace("'", "\'",$kor);
                    }
                    
                    
                    if( $isKeyAlready ){
                        echo "<br> Update </br>";
                        $query1 = 'UPDATE yumi'. 'SET category=\'' . $_GET['category'] . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }
                        $query1 = 'UPDATE yumi '. 'SET eng=\'' . $eng . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }
                        $query1 = 'UPDATE yumi '. 'SET kor=\'' . $kor . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }
                        $query1 = 'UPDATE yumi '. 'SET pronun=\'' . $_GET['pronun'] . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }
                        $query1 = 'UPDATE yumi '. 'SET foot=\'' . $_GET['foot'] . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }
                        $query1 = 'UPDATE yumi '. 'SET category=\'' . $_GET['category'] . '\' ' . 'WHERE main_key=' . $_GET['main_key'];
                         $result = $conn->query($query1);
                         if (!@result){ 
                            die($conn->error);
                            echo "Query failed" . "<br>";
                            return;
                         }        
                    }
                    else{
                        echo "<br> Pure Insert </br>";
                        $query1 = 'INSERT INTO yumi (main_key,  category , eng , kor , pronun , foot) VALUES(' 
                                      . $_GET['main_key'] . ' , ' 
                                      . '\'' . $_GET['category'] . ' \' , ' 
                                      . '\'' . $eng . ' \' , ' 
                                      . '\'' . $kor . ' \' , ' 
                                      . '\'' . $_GET['pronun'] . ' \' , ' 
                                      . '\'' . $_GET['foot'] . ' \' )';
                         
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

        $query = "SELECT * FROM yumi ORDER BY main_key";
        $result = $conn->query($query);
        if (!@result){ 
            die($conn->error);
            echo "Query failed" . "<br>";
            return;
        }

        //Get the max index
        $rows = $result->num_rows;
        if($isModify == 0){
            $i_main_key = $rows + 1;
        }
                
        //input
        echo '<form autocomplete="on">';
        echo '<table>';
        echo '<tr><td>No</td>               <td><input type="text" name="main_key" value="'. $i_main_key . '" size="40"> </td></tr>'; 
        echo '<tr><td>Category</td>         <td><input type="text" name="category" value="' . $i_category . '" size="40"> </td></tr>'; 
        echo '<tr><td>English</td>          <td><input type="text" name="eng" value="' . $i_eng .  '" size="40"> </td></tr>'; 
        echo '<tr><td>Korean</td>           <td><input type="text" name="kor" value="' . $i_kor .'"  size="40"> </td></tr>'; 
        echo '<tr><td>Pronuncation</td>     <td><input type="text" name="pronun" value="' . $i_pronun .  '" size="40"> </td></tr>'; 
        echo '<tr><td>Foot note</td>        <td><input type="text" name="foot" value="' . $i_foot  . '" size="40"> </td></tr>'; 
        echo '<tr><td></td><td><input type="submit" size="30"></td></tr>';
        echo "</table>";
        echo "</form>";

        echo "<br><br><br><br><br>";
        echo "All data <br>";
        
        echo "<table>";
        $rows = $result->num_rows;
        echo "<tr><td>No</td> <td>Category</td> <td>English </td> <td>Korean</td> <td>Pronuncation </td> <td>Foot note </td> </tr>";
        for ($j = 0 ; $j < $rows; ++$j )
        {
            
            echo "<tr>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['main_key'] . "</td>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['category'] . "</td>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['eng'] . "</td>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['kor'] . "</td>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['pronun'] . "</td>";
            $result->data_seek($j);
            echo "<td>" . $result->fetch_assoc() ['foot'] . "</td>";
            echo "</tr>";
     
        }
        echo "</table>";
            

        
        
        
        
    }
    
    echo "</body></html>";
      
    
?>