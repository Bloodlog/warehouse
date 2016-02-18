<?php
class WarehouseModel extends Model
{
	public function getDebitTable(){
		$page = $_GET['page']; // get the requested page
        $limit = $_GET['rows'] -1; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction

        /*
        $limit = 10;
        $page=1;
        */
		if(!$sidx) $sidx =1;
		// connect to the database
		//$result = $this->queryDb("SELECT COUNT(*) AS count FROM product a, clients b WHERE a.client_id=b.client_id");
		$result = $this->queryDb("SELECT COUNT(*) AS count FROM `debit`");
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];

		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
		//$SQL = "SELECT a.id, a.invdate, b.name, a.amount,a.tax,a.total,a.note FROM product a, clients b WHERE a.client_id=b.client_id ORDER BY $sidx $sord LIMIT $start , $limit";
		$SQL = "SELECT * FROM debit  ORDER BY $sidx $sord LIMIT $start , $limit";
		
		$result = $this->queryDb( $SQL ) or die("Couldn t execute query.".mysql_error());
		$responce = new stdClass;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		    $responce->rows[$i]['id']=$row['id'];
		    $responce->rows[$i]['cell']=array($row['id'],$row['name'],$row['author'],$row['createtime']);
		    $i++;
		}        
		return json_encode($responce);
	}

	public function getShipTable(){
		$page = $_GET['page']; // get the requested page
        $limit = $_GET['rows'] -1; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction

        /*
        $limit = 10;
        $page=1;
        */
		if(!$sidx) $sidx =1;
		// connect to the database
		//$result = $this->queryDb("SELECT COUNT(*) AS count FROM product a, clients b WHERE a.client_id=b.client_id");
		$result = $this->queryDb("SELECT COUNT(*) AS count FROM `ship`");
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];

		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
		//$SQL = "SELECT a.id, a.invdate, b.name, a.amount,a.tax,a.total,a.note FROM product a, clients b WHERE a.client_id=b.client_id ORDER BY $sidx $sord LIMIT $start , $limit";
		$SQL = "SELECT * FROM ship  ORDER BY $sidx $sord LIMIT $start , $limit";
		
		$result = $this->queryDb( $SQL ) or die("Couldn t execute query.".mysql_error());
		$responce = new stdClass;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		    $responce->rows[$i]['id']=$row['id'];
		    $responce->rows[$i]['cell']=array($row['id'],$row['name'],$row['author'],$row['createtime']);
		    $i++;
		}        
		return json_encode($responce);
	}
	public function getProduct($param){
		//$param = utf8_encode($param);
		$SQL = "SELECT * FROM product WHERE name like '%$param%'";
		$result = $this->queryDb( $SQL ) or die("Couldn t execute query.".mysql_error());
		//строим массив результата/ы
		$i=0;
		$responce = new stdClass;
		//$rows = array();
		$returnArr = array();
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		    /* $responce->rows[$i]['id']=$row['id'];
		    $responce->rows[$i]['name']=$row['name'];*/
		    //$rows[$i]['product'] = $row['name'];
		    //$rows[$i]['id'] = array($row['name'] => $row['id']);
		    //$responce->label[$i] = array('label'=>$row['name'], 'value' => $row['id']);
		    // $responce->label[$i] = $row['name'];
		    //$responce->value[$i] = $row['id'];
		    $currval 		  = array();
		    $currval['label'] = $row['name'];
		    $currval['id']    = $row['id'];
		    array_push($returnArr, $currval);
		    //$responce->id[$i] =  $row['id'];
		    //$rows[$i]['id'] = $row['id'];
			//$rows[$i]['id'] = $row['id'];
		    $i++;
		}        
		return json_encode($returnArr);
	}
	public function getStockTable(){
		$page = $_GET['page']; // get the requested page
        $limit = $_GET['rows'] -1; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction

        /*
        $limit = 10;
        $page=1;
        */
		if(!$sidx) $sidx =1;
		// connect to the database
		//$result = $this->queryDb("SELECT COUNT(*) AS count FROM product a, clients b WHERE a.client_id=b.client_id");
		$result = $this->queryDb("SELECT COUNT(*) AS count FROM `product`");
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];

		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
		//$SQL = "SELECT a.id, a.invdate, b.name, a.amount,a.tax,a.total,a.note FROM product a, clients b WHERE a.client_id=b.client_id ORDER BY $sidx $sord LIMIT $start , $limit";
		$SQL = "SELECT q.product_id, q.quantity, p.id, p.article, p.name, p.manufacturer FROM quantity AS q, product AS p WHERE q.product_id = p.id ORDER BY $sidx $sord LIMIT $start , $limit";
		
		$result = $this->queryDb( $SQL ) or die("Couldn t execute query.".mysql_error());
		$responce = new stdClass;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		    $responce->rows[$i]['id']=$row['id'];
		    $responce->rows[$i]['cell']=array($row['product_id'],$row['article'],$row['name'],$row['manufacturer'],$row['quantity']);
		    $i++;
		}        
		return json_encode($responce);
	}

	public function getQuantityTable(){

	}
	public function getWarehouseTable(){

	}
}
?>