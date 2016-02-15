<?php
/**
 * Created by PhpStorm.
 * User: MustafaHusain
 * Date: 6/8/14
 * Time: 3:23 PM
 */
class Dbase{
    private  $_hostname = 'localhost';
    private  $_password = '';
    private  $_user     = 'root';
    private  $_db       = 'ecommerce';

    private $_conn = false;
    public $_last_query = null;
    public $_affected_rows = 0;

    public $_insert_keys = array();
    public $_update_sets = array();
    public $_insert_values = array();

    public $_id;


    public function __construct(){
        $this->connect();
    }

    public function connect(){
        $this->_conn = mysqli_connect($this->_hostname,$this->_user,$this->_password,$this->_db);
        if(!$this->_conn){
            trigger_error("Connection failed: <br/> ".mysqli_error($this->_conn),E_USER_NOTICE);
        }
        else{
            $db = mysqli_select_db($this->_conn,$this->_db);
            if(!$db){
                trigger_error("Database connection failed: <br/> ".mysqli_error($this->_conn),E_USER_NOTICE);
            }
        }
        mysqli_set_charset($this->_conn,"utf8");
    }

    public function close(){
        if(!mysqli_close($this->_conn)){
            trigger_error("Failed to close the connection : <br/> ".mysqli_error($this->_conn),E_USER_NOTICE);
        }
    }

    public function escape($field){
        if(function_exists("mysqli_real_escape_string")){
            if(get_magic_quotes_gpc()){
                $field = stripslashes($field);
            }
            $field = mysqli_real_escape_string($this->_conn,$field);
        }
        else{
            if(!get_magic_quotes_gpc()){
                $field = addslashes($field);
            }
        }
        return $field;
    }

    public function query($query){
        $this->_last_query = $query;
        $result = mysqli_query($this->_conn,$query);
        $this->displayQuery($result);
        return $result;
    }

    public function displayQuery($result){
        if(!$result){
            $error = "Database query failed: ". mysqli_error($this->_conn) . "<br />";
            $error.= "Last SQL query was: ".$this->_last_query;
            echo ($error);
        }
    }

    public function fetchAll($query){
        $result = $this->query($query);
        $output = array();
        while($fetch = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $output[] = $fetch;
        }

       // echo "<pre>";
        //print_r($output);
        mysqli_free_result($result);
        return $output;
    }

    public function fetchOne($query){
        $output = $this->fetchAll($query);
        $reverse =  array_reverse($output);
        /* array_shift() pops the first element but has time complexity
            more than that of array_pop() when it comes to accessing more than 100 elements
            When using array_shift the entire remaining array has to be re-indexed every call.
            For a very short array this is negligible.
            When you start looking at much larger arrays, however, this overhead adds up quickly.
         */
        $pop = array_pop($reverse);
        return $pop;
    }

    public function lastId(){
        return mysql_insert_id($this->_conn);
    }

    public function prepareInsert($array=array()){
        if(!empty($array)){
            foreach($array as $key => $value){
                $this->_insert_keys[]  = $key;
                $this->_insert_values[] = $this->escape($value);
            }
        }
    }

    public function insert($table=null){
        if(!empty($table) && !empty($this->_insert_keys) && !empty($this->_insert_values)){
            $sql = "INSERT INTO `{$table }` (`";
            $sql.= implode("`, `",$this->_insert_keys);
            $sql.= "`) VALUES ('";
            $sql.= implode("', '",$this->_insert_values);
            $sql.="')";
            if ($this->query($sql)) {
                $this->_id = $this->lastId();
                return true;
            }
            return false;
            //echo $sql;
        }
    }

    public function prepareUpdate($array=array()){
        if(!empty($array)){
            foreach($array as $key => $value){
                $this->_update_sets[] = "`{$key}` = '".$this->escape($value)."'";
            }
        }
    }

    public function update($table=null,$id=null){
        if(!empty($table) && !empty($id)){
            $sql = "UPDATE `{$table}` SET ";
            $sql.= implode(", ",$this->_update_sets);
            $sql.= " WHERE `id` ='".$this->escape($id)."'";
            echo $sql;
            //return ($this->query($sql));
        }
    }
}

/****** Usage ************
$db = new Dbase();

$array = array(
  'name'=>'Mustafa',
  'surname'=>'Ujjainwala'
);
$db->prepareUpdate($array);
$db->update("names",2);
//$query = "Select * from `electronics_cat`";
//print_r($db->fetchOne($query));
/*********************/