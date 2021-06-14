<?php
//-------------------------- Backend ----------------------------------------------------------------------------------
session_start();
Class Action {
	private $db;
	
	public function __construct() {
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	}
	//login al sistema de administracion
	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
				$_SESSION['login_'.$key] = $value;
			}
			// var_dump($_SESSION);
			return 1;
		}else{
			return 2;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	
	//Funcion para guardar o modificar datos de las peliculas
	function save_movie(){
		extract($_POST);
		$data = " title = '".$title."' ";
		$data .= ", description = '".$description."' ";
		$data .= ", date_showing = '".$date_showing."' ";
		$data .= ", end_date = '".$end_date."' ";
		$duration =  $duration_hour .'.'.(($duration_min / 60) * 100);
		$data .= ", duration = '".$duration."' ";
		$data.=", trailer_yt_link = '".$trailer_yt_link."' ";


		if($_FILES['cover']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'],'../assets/img/'. $fname);
			$data .= ", cover_img = '".$fname."' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO pelicula set ". $data);
			if($save)
				return 1;
		}else{
			$save = $this->db->query("UPDATE pelicula set ". $data." where id_pelicula =".$id);
			if($save)
				return 1;
		}
	}
	//funcion  para eliminar peliculas
	function delete_movie(){
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM pelicula where id_pelicula =".$id);
		if($delete)
			return 1;
	}
	//funcion para eliminar sucursales
	function delete_theater(){
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM sucursal where id_sucursal =".$id);
		if($delete)
			return 1;
	}
	//funcion para insertar sucursales
	function save_theater(){
		extract($_POST);
		if(empty($id))
		$save = $this->db->query("INSERT INTO sucursal set name = '".$name."' ");
		else
		$save = $this->db->query("UPDATE sucursal set name = '".$name."' where id_sucursal = ".$id);
		if($save)
			return 1;
	}
	//funcion para insertar salas
	function save_seat(){
		extract($_POST);
		$data = " theater_id = '".$theater_id."' ";
		$data .= ", seat_group = '".$seat_group."' ";
		$data .= ", seat_count = '".$seat_count."' ";
		if(empty($id))
		$save = $this->db->query("INSERT INTO sala set ".$data." ");
		else
		$save = $this->db->query("UPDATE sala set ".$data." where id_sala = ".$id);
		if($save)
			return 1;

	}
	//funcion para eliminar salas
	function delete_seat(){
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM sala where id_sala =".$id);
		if($delete)
			return 1;
	}
	//funcion para insertar ventas
	function save_reserve(){
		extract($_POST);		
			$para      = $correo."@gmail.com";
            $asunto    = 'Comprovante de compra';
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $descripcion   = "Gracias por confiar en nosotros"."\n";
            $descripcion   .= "Este es su codigo de ingreso:".substr(str_shuffle($permitted_chars), 0, 5)."\n";
            $de = 'From: cinebellavistasc@gmail.com';
            
            mail($para, $asunto, $descripcion, $de);
            
		$data = " movie_id = '".$movie_id."' ";
		$data .= ", ts_id = '1' ";
		$data .= ", apellido = '".$lastname."' ";
		$data .= ", nombre = '".$firstname."' ";
		$data .= ", ci = '".$ci."' ";
		$data .= ", cantidad_tickets = '".$qty."' ";
		$data .= ", monto_bs = '".($qty*25)."' ";
		$data .= ", `fecha` = '".$date."' ";
		$data .= ", `hora` = '".$time."' ";
		$data .= ", `correo` = '".($correo."@gmail.com")."' ";

		$save = $this->db->query("INSERT INTO venta set ".$data);
		if($save)
			return 1;
		$save = $this->db->query("INSERT INTO cartelera set  id_pelicula ='".$movie_id."' ");
	}
}