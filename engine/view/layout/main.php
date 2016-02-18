<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Главная</title>
    <script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>

    <script type="text/javascript" src="/js/jqueryui/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/jqueryui/jquery-ui.min.css">
    
    <script type="text/javascript" src="/js/grid.locale-ru.js"></script>
    <script type="text/javascript" src="/js/jquery.jqGrid.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/ui.jqgrid.css">

    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <style media='print' type='text/css'>
    	body{
    		height: 100%;
    		margin: 0;
    		font-weight: bold;
    	}
		header {
			display: none;
		}
		.right-block{
			display: none;
		}
		footer{
			display: none;
		}
		table{
			font-size: 14px;
			table-layout: auto;
			width: 100%;
			height: 100%;
			border: 1;
		}
		.ui-jqgrid tr.ui-row-ltr td{
			border-right-color: black;
		}
		.ui-jqgrid tr.jqgrow td{
			white-space: normal;
			border-bottom-color: black;
		}
		.ui-jqgrid .ui-jqgrid-titlebar{
			color: black;
			font-size: 16px;
		}
		.ui-jqgrid .ui-jqgrid-htable th div{
			color: black;
			font-size:14px;
		}
		.ui-jqgrid .ui-jqgrid-view{
			font-size: 14px !important;
		}
		.ui-jqgrid tr.jqgrow td{
			height: 26px !important;
		}

	</style>
</head>
<body>
	<header>
		<nav id="menu">
			<ul>
				<a href="/index"><li><img src="/img/category/main.png" title="Главная">Главная</li></a>
				<a href="/product/"><li><img src="/img/category/product.png" title="Товары">Товары</li></a>
				<a href="/warehouse/"><li><img src="/img/category/warehouse.png" title="Склад">Склад</li></a>
				<a href=""><li><img src="/img/category/purchases.png" title="Закупки">Закупки</li></a>
				<a href=""><li><img src="/img/category/organizer.png" title="Органайзер">Органайзер</li></a>
				<a href=""><li><img src="/img/category/admin.png" title="Настройки">Настройки</li></a>
			</ul>
		</nav>
	</header>
	<div id="content">
   		<?php include ($patch.$content_view); ?>
   			<hr>
	</div>

    <footer>
    Copyright &copy; <?php echo date('Y'); ?> by <a href="http://web-fomin.ru">Fomin Maxim</a>.<br/>
		All Rights Reserved.<br/>
	</footer>
</body>
</html>