<?php

/**
 * Input User
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
    echo "Input Ben <br>";
       
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error){ 
        die($conn->connect_error);
        echo "DB connection failed" . "<br>";
        return;
    }

    //Check page_type       
    $i_main_key = 0;
    $i_date;
    $i_korean= "";
    $i_english= "";
    $i_foot = "";
    
    //default getting the latest ID
    $new_main_key = 0;
    $query = "SELECT * FROM ben_study";
    $result = $conn->query($query);
    if (!@result){ 
        die($conn->error);
        echo "Query failed" . "<br>";
        return;
    }
    $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows; ++$j )
    {
        $result->data_seek($j);
        $temp_key = $result->fetch_assoc() ['main_key'];
        if($temp_key > $new_main_key)
            $new_main_key = $temp_key;
    }
    $new_main_key = $new_main_key + 1;
    //
    
    if( (!empty($_GET)) && (!empty($_GET['del_id']))) { 
        echo "<br> delete <br>";
        $query1 = 'DELETE FROM ben_study WHERE main_key=' . $_GET['del_id'];
        $result1 = $conn->query($query1);
        if (!@result1){ 
            die($conn->error);
            echo "Query failed" . "<br>";
            return;
        }
        $i_main_key = $new_main_key;
        $i_main_key = $i_main_key - 1;
    }    
    else{
        $page_type = 0;   //0: display, 1: load data on format 2: insert, 3: update
        if( (!empty($_GET)) && (!empty($_GET['main_key']))) { 
            $i_main_key = $_GET['main_key'];
            if(  empty($_GET['korean']) ||
                 empty($_GET['english']) ) {
                 $page_type = 1;   //load
            }
            else{
                $query = "SELECT * FROM ben_study";
                $result = $conn->query($query);
                if (!@result){ 
                    die($conn->error);
                    echo "Query failed" . "<br>";
                    return;
                }
                $rows = $result->num_rows;
                for ($j = 0 ; $j < $rows; ++$j )
                {
                    $result->data_seek($j);
                    $temp_key = $result->fetch_assoc() ['main_key'];
                    if(  $i_main_key  == $temp_key ){
                        $page_type = 3;  //update 
                        break;
                    }
                }
                
                if($page_type == 0)
                    $page_type = 2; //insert 
            }
        }
              
        if($page_type == 1){  //load
            echo "<br>[DEBUG]load <br>";
            $query = "SELECT * FROM ben_study";
            $result = $conn->query($query);
            if (!@result){ 
                die($conn->error);
                echo "Query failed" . "<br>";
                return;
            }
            $rows = $result->num_rows;
            
            for ($j = 0 ; $j < $rows; ++$j )
            {
                $result->data_seek($j);
                $temp_key = $result->fetch_assoc() ['main_key'];
                
                if(  $i_main_key  == $temp_key ){
                    echo "<br> found <br>";
                    $result->data_seek($j);
                    $i_date = $result->fetch_assoc() ['date'];
                    $result->data_seek($j);
                    $i_korean = $result->fetch_assoc() ['korean']; 
                    $result->data_seek($j);
                    $i_english = $result->fetch_assoc() ['english'];
                    $result->data_seek($j);
                    $i_foot = $result->fetch_assoc() ['foot'];
    
                    break;
                }
            }
        }
        else if($page_type == 2){ //insert
            echo "<br>[DEBUG]insert <br>";
            $query1 = 'INSERT INTO ben_study (main_key,  date, korean, english, foot) VALUES(' 
                          . $_GET['main_key'] . ', ' 
                          . 'now(), ' 
                          . '\'' . $_GET['korean'] . ' \' , ' 
                          . '\'' . $_GET['english'] . ' \' , ' 
                          . '\'' . $_GET['foot'] . ' \' )' ;
            echo "<br>" . $query1 . "<br>";
            $result1 = $conn->query($query1);
            if (!@result1){ 
                die($conn->error);
                echo "Query failed" . "<br>";
            }
            $i_main_key = $new_main_key;
            $i_main_key = $i_main_key + 1;
        }
        else if($page_type == 3){ //update
            echo "<br>[DEBUG]update <br>";
            $query1 = 'UPDATE ben_study SET date=now() WHERE main_key=' . $_GET['main_key'];
            $result1 = $conn->query($query1);
            if (!@result1){ 
                die($conn->error);
                echo "Query failed" . "<br>";
                return;
            }
            $query1 = 'UPDATE ben_study SET korean=\'' . $_GET['korean'] .  '\' WHERE main_key=' . $_GET['main_key'];
            $result1 = $conn->query($query1);
            if (!@result1){ 
                die($conn->error);
                echo "Query failed" . "<br>";
                return;
            }
            $query1 = 'UPDATE ben_study SET english=\'' . $_GET['english'] .  '\' WHERE main_key=' . $_GET['main_key'];
            $result1 = $conn->query($query1);
            if (!@result1){ 
                die($conn->error);
                echo "Query failed" . "<br>";
                return;
            }
            $query1 = 'UPDATE ben_study SET foot=\'' . $_GET['foot'] .  '\' WHERE main_key=' . $_GET['main_key'];
            $result1 = $conn->query($query1);
            if (!@result1){ 
                die($conn->error);
                echo "Query failed" . "<br>";
                return;
            }  
            $i_main_key = $new_main_key;     
        }
        else{
            $i_main_key = $new_main_key;
        }
    }
    
    //input
    echo "<form>";
    echo "<table>";
    echo '<tr><td>No</td><td> <input type="text" name="main_key" value="'. $i_main_key . '" size="120"> </td></tr></tr>'; 
    echo '<tr><td>Korean </td><td> <input type="text" name="korean" value="' . $i_korean .  '" size="120"> </td></tr>'; 
    echo '<tr><td>English </td><td> <input type="text" name="english" value="' . $i_english  . '" size="120"> </td></tr>'; 
    echo '<tr><td>Foot note</td><td> <input type="text" name="foot" value="' . $i_foot  . '" size="120"> </td></tr>'; 
    echo '<tr><td></td><td><input type="submit" size="30"></td></tr>';
    echo "</table>";
    echo "</form>";
    echo "<br>";
    
    echo "<form>";
    echo "<table>";
    echo '<tr><td>No</td><td> <input type="text" name="del_id" size="30"> </td></tr></tr>'; 
    echo '<tr><td></td><td><input type="submit" size="30"></td></tr>';
    echo "</table>";
    echo "</form>";

    $query = "SELECT * FROM ben_study ORDER BY main_key DESC";
    $result = $conn->query($query);
    if (!@result){ 
        die($conn->error);
        echo "Query failed" . "<br>";
    }
    
    $rows = $result->num_rows;
    echo "<br><br>";
    echo "<table>";
    echo "<tr><td>No</td><td>Date</td><td>Korean</td><td>English</td><td>Footnote</td></tr>";
    for ($j = 0 ; $j < $rows; ++$j )
    {
        echo "<tr>";
        $result->data_seek($j);
        echo "<td>" . $result->fetch_assoc() ['main_key'] . "</td>";
        $result->data_seek($j);
        echo "<td>" . $result->fetch_assoc() ['date'] . "</td>";
        $result->data_seek($j);
        echo "<td>" . $result->fetch_assoc() ['korean'] . "</td>";
        $result->data_seek($j);
        echo "<td>" . $result->fetch_assoc() ['english'] . "</td>";
        $result->data_seek($j);
        echo "<td>" . $result->fetch_assoc() ['foot'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";   
    echo "</body></html>";                   
            
           
?>