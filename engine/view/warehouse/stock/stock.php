<div id="product">



<script type="text/javascript">

$( document ).ready(function() {

  $("#list2").jqGrid({

      url:'/warehouse/getstocktable/',

    datatype: "json",

      colNames:['Inv No', 'Артикул','Наименование', 'Производитель','Количество'],

      colModel:[

      {name:'id',index:'id', width:50},

      {name:'article',index:'article', width:75},

      {name:'name',index:'name', width:275},

      {name:'manufacturer',index:'manufacturer', width:125},

      {name:'quantity',index:'quantity', width:150,align:"center", sortable:false},

        /*{name:'invdate',index:'invdate', width:90},

        {name:'name',index:'name asc, invdate', width:100},

        {name:'amount',index:'amount', width:80, align:"right"},

        {name:'tax',index:'tax', width:80, align:"right"},    

        {name:'total',index:'total', width:80,align:"right"},   

        {name:'note',index:'note', width:150, sortable:false} */  

      ],

      rowNum:50,

      rowList:[50,100,150],

      pager: '#pager2',

      sortname: 'id',

      viewrecords: true,

      sortorder: "asc",

    /*  gridComplete: function(){

    var ids = jQuery("#list2").jqGrid('getDataIDs');

    for(var i=0;i < ids.length;i++){

      var cl = ids[i];

     // be = "<a href='/warehouse/shipupdate/?id="+cl+"'>Изменить</a> / "; 

      //de = "<a href='/warehouse/shipupdate/?id=" +cl +"'>Удалить</a>";

      //jQuery("#list2").jqGrid('setRowData',ids[i],{act:be+de});

    } 

  },*/

  editurl: "server.php",

      caption:"Остатки товаров на складах"

  });

  //$("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});

});

</script>

<div class="table">

	<table id="list2"></table>

	<div id="pager2"></div>

  <div id="prowed2"></div>

</div>

<div class="right-block">

    <!--<a href="/warehouse/shipcreate">Отгрузить товар</a> -->

    <input type="button" value="Печать" onclick="print()"></input>

</div>  

</div>

