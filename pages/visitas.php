<?php if($_GET["acao"] == "lista"): ?>
<h1>Minhas Visitas</h1>

<hr class="featurette-divider">

<ul class="breadcrumb" style="height:100px">

		<div class="pull-left">
			<strong>Filtrar por data:</strong>
			<form role="form">
				De <input  class="form-group" type="date" class="span2" required class="form-control" /> até <input type="date" class="span2" required class="form-control" />
				<div><input class="btn btn-info" type="submit" value="Filtrar"></div>
			</form> 
		</div>

		<div class="pull-right">
			<strong>Busca geral por visitas:</strong>
			<form>
				<input required type="text" id="input">
				<div><input class="btn btn-info" type="submit" value="Buscar"></div>
			</form> 
		</div>

</ul>
<div class="clear"></div>

<hr class="featurette-divider">

<p>Mostrado todoas as suas visitas</p>
<table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Username</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>Mark</td>
			<td>Otto</td>
			<td>@mdo</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Jacob</td>
			<td>Thornton</td>
			<td>@fat</td>
		</tr>
		<tr>
			<td>3</td>
			<td colspan="2">Larry the Bird</td>
			<td>@twitter</td>
			</tr>
	</tbody>
</table>
<?php endif; ?>