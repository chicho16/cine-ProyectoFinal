<style>
	td img{
		width: 50px;
		height: 75px;
		margin:auto;
	}
</style>
<?php include ('db_connect.php') ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-block btn-sm btn-primary col-sm-2" type="button" id="new_theater"><i class="fa fa-plus"></i> Nueva Sucursal</button>
			<button class="btn btn-block btn-sm btn-primary col-sm-2" type="button" id="new_group"><i class="fa fa-plus"></i> Sala</button>
		</div>
	</div>
	<div class="row">
		<div class="card col-md-4 mt-3">
			<div class="card-header">
				<large>Sucursal</large>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Acción</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$theater = $conn->query("SELECT * FROM sucursal order by name asc ");
						while($row=$theater->fetch_assoc()){
						 ?>
						 <tr>
						 	<td><?php echo $i++ ?></td>
						 	<td><?php echo $row['name'] ?></td>
						 	<td>
						 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary btn-sm">Acción</button>
								  <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_theater" href="javascript:void(0)" data-id = '<?php echo $row['id_sucursal'] ?>'>Editar</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_theater" href="javascript:void(0)" data-id = '<?php echo $row['id_sucursal'] ?>'>Eliminar</a>
								  </div>
								</div>
								</center>
						 	</td>
						 </tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	<div class="card col-md-7 mt-3 ml-3">
			<div class="card-header">
				<large>Sala</large>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Sucursal</th>
							<th class="text-center">Sala</th>
							<th class="text-center">Asientos</th>
							<th class="text-center">Acción</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$theater = $conn->query("SELECT ts.*,t.name FROM sala ts inner join sucursal t on ts.theater_id = t.id_sucursal  order by t.name asc,ts.seat_group asc ");
						while($row=$theater->fetch_assoc()){
						 ?>
						 <tr>
						 	<td><?php echo $i++ ?></td>
						 	<td><?php echo $row['name'] ?></td>
						 	<td><?php echo $row['seat_group'] ?></td>
						 	<td><?php echo $row['seat_count'] ?></td>
						 	<td>
						 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary btn-sm">Acción</button>
								  <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_seat" href="javascript:void(0)" data-id = '<?php echo $row['id_sala'] ?>'>Editar</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_seat" href="javascript:void(0)" data-id = '<?php echo $row['id_sala'] ?>'>Elminar</a>
								  </div>
								</div>
								</center>
						 	</td>
						 </tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div>

</div>


<script>
	$('#new_theater').click(function(){
		uni_modal('Nueva Sucursal','manage_theater.php');
	})
	$('#new_group').click(function(){
		uni_modal('Nueva Sala','manage_seat.php');
	})
	$('.edit_theater').click(function(){
		uni_modal('Editar Sucursal','manage_theater.php?id='+$(this).attr('data-id'));
	})
	$('.delete_theater').click(function(){
		_conf('Are you sure to delete this data?','delete_theater' , [$(this).attr('data-id')])
	})
	$('.edit_seat').click(function(){
		uni_modal('Editar Sala','manage_seat.php?id='+$(this).attr('data-id'));
	})
	$('.delete_seat').click(function(){
		_conf('Are you sure to delete this data?','delete_seat' , [$(this).attr('data-id')])
	})

	function delete_theater($id=''){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_theater',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully deleted",'success');
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}
	function delete_seat($id=''){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_seat',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully deleted",'success');
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}
</script>