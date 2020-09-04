<?php

/**
 * Sentenses Menu
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
    echo "Sentences <br>";
    $max_index = 0;
    $temp_index = 0;
    
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error){ 
        die($conn->connect_error);
        echo "DB connection failed" . "<br>";
    }
    else{  
        $query = "SELECT * FROM sentences ORDER BY main_key";
        $result = $conn->query($query);
        if (!@result){ 
            die($conn->error);
            echo "Query failed" . "<br>";
        }
        else{
            //Get the max index
            $rows = $result->num_rows;
            $max_lv = $rows/5;
            
            
            echo 'Rows =' . $rows . '<br>';
            echo 'max_lv=' . $max_lv . '<br>';
            for ($j = 1 ; $j <= $max_lv; ++$j )
            {
               echo "<br> <a href=\"sentences.php?lv=" . $j . "\" target=\"right\">LV" . $j . "</a>"; 
            }
            
        }
        
        
        
        
    }
    
    echo "</body></html>";
        
?>