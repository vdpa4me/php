<?php

/**
 * @author Kyumin Chang
 * @copyright 2016
 */


    function StringToBoolArray( $str )
    {
      $tmp_arr = str_split($str,1);
      $max = count($tmp_arr);
      $arr_bool = Array('bool' => 0);   
      for($i=0;$i<$max; $i++){
        if($tmp_arr[$i] == '1')
            $arr_bool[$i+1] = 1;
        else
            $arr_bool[$i+1] = 0;
      }
      
      return $arr_bool;
      
    } 
 

    function BoolArrayToString( $arr_bool )
    {
        $max = count($arr_bool);
        $str = "";
        for($i=1;$i<$max; $i++){
            if($arr_bool[$i] == 1)
                $str .= '1';
            else
                $str .= '0';
        }
        
        return $str;
    }
    
    function FailStringToBoolArray( $FailStr, $olv )
    {
        $max = $olv * 5;
        $arr_bool = Array('bool' => 0);  
        $temp_int = 0;
        
        for($i=1; $i<=$max ; $i++){
            $arr_bool[$i]=1;
        }
        
        $tok = strtok($FailStr, ",\n");
        while($tok !== false){
            $len1 = strlen(strstr($tok, 'l') );
            $len2 = strlen(strstr($tok, 'L') );
            if( ($len1 > 0) || ($len2 > 0 ) ){
                if($len1 > 0)
                    $tmp = str_replace('l','',$tok);
                else
                    $tmp = str_replace('L','',$tok);
                    
                $lv = (int)$tmp;
                //echo "tok:" . $tok . " tmp:"  . $tmp . " lv:" . $lv . "<br>";
                for($x=1; $x<=5 ; $x++){
                    $no = (($lv-1)*5) + $x;
                    $arr_bool[$no] = 0;
                }
            }
            else{
                $temp_int = (int)$tok;
                $arr_bool[$temp_int] = 0;
            }
            
            $tok = strtok(",\n");
                
        }
        
        return $arr_bool;
    }
    
    function BoolArrayToFailString( $arr_bool )
    {
        $max = count($arr_bool);
        $str = "";
        for($i=1;$i<$max; $i++){
            if($arr_bool[$i] == 0){
                $str .= ",";
                $str .= (String)($i);
            }
        } 
        $str = ltrim($str, ',');
        return $str;
    }
  /*
    $olv=22;
    $FailStr = "L10,L11,L12,L13,L14,L15,L16,L17";
    $arr_bool = FailStringToBoolArray( $FailStr, $olv);
    $max = count($arr_bool);
    
    for($i=1;$i<$max;$i++)
    {
        if($arr_bool[$i] == 0)
            echo "[". floor( (($i-1)/5)+1 ) .  "]" . "[" . $i . "]=" .  $arr_bool[$i] . "<br>";
    }
 */
    
    /*
    $clv = 5;
    $FailStr ="5,6,7";
    echo "FailStr: " . $FailStr . "<br>";
    $arr_bool = FailStringToBoolArray( $FailStr, $clv);
    $FailStr2 = "";
    echo "FailStr2: " . $FailStr2 . "<br>";
    $FailStr2 = BoolArrayToFailString($arr_bool);
    echo "FailStr2: " . $FailStr2 . "<br>";
    */
    
    
    
   // $str = "10101111";
   // echo "str: " . $str . "<br>";
   // $arr_bool = StringToBoolArray($str);
   // $str2 = BoolArrayToString($arr_bool);
   // echo "str2 : " . $str2 . "<br>";
 
 

?>