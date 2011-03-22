<?php

class Consql {
        
    //insert a row into the select table of database.
    function insert_row($table, $insert_string){ 
        $error = '';
        $columns = '';
        $insert_row= '';
        $num = 0;

        foreach($insert_string as $key=>$value){
            if($num == count($insert_string)-1){
                $columns .= "$key";
                $insert_row .= "'$value'";
            }else{
                $columns .= "$key,"; 
                $insert_row .= "'$value',";
            }
            $num++;
        }

        $result = mysql_query("INSERT  INTO $table ($columns) VALUES ($insert_row)");
        if($result){  $result = "sucessful insert a row\n";
        }else  $result = "fail\n";
        return $result.$error;
    }
    /**Example 
    $data = "<div><span>fjdaskljfpqwhfohdsfjsdajfklj0-832upfsnc,vsbhaugsda</span></div>";
    $arr_columns = array (
        'address' => $data,
        'age' => 21 ,
    );
    echo insert_row('admin',$arr_columns);
    **/
    
    function update_row($table,$update_string,$where_string){

        $up_string = '';
        $wh_string = '';
        $num_update = 0;
        $num_where = 0;

        foreach($update_string as $key=>$value){
            if($num_update == count($update_string)-1){
                $up_string .= "$key = '$value'";
            }else{
                $up_string .= "$key = '$value', ";
            }
            $num_update++;
        }
        foreach($where_string as $key=>$value){
            if($num_where == count($where_string)-1){
                $wh_string .= "$key = '$value'";
            }else{
                $wh_string .= "$key = '$value' AND ";
            }
            $num_where++;
        }

        $sql = "UPDATE $table SET $up_string WHERE $wh_string";
        $result = mysql_query("UPDATE $table SET $up_string WHERE $wh_string");
        if($result){
            $result = "secessful update row\n";
        }else{
            $result = "fail update row\n";
        }
        return $result."your sql :\n$sql\n";
        //return $sql;
    }

    function rand_num($count,$start_num,$end_num){

            $num_string = '';
        for($i=0; $i<$count-1; $i++){
            $num_string .= rand($start_num,$end_num);
        }
            return $num_string;
    }

    function get_last($table,$field){
        $result = mysql_query("select * from $table");
        $rownum = mysql_num_rows($result);
        mysql_data_seek($result,$rownum-1);
        $row = mysql_fetch_assoc($result);

        return $row[$field];
    }

    
}

?>
