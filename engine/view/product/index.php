<div id="product">



<script type="text/javascript">

$( document ).ready(function() {

  $("#list2").jqGrid({

      url:'/product/gettable/',

    datatype: "json",

      colNames:['Inv No','Артикул', 'Наименование', 'Производитель','Редактирование'],

      colModel:[

      {name:'id',index:'id', width:35},

      {name:'article',index:'article', width:75},

      {name:'name',index:'name', width:275},

      {name:'manufacturer',index:'manufacturer', width:75},

      {name:'act',index:'act', width:150,align:"center", sortable:false},

        /*{name:'invdate',index:'invdate', width:90},

        {name:'name',index:'name asc, invdate', width:100},

        {name:'amount',index:'amount', width:80, align:"right"},

        {name:'tax',index:'tax', width:80, align:"right"},    

        {name:'total',index:'total', width:80,align:"right"},   

        {name:'note',index:'note', width:150, sortable:false} */  

      ],

      rowNum:20,

      rowList:[20,40,60],

      pager: '#pager2',

      sortname: 'id',

      viewrecords: true,

      sortorder: "asc",

      gridComplete: function(){

    var ids = jQuery("#list2").jqGrid('getDataIDs');

    for(var i=0;i < ids.length;i++){

      var cl = ids[i];

      be = "<a href='/product/update/?id="+cl+"'>Изменить</a> / "; 

      de = "<a href='/product/update/?id=" +cl +"'>Удалить</a>";

      jQuery("#list2").jqGrid('setRowData',ids[i],{act:be+de});

    } 

  },

  editurl: "server.php",

      caption:"Список товаров"

  });

  $("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});

});

</script>

<div class="table">

	<table id="list2"></table>

	<div id="pager2"></div>

  <div id="prowed2"></div>

</div>

<div class="right-block">

    <a href="/product/create">Добавить товар</a>

</div>  

</div>

