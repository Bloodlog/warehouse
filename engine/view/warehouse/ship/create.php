<div id="warehouse">
	<script type="text/javascript">
	var i = 1;
				function auto(){
				
						var str = event.target.id;
						//alert(tar);
						var lastl = str.length - 1;
						last = str.charAt(lastl)
						$('#autocomplete'+last).autocomplete({
										    source: "/warehouse/searchproduct/",
							            //Определяем обработчик селектора
							            select: function(e, ui) {
							                 $("#pers_id"+last).attr("value",ui.item.id);
							                  //$sel_person = ui.item.label;
							            },
										    minLength: 1,
										});
					
				}
				function delrow(){
					var tar = event.target.id;
					$('#'+tar).parent().parent().remove();
					var last = tar.length - 1;
					if(last<i){
						i++
					}else{
						i--
					}
				}
	</script>
	<h1>Документ отгрузки товара</h1>
	<p class="note">Поля со <span class="required">*</span> обязательны к заполнению.</p>
	<form id="form" action="/warehouse/shipcreate/" method="POST">
		<div class="row">
			<label>Наименование документа<span class="required">*</span></label>
			<input  id="name" name="form[name]" type="text"></input>
		</div>
		<div class="row">
			<label>Список товаров:</label>
			<a id="addrow">Добавить строку</a>
			<table border=1>
				<thead><tr><td>ID</td><td>Наименование</td><td>Количество</td><td>Редактирование</td></tr></thead>
				<tr id="end-row1"><td>1</td><td><input id="pers_id1" class="input-id" type="" name ="form_table[1][product_id]" readonly="readonly"></input><input class="autocomplete" onclick="auto()" id="autocomplete1" type="text" ></input></td><td><input id="quantity1" type="text" name="form_table[1][quantity]"></input></td><td>Х</td></tr>
			</table>
			<div id="notify"></div>
		</div>
		<div class="row">
			<label>Автор</label>
			<input id="author" name="form[author]" type="text"></input>
		</div>
		<input id="save" name="save" type="submit" value="Сохранить"></input>
	</form>
	<script type="text/javascript">
		$(document).ready(function(){
				
				$('#addrow').click(function(){
					$('#notify').html('');
							if($('#quantity'+i).val() == '' || $('#pers_id'+i).val() == '' ){

								$('#notify').html('<p style="color:red">Одно из значений поля количество не заполнено!</p>');
							}else{
						predi = i;
						i++;
						//$("#autocomplete"+predi).attr('readonly', true);
						var str = '<tr id="end-row'+i+'"><td>'+i+'</td><td><input id="pers_id'+i+'" class="input-id" type="" name ="form_table['+i+'][product_id]" readonly="readonly"></input><input class="autocomplete" onclick="auto()" id = "autocomplete'+i+'" type="text"></input></td><td><input id="quantity'+i+'" type="text" name="form_table['+i+'][quantity]"></input></td><td><a id="delrow'+i+'" onclick="delrow();">Удалить</a></td></tr>';
						$("#end-row"+predi).removeClass("#end-row"+predi).after(str);
									
					}
				});

		
	

//Проверка на одинаковые поля=(
		$('#save').click(function(){
			if($('#name').val()==''){
				$('#notify').html('<p style="color:red">Не заполнено наименование документа!</p>');
				return false
			}
			if($('#author').val()==''){
				$('#notify').html('<p style="color:red">Не указан автор документа!</p>');
				return false
			}
			if($('#pers_id1').val()=='' || $('#quantity1').val()==''){
				$('#notify').html('<p style="color:red">Проверьте правильность ввода товара!</p>');
				return false
			}
			/*var value = $('.input-id :first').val()
			var chk = true;
			$('.input-id').each(function(){
				if(value!=this.value)chk = false;
			})
			if (chk) {
				alert('Все одинаковые') 
				return false
			};
			*/
		});
	
			
	});

	</script>
</div>