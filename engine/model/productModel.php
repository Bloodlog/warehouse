<?php
class ProductModel extends Model
{
	/*For product table*/
	public function getProductAll(){
		//$page = 1;
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
		$SQL = "SELECT * FROM product  ORDER BY $sidx $sord LIMIT $start , $limit";
		
		$result = $this->queryDb( $SQL ) or die("Couldn t execute query.".mysql_error());
		$responce = new stdClass;
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		    $responce->rows[$i]['id']=$row['id'];
		    $responce->rows[$i]['cell']=array($row['id'],$row['article'],$row['name'],$row['manufacturer'],$row['del']);
		    $i++;
		}        
		return json_encode($responce);
	}
}