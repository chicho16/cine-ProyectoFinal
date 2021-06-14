<style>
	td img{
		width: 50px;
		height: 75px;
		margin:auto;
	}
	td p {
		margin: 0
	}
</style>
<?php include ('db_connect.php') ?>
<div class="container-fluid">
	<div class="row">
		<div class="card col-md-12 mt-3">
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<!--Cabecera de la tabla ventas -->
							<th class="text-center">#</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Ci</th>
							<th class="text-center">Correo</th>
							<th class="text-center">Pelicula</th>
							<th class="text-center">Detalle</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$movie = $conn->query("SELECT b.*,m.title,ts.seat_group,t.name as sucursal FROM venta b inner join pelicula m on b.movie_id = m.id_pelicula inner join sala ts on ts.id_sala = b.ts_id inner join sucursal t on t.id_sucursal = ts.theater_id");
						while($row=$movie->fetch_assoc()){
						 ?>
						 <tr>
							<!-- Datosde la tabla ventas -->
						 	<td><?php echo $i++ ?></td>
						 	<td><?php echo ucwords($row['nombre'].', '.$row['apellido']) ?></td>
						 	<td><?php echo $row['ci'] ?></td>
							<td><?php echo $row['correo'] ?></td>
						 	<td><?php echo $row['title'] ?></td>
						 	<td>
						 		<p><small><b>Sucursal:</b> <?php echo $row['sucursal'] ?></small></p>
						 		<p><small><b>Sala:</b> <?php echo $row['seat_group'] ?></small></p>
						 		<p><small><b>Cantidad de Tickets:</b> <?php echo $row['cantidad_tickets'] ?></small></p>
								<p><small><b>Monto:</b> <?php echo $row['monto_bs'] ?></small></p>
						 		<p><small><b>Fecha:</b> <?php echo date("M d,Y",strtotime($row['fecha'])) ?></small></p>
						 		<p><small><b>Hora:</b> <?php echo date("h:i A",strtotime($row['hora'])) ?></small></p>
						 	</td>						 	
						 	
						 </tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script>
	//Accion de la ventana para mostrar los datos de las ventas
	$('table').dataTable();
	$('#new_movie').click(function(){
		uni_modal('New Movie','manage_movie.php');
	})
	$('.edit_movie').click(function(){
		uni_modal('Edit Movie','manage_movie.php?id='+$(this).attr('data-id'));
	})
	$('.delete_movie').click(function(){
		_conf('Are you sure to delete this data?','delete_movie' , [$(this).attr('data-id')])
	})

	function delete_movie($id=''){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_movie',
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