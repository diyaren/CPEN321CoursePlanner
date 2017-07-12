<?php

/*
http://stackoverflow.com/questions/3228694/php-database-connection-class
*/

class Mysql{

    private $connObj;
    public $connectionString;
    public $dataSet;
    private $sqlQuery;

    protected $databaseName;
    protected $serverName;
    protected $userName;
    protected $password;

function __construct() {
    $this -> connObj = NULL;
    $this -> connectionString = NULL;
    $this -> sqlQuery = NULL;
    $this -> dataSet = NULL;
    $this -> databaseName = 'courseplanner';
    $this -> serverName = 'courseplanner.cs9msqhnvnqr.us-west-2.rds.amazonaws.com';
    $this -> userName = 'courseplanner';
    $this -> password = 'cpen3210';
    $this -> dbConnect();
}

public function getConnection(){
    if( $this -> connObj -> connect_error ){
	$this -> connObj -> close();
	$this -> dbConnect();   
    }
    return $this -> connObj;
}

private function dbConnect()    {
    //$this -> connectionString = mysql_connect($this -> serverName,$this -> userName,$this -> password);
    //mysql_select_db($this -> databaseName,$this -> connectionString);

    $this -> connObj = new mysqli($this -> serverName,$this -> userName,$this -> password, $this -> databaseName);
    //return $this -> connectionString;
}

function dbDisconnect() {
    $this -> connectionString = NULL;
    $this -> sqlQuery = NULL;
    $this -> dataSet = NULL;
    $this -> databaseName = NULL;
    $this -> serverName = NULL;
    $this -> userName = NULL;
    $this -> password = NULL;
    $this -> connObj -> close();
}

function selectAll($tableName)  {
    $this -> sqlQuery = 'SELECT * FROM '.$this -> databaseName.'.'.$tableName;
    //$this -> dataSet = mysql_query($this -> sqlQuery,$this -> connectionString);
    $this -> dataSet = $this -> connObj -> query($this -> sqlQuery);
    return $this -> dataSet;
}

function selectWhere($tableName,$rowName,$operator,$value,$valueType)   {
    $this -> sqlQuery = 'SELECT * FROM '.$tableName.' WHERE '.$rowName.' '.$operator.' ';
    if($valueType == 'int') {
        $this -> sqlQuery .= $value;
    }
    else if($valueType == 'char')   {
        $this -> sqlQuery .= "'".$value."'";
    }
    $this -> dataSet = $this -> connObj -> query($this -> sqlQuery);
    //$this -> dataSet = mysql_query($this -> sqlQuery,$this -> connectionString);
    $this -> sqlQuery = NULL;
    return $this -> dataSet;
}

function insertInto($tableName,$values) {
    $i = NULL;

    $this -> sqlQuery = 'INSERT INTO '.$tableName.' VALUES (';
    $i = 0;
    while($values[$i]["val"] != NULL && $values[$i]["type"] != NULL)    {
        if($values[$i]["type"] == "char")   {
            $this -> sqlQuery .= "'";
            $this -> sqlQuery .= $values[$i]["val"];
            $this -> sqlQuery .= "'";
        }
        else if($values[$i]["type"] == 'int')   {
            $this -> sqlQuery .= $values[$i]["val"];
        }
        $i++;
        if($values[$i]["val"] != NULL)  {
            $this -> sqlQuery .= ',';
        }
    }
    $this -> sqlQuery .= ')';
    #echo $this -> sqlQuery;
    return $this -> connObj -> query($this -> sqlQuery);
    //mysql_query($this -> sqlQuery,$this -> connectionString);
    //return $this -> sqlQuery;
    #$this -> sqlQuery = NULL;
}

function selectFreeRun($query)  {
    $this -> dataSet = $this -> connObj -> query($query);
    //$this -> dataSet = mysql_query($query,$this -> connectionString);
    return $this -> dataSet;
}

function freeRun($query)    {
    return $this -> connObj -> query($query);
    //return mysql_query($query,$this -> connectionString);
}
}

?>
