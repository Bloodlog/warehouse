<?php
class Controller {
    
    public $model;
    public $view;
    public $auth;
    public $id;

    function __construct()
    {
    	//$this->id   = isset($_GET['id'])? $_GET['id'] : false;
    	$this->model = new Model();
    	$this->auth = new Auth();
        $this->view = new View();
    }
    
    function actionIndex()
    {
    }
}