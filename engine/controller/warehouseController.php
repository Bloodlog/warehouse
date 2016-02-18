<?php
class WarehouseController extends Controller{
    public $table = 'warehouse';
    public function permission(){
        $perm = array(
                     'index',
                );
    }
    function __construct()
    {
        $this->model = new WarehouseModel();
        $this->view = new View();
    }
    public function actionIndex(){
    	$this->view->generate('index.php', 'main');
    }

    public function actionShip(){
    	$this->view->generate('ship/ship.php', 'main');
    }
    public function actionShipcreate(){
        $this->table = 'ship';
        @$save = $_POST['save'];
        if($save){
            $formData = $_POST['form'];
            $timestump = time();
            $formData['timestump'] = $timestump;
            $resultID = $this->model->createRecord($this->table,$formData, true);
            $formTable = $_POST['form_table'];
            $tableStock = $this->table.'-stock';

            for ($i=0, $k=1; $i < count($formTable); $k++ , $i++) { 
                $formTable[$k]['ship_id'] = $resultID;
                $error[] = $this->model->createRecord($tableStock,$formTable[$k]);
            }
            //var_dump($error);
            //die();
            header("Location: /warehouse/ship/");
        }
        $this->view->generate('ship/create.php', 'main');
    }
    public function actionShipupdate(){
        $this->table = 'ship';
        $tableStock = $this->table.'-stock';
        $id = (int)$_GET['id'];
        $data['id']= $id;
        @$save = $_POST['save'];
        if($save){
            $formData = $_POST['form'];
            $timestump = time();
            $formData['timestump'] = $timestump;
            $result = $this->model->updateRecord($this->table,$formData,$id);
            $formTable = $_POST['form_table'];
            //удаляем предыдущие записи от таблицы
            $this->model->deleteRecord($tableStock,"ship_id = ".$id);
            //создаём новые записи таблицы
            for ($i=0, $k=1; $i < count($formTable); $k++ , $i++) { 
                $formTable[$k]['ship_id'] = $id;
                $error[] = $this->model->createRecord($tableStock,$formTable[$k]);
            }
            //Надо удалить всё что связано в table-stock к ship, а потом заполнить
            header("Location: /warehouse/ship/");
        }
        $resultShip = $this->model->getAllData($this->table,$id);
        $data['ship'] = mysql_fetch_assoc($resultShip);
        $shipId = $data['ship']['id'];
        $resultTable = $this->model->queryDb("SELECT d.product_id, d.ship_id, d.quantity, p.id, p.name FROM `ship-stock` AS d , `product` AS p where d.product_id = p.id AND d.ship_id = ".$shipId);
        $data['table'] =$resultTable;
        $this->view->generate('ship/update.php', 'main', $data);
    }
    public function actionStock(){
        $tableProduct =$this->model->getAllData('product');
        $quantity = array();
        while($rowProduct = mysql_fetch_assoc($tableProduct)){
            $productId = $rowProduct['id'];
            $resultDebit = $this->model->getAllData('debit-stock', false,  ' where product_id = ' .$productId);
            $quantity[$productId] = 0;

            while ($rowDebit = mysql_fetch_assoc($resultDebit)) {
                $quantity[$productId] += $rowDebit['quantity'];
            }

            $resultShip = $this->model->getAllData('ship-stock',false, 'where product_id = '.$productId);
            while ($rowShip = mysql_fetch_assoc($resultShip)) {
                $quantity[$productId] -= $rowShip['quantity'];
            }
        }
        $this->model->truncateRecord('quantity');
        foreach ($quantity as $key=>$value) {
            $arr['product_id'] = $key;
            $arr['quantity'] = $value;
            $this->model->createRecord('quantity',$arr);
        }
        $this->view->generate('stock/stock.php', 'main');
    }

    public function actionSearchproduct(){
        // допустим, функция findAutocomplete ищет слова (например в БД) по 
        // заданной подстроке и возвращает массив с подходящими словами.
        $elements = $this->model->getProduct($_GET['term']);
        /*$s = "[".implode(",", $elements)."]";
        echo $s;*/
        echo $elements;
        // в итоге, ответ будет содержать примерно следующее  ["finded_1", "finded_2", "finded_3", ...]
    }

    public function actionDebit(){
        $this->view->generate('debit/debit.php', 'main');
    }

    public function actionDebitcreate(){
        $this->table = 'debit';
    	@$save = $_POST['save'];
        if($save){
            $formData = $_POST['form'];
            $timestump = time();
            $formData['timestump'] = $timestump;            
            $resultID = $this->model->createRecord($this->table,$formData, true);
            $formTable = $_POST['form_table'];
            $tableStock = $this->table.'-stock';

            for ($i=0, $k=1; $i < count($formTable); $k++ , $i++) { 
                $formTable[$k]['debit_id'] = $resultID;
                $error[] = $this->model->createRecord($tableStock,$formTable[$k]);
            }
            //var_dump($error);
            //die();
            header("Location: /warehouse/debit/");
        }
        $this->view->generate('debit/create.php', 'main');
    }

    public function actionDebitupdate(){
        $this->table = 'debit';
        $tableStock = $this->table.'-stock';
        $id = (int)$_GET['id'];
        $data['id']= $id;
        @$save = $_POST['save'];
        if($save){
            $formData = $_POST['form'];
            $timestump = time();
            $formData['timestump'] = $timestump;
            $result = $this->model->updateRecord($this->table,$formData,$id);
            $formTable = $_POST['form_table'];
            //удаляем предыдущие записи от таблицы
            $this->model->deleteRecord($tableStock,"debit_id = ".$id);
            //создаём новые записи таблицы
            for ($i=0, $k=1; $i < count($formTable); $k++ , $i++) { 
                $formTable[$k]['debit_id'] = $id;
                $error[] = $this->model->createRecord($tableStock,$formTable[$k]);
            }
            //Надо удалить всё что связано в table-stock к debit, а потом заполнить
            header("Location: /warehouse/debit/");
        }
        $resultDebit = $this->model->getAllData($this->table,$id);
        $data['debit'] = mysql_fetch_assoc($resultDebit);
        //$row = mysql_fetch_assoc($resultDebit);
        $debitId = $data['debit']['id'];
       // $resultTable = $this->model->getAllData($tableStock,false, 'where `debit_id` = '.$debitId);
        $resultTable = $this->model->queryDb("SELECT d.product_id, d.debit_id, d.quantity, d.price, p.id, p.name FROM `debit-stock` AS d , `product` AS p where d.product_id = p.id AND d.debit_id = ".$debitId);
        //var_dump(mysql_fetch_assoc($resultTable));
        //die();
        $data['table'] =$resultTable;
        $this->view->generate('debit/update.php', 'main', $data);
    }
    //Анализ себестоимости
    function actionCostprice(){

        $result=$this->model->queryDb("SELECT * FROM `debit` ORDER BY timestump ASC");
        while($row = mysql_fetch_assoc($result)){
            //var_dump($row);
            echo $row['createtime'].'<br>';
        }
    }


    /*For table only*/
    function actionGettable(){
        echo $this->model->getProductAll();
    }
    function actionGetDebitTable(){
    	echo $this->model->getDebitTable();
    }
    function actionGetShipTable(){
        echo $this->model->getShipTable();
    }
    function actionGetStockTable(){
        echo $this->model->getStockTable();
    }
}