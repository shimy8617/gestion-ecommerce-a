<?php
	include("../config/conexion.php");
	$response=new stdClass();

	$response->state=true;
	$codigo=$_POST['codigo'];
	$nombre=$_POST['nombre'];
	$descripcion=$_POST['descripcion'];
	$precio=$_POST['precio'];
	$estado=$_POST['estado'];

	if($nombre=="") {
		$response->state=false;
		$response->detail="falta el nombre";
	}else{
		if($descripcion=="") {
			$response->state=false;
			$response->detail="Falta la descripción";
		}else{
			if($precio=="") {
				$response->state=false;
				$response->detail="Falta el precio";
			}else{
				if(isset($_FILES['imagen'])){
					//CAPTURAR FECHA Y HORA DEL SIST
					$nombre_imagen="202107301313.jpg";
					$sql="INSERT INTO producto (nompro,despro,prepro,estado,rutimapro)
					VALUES ('$nombre','$descripcion',$precio,$estado,'$nombre_imagen')";
					$result=mysqli_query($con,$sql);
						if($result) {
							if (move_uploaded_file($_FILES['imagen']['tmp_name'],"../assets/img/".$nombre_imagen)) {
								$response->state=true;
							}else{
								$response->state=false;
								$response->detail="Hubo un error al cargar la imagen";
							}
						}else{
							$response->state=false;
							$response->detail="No se pudo guardar el producto";
						}
					}else{
						$response->state=false;
						$response->detail="Falta la imagen";
					}
			}
		}
	}

	echo json_encode($response);