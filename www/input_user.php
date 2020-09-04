<?php

/**
 * Input User
 * @author Kyumin Chang
 * @copyright 2016
 */


    require_once 'util_string.php';
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
    echo "Input User <br>";
    $max_index = 0;
    $temp_index = 0;
    
    $i_id = "";
    $i_pw ="";
    $i_name = "";
    $i_email = "";
    $i_clv = 0;
    $i_olv = 0;
    $i_gold = 0;
    $i_olvd ="";
    $isModify = 0;
    $isKeyAlready = 0;
    
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error){ 
        die($conn->connect_error);
        echo "DB connection failed" . "<br>";
        return;
    }
     
    if( !empty($_GET)){
        if(  !empty($_GET['id']) ){
             if(  empty($_GET['clv']) ){
                //Just bring up a specific data 
                echo "<br> Bring up data : Press Submit Query to update <br>";
                $isModify = 1;
                $i_id = $_GET['id'];
             }
             else{ 
                //input or update 
                $i_id = $_GET['id'];
            
                $query1 = "SELECT * FROM user";
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
                    $temp_id = $result1->fetch_assoc() ['id'];
                    $temp_id = trim($temp_id);
                    $i_id = trim($i_id);
                    $res = strcmp($temp_id, $i_id);
                    if(  $res == 0 ){
                        $isKeyAlready = 1;  //if there is the same id in the db
                    }
                }
              
                if($isKeyAlready){
                    //Update
                    echo "<br> Data was updated <br>";
                  
                    $query1 = 'UPDATE user'. ' SET clv=' . $_GET['clv'] .  ' WHERE id=' . '\'' . $_GET['id'] . '\'';
                     echo 'UPDATE user'. ' SET clv=' . $_GET['clv'] .  ' WHERE id=' . '\'' . $_GET['id'] . '\''."<br>";
                     $result = $conn->query($query1);
                     if (!@result){ 
                        die($conn->error);
                        echo "Query failed" . "<br>";
                        return;
                     }
                    $query1 = 'UPDATE user'. ' SET olv=' . $_GET['olv'] .  ' WHERE id=' . '\'' . $_GET['id'] . '\'';
                     echo 'UPDATE user'. ' SET olv=' . $_GET['olv'] .  ' WHERE id=' . '\'' . $_GET['id'] . '\''."<br>";
                     $result = $conn->query($query1);
                     if (!@result){ 
                        die($conn->error);
                        echo "Query failed" . "<br>";
                        return;
                     }
                    $query1 = 'UPDATE user'. ' SET gold=' . $_GET['gold'] .  ' WHERE id=' . '\'' . $_GET['id'] . '\'';
                     echo 'UPDATE user'. ' SET gold=' . $_GET['gold'] .  ' WHERE id=' . '\'' . $_GET['id'] . '\''."<br>";
                     $result = $conn->query($query1);
                     if (!@result){ 
                        die($conn->error);
                        echo "Query failed" . "<br>";
                        return;
                     }
                     //olvd
                     $query1 = 'UPDATE user'. ' SET olvd=\'' . $_GET['olvd'] .  '\' WHERE id=' . '\'' . $_GET['id'] . '\'';
                     echo 'UPDATE user'. ' SET olvd=\'' . $_GET['olvd'] .  '\' WHERE id=' . '\'' . $_GET['id'] . '\'' ."<br>";
                     $result = $conn->query($query1);
                     if (!@result){ 
                        die($conn->error);
                        echo "Query failed" . "<br>";
                        return;
                     }
                     
                }
                else{
                    //Insert a new data
                     echo "<br> Data was inputed <br>";
                     $query1 = 'INSERT INTO user (id,  pw, name, email, clv, olv, gold, olvd) VALUES(' 
                                  . '\'' . $_GET['id'] . ' \' , ' 
                                  . '\'' . $_GET['pw'] . ' \' , ' 
                                  . '\'' . $_GET['name'] . ' \' , ' 
                                  . '\'' . $_GET['email'] . ' \' , ' 
                                  . $_GET['clv'] . ' , ' 
                                  . $_GET['olv'] . ' , ' 
                                  . $_GET['gold'] . ' , ' 
                                  . $_GET['olvd'] . ')';
                     $result = $conn->query($query1);
                     if (!@result){ 
                        die($conn->error);
                        echo "Query failed" . "<br>";
                    }
                }
                
             }
        }
    }

    $query = "SELECT * FROM user";
    $result = $conn->query($query);
    if (!@result){ 
        die($conn->error);
        echo "Query failed" . "<br>";
    }
  
    //Get the max index
    $rows = $result->num_rows;
    if($isModify == 1){
        for ($j = 0 ; $j < $rows; ++$j )
        {
            $result->data_seek($j);
            $temp_id = $result->fetch_assoc() ['id'];
            $temp_id = trim($temp_id);
            $i_id = trim($i_id);
            $res = strcmp($temp_id, $i_id);
            if(  $res == 0 ){
                $result->data_seek($j);
                $i_pw = $result->fetch_assoc() ['pw'];
                $result->data_seek($j);
                $i_name = $result->fetch_assoc() ['name']; //$_GET['name'];
                $result->data_seek($j);
                $i_email = $result->fetch_assoc() ['pw'];// $_GET['email'];
                $result->data_seek($j);
                $i_clv = $result->fetch_assoc() ['clv'];//$_GET['clv'];
                $result->data_seek($j);
                $i_olv = $result->fetch_assoc() ['olv'];//$_GET['olv'];
                $result->data_seek($j);
                $i_gold = $result->fetch_assoc() ['gold'];//$_GET['gold'];
                $result->data_seek($j);
                $i_olvd = $result->fetch_assoc() ['olvd'];//$_GET['gold'];
                break;
            }
        
        }
    }
 
            
    //input
    echo "<form>";
    echo "<table>";
    echo '<tr><td>ID</td><td> <input type="text" name="id" value="'. $i_id . '" size="30"> </td></tr></tr>'; 
    //echo '<tr><td>Password</td><td> <input type="text" name="pw" value="' . $i_pw  . '" size="30"> </td></tr>'; 
    echo '<tr><td>Name</td><td> <input type="text" name="name" value="' . $i_name .  '" size="30"> </td></tr>'; 
    //echo '<tr><td>Email</td><td> <input type="text" name="email" value="' . $i_email .'"  size="30"> </td></tr>'; 
    echo '<tr><td>Class Level</td><td> <input type="text" name="clv" value="' . $i_clv .  '" size="30"> </td></tr>'; 
    echo '<tr><td>Optained Level</td><td> <input type="text" name="olv" value="' . $i_olv  . '" size="30"> </td></tr>'; 
    echo '<tr><td>Gold</td><td> <input type="text" name="gold" value="' . $i_gold  . '" size="30"> </td></tr>'; 
    echo '<tr><td>Faild NO</td><td> <input type="text" name="olvd" value="' . $i_olvd  . '" size="30"> </td></tr>'; 
    echo '<tr><td></td><td><input type="submit" size="30"></td></tr>';
    echo "</table>";
    echo "</form>";

    echo "<br><br>";
    
    echo "<table>";
    $rows = $result->num_rows;
     echo "<tr><td>ID</td><td>Name</td><td>clv</td> <td>olv</td> <td>gold</td><td>Failed NO</td></tr>";
    for ($j = 0 ; $j < $rows; ++$j )
    {
        
        echo "<tr>";
        $result->data_seek($j);
        echo "<td>" . $result->fetch_assoc() ['id'] . "</td>";
        //$result->data_seek($j);
        //echo "<td>" . $result->fetch_assoc() ['pw'] . "</td>";
        $result->data_seek($j);
        echo "<td>" . $result->fetch_assoc() ['name'] . "</td>";
        //$result->data_seek($j);
        //echo "<td>" . $result->fetch_assoc() ['email'] . "</td>";
        $result->data_seek($j);
        echo "<td>" . $result->fetch_assoc() ['clv'] . "</td>";
        $result->data_seek($j);
        echo "<td>" . $result->fetch_assoc() ['olv'] . "</td>";
        $result->data_seek($j);
        echo "<td>" . $result->fetch_assoc() ['gold'] . "</td>";
        $result->data_seek($j);
        echo "<td>" . $result->fetch_assoc() ['olvd'] . "</td>";
        echo "</tr>";
 
    }
    echo "</table>";
    
    echo "<br>";
    echo "<br>";      
    
    if($i_clv == 0)
        return;
        
    $query_st = "SELECT * FROM sentences WHERE level <=" . $i_clv;
    echo "SELECT * FROM sentences WHERE level <=" . $i_clv ."<br>";
    $result_st = $conn->query($query_st);
    if (!@result_st){ 
        die($conn->error);
        echo "Query failed" . "<br>";
    }
    $rows_st = $result_st->num_rows;
    
    echo "<table>";
    echo "<tr><td>No</td><td>LV</td><td>Kor</td><td>Eng</td></tr>";
    for ($j = 0 ; $j < $rows_st; ++$j )
    {
        echo "<tr>";
        $result_st->data_seek($j);
        echo "<td>" . $result_st->fetch_assoc() ['main_key'] . "</td>";
        $result_st->data_seek($j);
        echo "<td>" . $result_st->fetch_assoc() ['level'] . "</td>";
        $result_st->data_seek($j);
        echo "<td>" . $result_st->fetch_assoc() ['korean'] . "</td>";
        $result_st->data_seek($j);
        echo "<td>" . $result_st->fetch_assoc() ['english'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";   
        
        
        
   
    
    echo "</body></html>";
      
    
?>