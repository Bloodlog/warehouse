<?php
class ProductController extends Controller{
    public $table = 'product';
    public function permission(){
        $perm = array(
                     'index',
                );
    }

    function __construct()
    {
        $this->model = new ProductModel();
        $this->view = new View();
    }

	function actionIndex()
    {
        //$data['table'] = $this->model->getAllData($this->table);
    	//echo $this->id;
        $this->view->generate('index.php', 'main');
    }
    function actionCreate(){
        @$save = $_POST['save'];
        if($save){
            $formData = $_POST['form'];
            $result = $this->model->createRecord($this->table,$formData);
            header("Location: /product/index/");
        }
        $this->view->generate('create.php', 'main');
        //$this->view->generate('index.php', 'main');
    }
    function actionUpdate(){
        $id = (int)$_GET['id'];
        $result = $this->model->getAllData($this->table, $id);
        $data['product'] = mysql_fetch_assoc($result);
        @$save = $_POST['save'];
        if($save){
            $formData = $_POST['form'];
            //собрать все данные с формы и обновить id записи
            $result = $this->model->updateRecord($this->table,$formData,$id);
            header("Location: /product/index/");   
        }
        $this->view->generate('update.php', 'main',$data);
    }
    /*For table only*/
    function actionGettable(){
        echo $this->model->getProductAll();
    }
}