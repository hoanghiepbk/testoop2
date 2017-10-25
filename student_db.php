<?php
class student_db
{
 
    private static $__conn;
     
    
    static function connect()
    {
        
        if (!student_db::$__conn){
            
            student_db::$__conn = mysqli_connect('127.0.0.1', 'root','', 'qlsv_db') or die ('Lỗi kết nối');
 
            mysqli_query(student_db::$__conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
        }
    }
 
    
    function dis_connect(){
        if ($this->__conn){
            mysqli_close($this->__conn);
        }
    }
 
    static function insert($table, $data)
    {
        student_db::connect();
        $list = '';
        $value_list = '';
        foreach ($data as $key => $value){
            $list .= ",$key";
            $value_list .= ",'".($value)."'";
        }
        $sql = 'INSERT INTO '.$table. '('.trim($list, ',').') VALUES ('.trim($value_list, ',').')';
 
        return mysqli_query(student_db::$__conn, $sql);
    }
    static function update($table, $data, $where)
    {
        student_db::connect();
        $sql = '';
        foreach ($data as $key => $value){
            $sql .= "$key = '".($value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
 
        return mysqli_query(student_db::$__conn, $sql);
    }
 
    
    static function remove($table, $where){
        
        student_db::connect();
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query(student_db::$__conn, $sql);
    }
 
    public static function get_list($sql)
    {
        student_db::connect();
         
        $result = mysqli_query(student_db::$__conn, $sql);
 
        if (!$result){
            die ('Câu truy vấn bị sai');
        }
 
        $return = array();
        while ($row = mysqli_fetch_assoc($result)){
            $return[] = $row;
        }
 
        mysqli_free_result($result);
 
        return $return;
    }
    static function get_row($sql)
    {
        student_db::connect();
         
        $result = mysqli_query(student_db::$__conn, $sql);
 
        if (!$result){
            die ('Câu truy vấn bị sai');
        }
 
        $row = mysqli_fetch_assoc($result);
 
        mysqli_free_result($result);
 
        if ($row){
            return $row;
        }
 
        return false;
    }
}
?>