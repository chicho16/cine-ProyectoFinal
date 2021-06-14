 
 <?php
 include 'admin/db_connect.php';

 $mov = $conn->query("SELECT * FROM pelicula where id_pelicula =".$_GET['id'])->fetch_array();
 $duration = explode('.', $mov['duration']);
 $hr = sprintf("%'.02d\n",$duration[0]);
 $min = isset($duration[1]) ? (60 * ('.'.$duration[1])) : '0';
 $min = sprintf("%'.02d\n",$min);
 // $min = $min > 0 ? $min : '00';
 $duration = $hr.' : '.$min
 ?>

 <header class="masthead">
 	<div class="container pt-5">
 		<div class="col-lg-12">
 			<div class="row">
 				<div class="col-md-4">
 					<img src="assets/img/<?php echo $mov['cover_img'] ?>" alt="" class="reserve-img">
 				</div>
 				<div class="col-md-8">
 					<div class="card bg-primary">
 						<div class="card-body text-white">
 							<h3><b><?php echo $mov['title'] ?></b></h3>
 							<hr>
 							<p class=""><small><b>Descripción: </b><i><?php echo $mov['description'] ?></i></small></p>
 							<p class=""><small><b>Duración: </b><i><?php echo $duration ?></i></small></p>
 						</div>
 					</div>
 					<div class="card bg-light mt-2">
 						<div class="card-body">
 							<h4>Compra de Tickets</h4>
 							<form action="" id="save-reserve">
 								<input type="hidden" name="movie_id" value="<?php echo $_GET['id'] ?>">
 								<div class="row">
 									<div class="form-group col-md-4">
 										<label for="" class="control-label">Nombres</label>
 										<input type="text" name="firstname" required="" class="form-control">
 									</div>
 									<div class="form-group col-md-4">
 										<label for="" class="control-label">Apellidos</label>
 										<input type="text" name="lastname" required="" class="form-control">
 									</div>
 									<div class="form-group col-md-4">
 										<label for="" class="control-label">CI</label>
 										<input type="text" name="ci" required="" class="form-control">
 									</div>
									<div class="form-group col-md-4">
 										<label for="" class="control-label">Correo</label>
 										<input type="text" name="correo" required="" class="form-control">
 									</div>
									<div id="display-count" class="col-md-5 mt-4 pt-2">@gmail.com</div>	
								</div>
 								<div class="row">
 								<div class="form-group col-md-4">
 									<label for="" class="control-label">Sucursal</label>
 									<select class="browser-default custom-select" name="ts_id">		
										<option value=""></option>							
 										<?php 
											$qry = $conn->query("SELECT * FROM  sucursal order by name asc");
											while($row= $qry->fetch_assoc()):
 										?>	
 										<option value="<?php echo $row['id_sucursal'] ?>"><?php echo $row['name'] ?></option>
 										<?php endwhile; ?>
 									</select>
 								</div>
 								</div>
 								<div id="display-other">
 									
 								</div>
 								<div class="row">
								 	<div class="form-group col-md-4">
 										<button class="row-md-2 btn btn-block btn-primary">Comprar</button>							
									</div>
									<div class="form-group col-md-4">										
										<a href="index.php?page=home"><input type="button"class="row-md-2 btn btn-block btn-primary"value="Cancelar">			
										</a>										
									</div>
									<div class="form-group col-md-4">										
										<a href="<?php echo $mov['trailer_yt_link'] ?>"><input type="button"class="row-md-2 btn btn-block btn-primary"value="Tráiler">			
										</a>										
									</div>
 								</div>
								
 							</form>

 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
</header>

<script>
	
	$('[name="ts_id"]').change(function(){
		$.ajax({
			url:'manage_reserve.php?id='+$(this).val()+'&mid=<?php echo $_GET['id'] ?>',
			success:function(resp){
				$('#display-other').html(resp)
			}
		})
	})
	$(document).ready(function(){
		$('#save-reserve').submit(function(){
			$('#save-reserve button').attr('disabled',true).html("Saving...")
			$.ajax({
				url:'admin/ajax.php?action=save_reserve',
				method:'POST',
				data:$(this).serialize(),
				success:function(resp){
					if(resp == 1){
						alert("Reservartion successfully saved");
						location.replace('index.php')
					}
				}
			})
		})
	})
	
</script>

