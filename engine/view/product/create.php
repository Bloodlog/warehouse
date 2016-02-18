<div id="product">
	<h1>Добавление товара</h1>
	<p class="note">Поля со <span class="required">*</span> обязательны к заполнению.</p>
	<form id="form" action="/product/create" method="POST">
		<div class="row">
			<label>Наименование товара <span class="required">*</span></label>
			<input  name="form[name]" type="text"></input>
		</div>
		<div class="row">
			<label>Артикул товара</label>
			<input  name="form[article]" type="text"></input>
		</div>
		<div class="row">
			<label>Описание товара</label>
			<textarea rows="6" cols="50" name="form[descript]" ></textarea>
		</div>
		<div class="row">
			<label>Производитель</label>
			<input  name="form[manufacturer]" type="text"></input>
		</div>
		<input name="save" type="submit" value="Сохранить"></input>
	</form>

</div>