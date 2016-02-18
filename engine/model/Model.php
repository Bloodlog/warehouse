<?php
class Model
{
	private $GLOBALS;

	public function queryDb($query=null){
		// Подключаемся к СУБД MySQL.
		mysql_connect($GLOBALS['mysql']['host'],  $GLOBALS['mysql']['user'], $GLOBALS['mysql']['pass']);
		//or die("Could not connect: ".mysql_error());
		// Выбираем БД $db
		mysql_select_db($GLOBALS['mysql']['db']);
		//or die("Could not select database: ".mysql_error());
		mysql_query("SET NAMES ".$GLOBALS['mysql']['encoding']); 
		$result = mysql_query($query);
		return $result;
	}

    public function getAllData($table, $whereId=false,$where = false)
    {
    	$whr = '';
    	// Получаем все данные таблицы.
    	if($whereId) {
    		$whr = 'where `id` = '.(int)$whereId ;
    	}elseif($where){
    		$whr = $where;
    	}
		$query = "SELECT * FROM `$table` ".$whr;
		$result = $this->queryDb($query);
		return $result;


		// Запрашиваем идентификатор данных о полях таблицы.
		//$fields = mysql_num_fields($result);
    }
    
    /*
    	$table = (string) table
    	$data =  (array) ('name' => 'value1', 'descr' => 'value2')

    */
    public function createRecord($table=null, $data, $returnId=false){
	    $colums = str_replace ('\'','`',implode(",",array_keys($data)));
	    $values = implode("', '", $data);
	    $result = $this->queryDb("INSERT INTO `$table` ($colums) VALUES ('$values')");
	    return $returnId? mysql_insert_id() : $result;
    }

    public function updateRecord($table=null, $data, $whereId){
		$id = (int)$whereId;
		$i = 0;
		$query = '';
		$k='';
		foreach($data as $name=>$value)
		{
		    $name = str_replace ('\'','`', $name);
		    if($i>=1) $k = ', ';
		    $query .= $k . $name." = '".$value."' ";
		    $i++;
		}

		return $this->queryDb("UPDATE `$table` SET $query WHERE `id` = $id");
    }

    
    public function deleteRecord($table=null, $where){
    	return $this->queryDb("DELETE FROM `$table` WHERE {$where}");
    }
    public function truncateRecord($table=null){
    	return $this->queryDb("TRUNCATE `$table`");
    }


}
