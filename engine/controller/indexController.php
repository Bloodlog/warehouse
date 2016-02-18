<?php
class IndexController extends Controller
{
    function actionIndex()
    {	
        $this->view->generate('index.php', 'main');
    }
}