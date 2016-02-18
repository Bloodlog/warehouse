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
	<h1>Редактирование документа оприходования товара</h1>
	<p class="note">Поля со <span class="required">*</span> обязательны к заполнению.</p>
	<form id="form" action="/warehouse/debitupdate/?id=<?php echo $data['id'];?>" method="POST">
		<div class="row">
			<label>Наименование документа<span class="required">*</span></label>
			<input  id="name" name="form[name]" type="text" value ="<?php echo $data['debit']['name']; ?>"></input>
		</div>
		<div class="row">
			<label>Список товаров:</label>
			<a id="addrow">Добавить строку</a>
			<table  border=1>
				<thead><tr><td>ID</td><td>Наименование</td><td>Количество</td><td>Цена</td><td>Редактирование</td></tr></thead>
				<?php 
				$i = 1;
				while ($row = mysql_fetch_assoc($data['table'])) {
					if(empty($row['price'])){
						$row['price'] =0;
					}
					echo '<tr id="end-row'.$i.'"><td>'.$i.'</td><td><input id="pers_id'.$i.'" class="input-id" type="" name ="form_table['.$i.'][product_id]" value="'.$row['id'].'"></input><input class="autocomplete" onclick="auto()" id="autocomplete'.$i.'" type="text" value="'.$row['name'].'"></input></td><td><input id="quantity'.$i.'" type="text" name="form_table['.$i.'][quantity]" value="'.$row['quantity'].'"></input></td><td><input id="price'.$i.'" type="text" name="form_table['.$i.'][price]" value="'.$row['price'].'"></td><td><a id="delrow'.$i.'" onclick="delrow();">Удалить</a></td></tr>';
					$i++;
				}
				if($i<=1){
					echo '<tr id="end-row'.$i.'"><td>'.$i.'</td><td><input id="pers_id'.$i.'" class="input-id" type="" name ="form_table['.$i.'][product_id]" value=""></input><input class="autocomplete" onclick="auto()" id="autocomplete'.$i.'" type="text" value=""></input></td><td><input id="quantity'.$i.'" type="text" name="form_table['.$i.'][quantity]" value=""></input></td><td><input id="price'.$i.'" type="text" name="form_table['.$i.'][price]"></td><td><a id="delrow'.$i.'" onclick="">-</a></td></tr>';
				}
				?>
			</table>
			<div id="notify"></div>
		</div>
		<div class="row">
			<label>Автор</label>
			<input id="author" name="form[author]" type="text" value ="<?php echo $data['debit']['author']; ?>"></input>
		</div>
		<input id="save" name="save" type="submit" value="Сохранить"></input>
	</form>
	<script type="text/javascript">
		$(document).ready(function(){
				<?php echo "var i = ".($i-1).";"; ?>
				$('#addrow').click(function(){
					$('#notify').html('');
							if($('#quantity'+i).val() == '' || $('#pers_id'+i).val() == '' ){

								$('#notify').html('<p style="color:red">Одно из значений поля количество не заполнено!</p>');
							}else{
						predi = i;
						i++;
						//$("#autocomplete"+predi).attr('readonly', true);
						var str = '<tr id="end-row'+i+'"><td>'+i+'</td><td><input id="pers_id'+i+'" class="input-id" type="" name ="form_table['+i+'][product_id]" readonly="readonly"></input><input class="autocomplete" onclick="auto()" id = "autocomplete'+i+'" type="text"></input></td><td><input id="quantity'+i+'" type="text" name="form_table['+i+'][quantity]"></input></td><td><input id="price'+i+'" type="text" name="form_table['+i+'][price]"></td><td><a id="delrow'+i+'" onclick="delrow();">Удалить</a></td></tr>';
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
			for (k = i; k >= 1; k--) {
				var point='#price'+k;
				$(point).val($(point).val().replace(/,/,'.'));
			};
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