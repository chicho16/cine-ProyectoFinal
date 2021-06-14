<?php

include 'admin/db_connect.php';

 $mov = $conn->query("SELECT * FROM pelicula where id_pelicula =".$_GET['mid'])->fetch_array();
 $dur = explode('.', $mov['duration']);
 $dur[1] = isset($dur[1]) ? $dur[1] : 0;
 $hr = sprintf("%'.02d\n",$dur[0]);
 $min = isset($dur[1]) ? (60 * ('.'.$dur[1])) : '0';
 $min = sprintf("%'.02d\n",$min);
 // $min = $min > 0 ? $min : '00';
  $duration = $hr.' : '.$min;

?>
<div class="row">
	<div class="form-group col-md-2">
		<label for="" class="control-label">Cantidad</label>
		<input type="number" name="qty" id="qty" class="form-control" min="0" max="10" required="">
	</div>
	<div class="form-group col-md-4">
		<label for="" class="control-label">Fecha</label>
		<select name="date" id="date" class="custom-select browser-default" onchange="cargarHorario(this.value)">
			<?php 
				for($i = 0 ; $i < 3;$i++ ){
					if(date('Ymd') >= date("Ymd",strtotime($mov['date_showing']))){
						echo "<option value='".date('Y-m-d',strtotime(date('Y-m-d').' +'.$i.' days'))."'>".date('M d,Y',strtotime(date('Y-m-d').' +'.$i.' days'))."</option>";
					}
				}							
			?>

		</select>
	</div>
	<div class="form-group col-md-4">
		<label for="" class="control-label">Hora</label>
		<select name="time" id="time" class="custom-select browser-default">


			<?php /* 
			 $dur[1] = isset($dur[1]) ? $dur[1] : 0;
			 $hora=date("H");
				if ($hora>= 10 and  $hora<= 22 ){
					if($hora %2 ==0){
						$i=$hora;
					}else{$i=$hora+1;}
				}else{
					$i=10;
				}
				while($i<=22){							
						echo '<option value="'.$i.':00'.date('A').'">'.$i.' : 00 '. date('A').'</option>';*/		
													
					/*$i=$i+2;					
				}*/	
			?>

		</select>
	</div>
</div>
<script>
	function cargarHorario(Fecha) {
		//Inicializamos el array.
		//vacías la select cada vez que elijas una provincia
		document.getElementById('time').innerHTML="";

		var horaActual=new Date();
		var fecha=Fecha[8]+Fecha[9];
		var horario = [];
		
		if( horaActual.getDate() == fecha){
			var hora=horaActual.getHours();
			var i;
				if (hora>= 10 &&  hora<= 22 ){
					if(hora %2 ==0){
						i=hora;
					}else{
						i=hora+1;
					}
				}else{
					i=hora;
				}
				while(i<=22){			
					if(i>=12){
						horario.push(i.toString()+":00 PM");
					}else{
						horario.push(i.toString()+":00 AM");
					}																
					i=i+2;					
				}
		}else{
			 horario = ["10:00 AM", "12:00 PM", "14:00 PM", "16:00 PM", "18:00 PM","20:00 PM","22:00 PM"];
		}
		for(var i=0; i<horario.length; i++){
			var option=document.createElement("OPTION");
			option.innerHTML=horario[i];
			document.getElementById("time").appendChild(option);
		}
  	}

</script>