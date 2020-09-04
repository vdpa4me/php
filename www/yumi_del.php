<?php

/**
 * @author Kyumin Chang
 * @copyright 2016
 */

    require_once 'sql_conn.php';
    
    echo "<html><head>";
    echo '<meta charset="utf-8">';
    echo "<style>";
    echo "  table {";
    echo "    width: 100%";
    echo "    display: table;";
    echo "    border-collapse: collapse;";
    echo "    border-spacing: 2px;";
    echo "    border-color: gray;";
    echo "  }";
    echo "  table, th, td {";
    echo "    border: 1px solid black;";
    echo "  }";
    echo "  input[type=text]{";
    echo "       width: 100%; ";
    echo "       box-sizing: border-box;";
    echo "   }";
    echo "  tr:hover {background-color: #f5f5f5}";
    echo "</style>";
    echo "</head><body>";
    echo "<br>";   
    
 
    echo "<br>";   
    echo "Yumi Delete <br>";
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error){ 
        die($conn->connect_error);
        echo "DB connection failed" . "<br>";
        return;
    }
    
    
    if( !empty($_GET)){
        $query1 = 'DELETE FROM yumi WHERE main_key=' . $_GET['del'];
        $result1 = $conn->query($query1);
        if (!@result1){ 
            die($conn->error);
            echo "Query failed" . "<br>";
            return;
        }
    }
    
    $query = 'SELECT * FROM yumi ORDER BY main_key';
    $result = $conn->query($query);
    if (!@result){ 
        die($conn->error);
        echo "Query failed" . "<br>";
        return;
    }
     
        
    echo "<form>";
    echo "<table>";
    echo '<tr><td>No for deleting </td>   <td><input type="text" name="del" > </td></tr>'; 
    echo '<tr><td></td>         <td><input type="submit"></td></tr>';
    echo "</table>";
    echo "</form>";

    echo "<br><br><br>";
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
    echo "</body></html>";
?>