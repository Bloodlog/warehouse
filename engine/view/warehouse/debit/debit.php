<div id="product">

<script type="text/javascript">
$( document ).ready(function() {
  $("#list2").jqGrid({
      url:'/warehouse/getdebittable/',
    datatype: "json",
      colNames:['Inv No', 'Наименование','Автор', 'Дата','Редактирование'],
      colModel:[
      {name:'id',index:'id', width:50},
      {name:'name',index:'name', width:150},
      {name:'author',index:'author', width:150},
      {name:'createdate',index:'createdate', width:150},
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
      sortname: 'timestump',
      viewrecords: true,
      sortorder: "asc",
      gridComplete: function(){
    var ids = jQuery("#list2").jqGrid('getDataIDs');
    for(var i=0;i < ids.length;i++){
      var cl = ids[i];
      be = "<a href='/warehouse/debitupdate/?id="+cl+"'>Изменить</a> / "; 
      de = "<a href='/warehouse/debitupdate/?id=" +cl +"'>Удалить</a>";
      jQuery("#list2").jqGrid('setRowData',ids[i],{act:be+de});
    } 
  },
  editurl: "server.php",
      caption:"Документы оприходования"
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
    <a href="/warehouse/debitcreate">Оприходовать товар</a>
</div>  
</div>
