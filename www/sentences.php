<?php

/**
 * @author Kyumin Chang
 * @copyright 2016
 */

    require_once 'sql_conn.php';
    
    $lv = $_GET['lv'];
    
    echo "<br>";   
    echo "Level " . $lv . "<br>";
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error){ 
        die($conn->connect_error);
        echo "DB connection failed" . "<br>";
    }
    else{
        $query = "SELECT * FROM sentences WHERE level LIKE {$lv} ORDER BY main_key";
        $result = $conn->query($query);
        if (!@result){ 
            die($conn->error);
            echo "Query failed" . "<br>";
        }
        else{
            echo "<br>";
            echo "<table>";
            $rows = $result->num_rows;
            for ($j = 0 ; $j < $rows; ++$j )
            {
                echo "<tr>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['main_key'] . "</td>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['korean'] . "</td>";
                $result->data_seek($j);
                echo "<td>" . $result->fetch_assoc() ['english'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    
?>