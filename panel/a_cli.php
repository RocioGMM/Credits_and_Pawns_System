<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$seccion = $_POST["seccion"];if($seccion == ''){$seccion = $_REQUEST["seccion"];};

$fecha_nacimiento = $_POST["fecha_nacimiento_a"].'-'.$_POST["fecha_nacimiento_m"].'-'.$_POST["fecha_nacimiento_d"];

$fecha =  date("Y-m-d H:i:s");

if($_SESSION["tipo"] == 'admin') {
	 $vendedor = $_POST["vendedor"];
}else{
	 $vendedor = $_SESSION["vendedor"];
};

	if ($id == ''){ 

$sql11 = "INSERT INTO cliente(contacto, apellido_materno, apellido_paterno, fecha_nacimiento, sexo, lugar_nacimiento, celular, rfc, email, CURP, como_entero) 
VALUES('".$_POST["contacto"]."', '".$_POST["apellido_materno"]."', '".$_POST["apellido_paterno"]."','".$_POST["fecha_nacimiento"]."', '".$_POST["sexo"]."', 
	'".$fecha_nacimiento."', '".$_POST["celular"]."', '".$_POST["rfc"]."', '".$_POST["email"]."', '".$_POST["CURP"]."', 
	'".$_POST["como_entero"]."')";
/*
$sql11 = "INSERT INTO cliente(folio, contacto, apellido_materno, apellido_paterno, fecha_nacimiento, sexo, lugar_nacimiento, 
celular, rfc, email, CURP, como_entero, telefono, numero_dependientes, num_personas_tech, salud_problemas, tipo_casa, 
arrendador_nombre, arrendador_celular, familiar_nombre, familiar_parentesco, familiar_domicilio, familiar_referencia_dom, 
ocupacion, jefe_nombre, jefe_celular, empresa_nombre, empresa_sector, empresa_puesto, empresa_direccion, empresa_referencia,
trabajo_horario, trabajo_entrada, trabajo_salida, trabajo_telefono1, trabajo_telefono2, trabajo_telefono3, trabajo_tiempo, 
ganancias_mes, pago_tipo, pago_dia, pago_lugar, pago_banco, pago_banco_succaj, pago_donde, pago_horario, otros_ingresos,
otros_ingresos_monto, otros_ingresos_tipoingr, estado_civil, pareja_ganancia, pareja_empresa, pareja_sector, pareja_puesto,
pareja_direccion, pareja_referencia, pareja_horario, pareja_entrada, pareja_salida, pareja_telefono_trabajo1, pareja_telefono_trabajo2,
pareja_tiempo_trabajo, parejaex_mensualidad, parejaex_mensualidad_cant, eg_casa_mensualidad, eg_casa_servicios, eg_alimentacion,
eg_escuelas, eg_carro_mensualidad, eg_transporte, eg_tagera_credito, eg_celulares, eg_otros, deudas_actuales, deudas_cuantas, 
deudas_aquien, deudas_cuanto, deudas_abono_mes, resultado, dinero_disponible, financieras_otras_cliente, financieras_otras_nombre,
financieras_otras_quedaste, estas_buro, estas_buro_porque, riesgo, google, buro_credito, buro_interno, papeles_carro, aval,
comentarios_analisis, observaciones_grales) 
VALUES('".$_POST["folio"]."', '".$_POST["contacto"]."', '".$_POST["apellido_materno"]."', '".$_POST["apellido_paterno"]."',
	'".$_POST["fecha_nacimiento"]."', '".$_POST["sexo"]."', '".$_POST["lugar_nacimiento"]."', '".$_POST["celular"]."',
'".$_POST["rfc"]."', '".$_POST["email"]."', '".$_POST["CURP"]."', '".$_POST["como_entero"]."', '".$_POST["telefono"]."',
'".$_POST["numero_dependientes"]."', '".$_POST["num_personas_tech"]."', '".$_POST["salud_problemas"]."', 
'".$_POST["tipo_casa"]."', '".$_POST["arrendador_nombre"]."', '".$_POST["arrendador_celular"]."', '".$_POST["familiar_nombre"]."',
 '".$_POST["familiar_parentesco"]."',
'".$_POST["familiar_domicilio"]."', '".$_POST["familiar_referencia_dom"]."', '".$_POST["ocupacion"]."', '".$_POST["jefe_nombre"]."',
'".$_POST["jefe_celular"]."', '".$_POST["empresa_nombre"]."', '".$_POST["empresa_sector"]."', '".$_POST["empresa_puesto"]."',
'".$_POST["empresa_direccion"]."', '".$_POST["empresa_referencia"]."', '".$_POST["trabajo_horario"]."', '".$_POST["trabajo_entrada"]."',
'".$_POST["trabajo_salida"]."',
'".$_POST["trabajo_telefono1"]."', '".$_POST["trabajo_telefono2"]."', '".$_POST["trabajo_telefono3"]."', '".$_POST["trabajo_tiempo"]."',
'".$_POST["ganancias_mes"]."', '".$_POST["pago_tipo"]."', '".$_POST["pago_dia"]."', '".$_POST["pago_lugar"]."', '".$_POST["pago_banco"]."',
'".$_POST["pago_banco_succaj"]."', '".$_POST["pago_donde"]."', '".$_POST["pago_horario"]."', '".$_POST["otros_ingresos"]."',
'".$_POST["otros_ingresos_monto"]."', '".$_POST["otros_ingresos_tipoingr"]."', '".$_POST["estado_civil"]."', '".$_POST["pareja_ganancia"]."',
'".$_POST["pareja_empresa"]."', '".$_POST["pareja_sector"]."', '".$_POST["pareja_puesto"]."', '".$_POST["pareja_direccion"]."',
'".$_POST["pareja_referencia"]."', '".$_POST["pareja_horario"]."', '".$_POST["pareja_entrada"]."', '".$_POST["pareja_salida"]."', 
'".$_POST["pareja_telefono_trabajo1"]."', '".$_POST["pareja_telefono_trabajo2"]."', '".$_POST["pareja_tiempo_trabajo"]."',
'".$_POST["parejaex_mensualidad"]."', '".$_POST["parejaex_mensualidad_cant"]."', '".$_POST["eg_casa_mensualidad"]."', 
'".$_POST["eg_casa_servicios"]."', '".$_POST["eg_alimentacion"]."', '".$_POST["eg_escuelas"]."', '".$_POST["eg_carro_mensualidad"]."',
'".$_POST["eg_transporte"]."', '".$_POST["eg_tagera_credito"]."', '".$_POST["eg_celulares"]."', '".$_POST["eg_otros"]."', 
'".$_POST["deudas_actuales"]."', '".$_POST["deudas_cuantas"]."', '".$_POST["deudas_aquien"]."', '".$_POST["deudas_cuanto"]."',
'".$_POST["deudas_abono_mes"]."', '".$_POST["resultado"]."', '".$_POST["dinero_disponible"]."', '".$_POST["financieras_otras_cliente"]."',
'".$_POST["financieras_otras_nombre"]."', '".$_POST["financieras_otras_quedaste"]."', '".$_POST["estas_buro"]."', 
'".$_POST["estas_buro_porque"]."', '".$_POST["riesgo"]."', '".$_POST["google"]."', '".$_POST["buro_credito"]."', 
'".$_POST["buro_interno"]."', '".$_POST["papeles_carro"]."', '".$_POST["aval"]."', '".$_POST["comentarios_analisis"]."',
'".$_POST["observaciones_grales"]."')";//*/

$result = mysql_query($sql11);
								
	}else{
		if($seccion == '1'){
			$sql1 = "UPDATE cliente SET email='".$_POST["email"]."',  celular='".$_POST["celular"]."', telefono='".$_POST["telefono"]."', rfc='".$rfc."',  
			CURP='".$_POST["CURP"]."', como_entero='".$_POST["como_entero"]."', numero_dependientes='".$_POST["numero_dependientes"]."', 
			num_personas_tech='".$_POST["num_personas_tech"]."', salud_problemas='".$_POST["salud_problemas"]."',
			salud_comentario='".$_POST["salud_comentario"]."', tipo_casa='".$_POST["tipo_casa"]."', 
			arrendador_nombre='".$_POST["arrendador_nombre"]."', arrendador_celular='".$_POST["arrendador_celular"]."',
			familiar_nombre='".$_POST["familiar_nombre"]."', familiar_parentesco='".$_POST["familiar_parentesco"]."', 
			familiar_domicilio='".$_POST["familiar_domicilio"]."', familiar_referencia_dom='".$_POST["familiar_referencia_dom"]."' 
			WHERE id=".$id;	
			/*$sql1 = "UPDATE cliente SET contacto='".$_POST["contacto"]."', apellido_materno='".$_POST["apellido_materno"]."',  
			apellido_paterno='".$_POST["apellido_paterno"]."',
			lugar_nacimiento='".$_POST["lugar_nacimiento"]."', fecha_nacimiento='".$fecha_nacimiento."', sexo='".$_POST["sexo"]."',
			email='".$_POST["email"]."',  celular='".$_POST["celular"]."', telefono='".$_POST["telefono"]."', rfc='".$rfc."',  
			CURP='".$_POST["CURP"]."', como_entero='".$_POST["como_entero"]."', numero_dependientes='".$_POST["numero_dependientes"]."', 
			num_personas_tech='".$_POST["num_personas_tech"]."', salud_problemas='".$_POST["salud_problemas"]."',
			salud_comentario='".$_POST["salud_comentario"]."', tipo_casa='".$_POST["tipo_casa"]."', 
			arrendador_nombre='".$_POST["arrendador_nombre"]."', arrendador_celular='".$_POST["arrendador_celular"]."',
			familiar_nombre='".$_POST["familiar_nombre"]."', familiar_parentesco='".$_POST["familiar_parentesco"]."', 
			familiar_domicilio='".$_POST["familiar_domicilio"]."', familiar_referencia_dom='".$_POST["familiar_referencia_dom"]."' 
			WHERE id=".$id;	*/			
			$result = mysql_query($sql1);
			$hasta_donde = $_POST["numero_domicilios"] + 1;
			for ($i=1; $i < $hasta_donde; $i++) { // DOMICILIOS
					$x = 1;
					$idid = "id_dom".$i;  $id_dom = $_POST[$idid];
					$domicilioid = "domicilio".$i;  $domicilio = $_POST[$domicilioid];
					$callesid = "calles".$i;  $calles = $_POST[$callesid];
					$lat_longid = "lat_long".$i;  $lat_long = $_POST[$lat_longid];
						$desde_cuando_a_id = "desde_cuando_a_".$i;  $desde_cuando_a = $_POST[$desde_cuando_a_id];
						$desde_cuando_m_id = "desde_cuando_m_".$i;  $desde_cuando_m = $_POST[$desde_cuando_m_id];
						$desde_cuando = $desde_cuando_a.'-'.$desde_cuando_m.'-01';
					if($id_dom == ''){ $x=2;
						$sql12 = "INSERT INTO domicilio(cliente, domicilio, calles, lat_long, desde_cuando) 
						VALUES('".$id."', '".$domicilio."','".$calles."', '".$lat_long."', '".$desde_cuando."')";
						$result2 = mysql_query($sql12);
					}else{$x=3;
						$sql2 = "UPDATE domicilio SET domicilio='".$domicilio."', calles='".$calles."', 
						lat_long='".$lat_long."', desde_cuando='".$desde_cuando."' WHERE id=".$id_dom;				
						$result2 = mysql_query($sql2);
					};
			};
			$numero_dependientes_ant = $_POST["numero_dependientes_ant"];// DEPENDIENTES
				if ($numero_dependientes_ant == '1') {
					$hasta_donde_dep = $_POST["numero_dependientes0"] + 1;

					$sql4 = "DELETE FROM dependientes WHERE cliente=".$id;
					$result4 = mysql_query($sql4);

					for ($i=1; $i < $hasta_donde_dep; $i++) { 
						$edadid = "edad".$i;  $edad = $_POST[$edadid];
						$sexoid = "sexo".$i;  $sexo = $_POST[$sexoid];
						
							$sql13 = "INSERT INTO dependientes(cliente, edad, sexo) VALUES('".$id."', '".$edad."', '".$sexo."')";
							$result3 = mysql_query($sql13);
						
					}
				};
			if ($_POST["familiar_id"] == '') {
					$sql15 = "INSERT INTO referencias(cliente, tipo, nombre, parentesco, domicilio, referencia) 
					VALUES('".$id."', '".$_POST["ref_tipo_ref"]."', '".$_POST["familiar_nombre"]."', '".$_POST["familiar_parentesco"]."', 
						'".$_POST["familiar_domicilio"]."', '".$_POST["familiar_referencia_dom"]."')";
					$result5 = mysql_query($sql15);
					
					$sql2f = "SELECT * FROM referencias WHERE cliente='".$id."' AND nombre='".$_POST["familiar_nombre"]."' ORDER BY id DESC";
				    $result2f = mysql_query($sql2f, $conn1);
				    $row2f = mysql_fetch_array($result2f);

				    	$sql15 = "UPDATE cliente SET familiar_id='".$row2f["id"]."' WHERE id=".$id;				
						$result5 = mysql_query($sql15);
			}else{
					$sql15 = "UPDATE referencias SET tipo='".$_POST["ref_tipo_ref"]."', nombre='".$_POST["familiar_nombre"]."', 
					parentesco='".$_POST["familiar_parentesco"]."', domicilio='".$_POST["familiar_domicilio"]."', 
					referencia= '".$_POST["familiar_referencia_dom"]."' WHERE id=".$_POST["familiar_id"];				
					$result5 = mysql_query($sql15);
			};
		};
		if($seccion == '2'){// Perfil Laboral

				    	$sql15 = "UPDATE cliente SET ocupacion='".$_POST["ocupacion"]."', empresa_nombre='".$_POST["empresa_nombre"]."',
				    	empresa_sector='".$_POST["empresa_sector"]."', empresa_puesto='".$_POST["empresa_puesto"]."', 
				    	jefe_nombre='".$_POST["jefe_nombre"]."', jefe_celular='".$_POST["jefe_celular"]."', 
				    	empresa_direccion='".$_POST["empresa_direccion"]."', empresa_referencia='".$_POST["empresa_referencia"]."', 
				    	trabajo_horario='".$_POST["trabajo_horario"]."', trabajo_entrada='".$_POST["trabajo_entrada"]."', 
				    	trabajo_salida='".$_POST["trabajo_salida"]."', trabajo_telefono1='".$_POST["trabajo_telefono1"]."', 
				    	trabajo_tiempo='".$_POST["trabajo_tiempo"]."' WHERE id=".$id;				
						$result5 = mysql_query($sql15);

		};// FIN de Perfil Laboral
		if($seccion == '3'){// Perfil ECONOMICO

				    	$sql15 = "UPDATE cliente SET ganancias_mes='".$_POST["ganancias_mes"]."', pago_tipo='".$_POST["pago_tipo"]."',
				    	pago_dia='".$_POST["pago_dia"]."', pago_lugar='".$_POST["pago_lugar"]."',
				    	pago_banco='".$_POST["pago_banco"]."', pago_banco_succaj='".$_POST["pago_banco_succaj"]."',
				    	pago_donde='".$_POST["pago_donde"]."', pago_horario='".$_POST["pago_horario"]."',
				    	otros_ingresos='".$_POST["otros_ingresos"]."', otros_ingresos_monto='".$_POST["otros_ingresos_monto"]."',
				    	otros_ingresos_tipoingr='".$_POST["otros_ingresos_tipoingr"]."', estado_civil='".$_POST["estado_civil"]."',
				    	pareja_ganancia='".$_POST["pareja_ganancia"]."', pareja_empresa='".$_POST["pareja_empresa"]."',
				    	pareja_sector='".$_POST["pareja_sector"]."', pareja_puesto='".$_POST["pareja_puesto"]."',
				    	pareja_direccion='".$_POST["pareja_direccion"]."', pareja_referencia='".$_POST["pareja_referencia"]."',
				    	pareja_horario='".$_POST["pareja_horario"]."', pareja_entrada='".$_POST["pareja_entrada"]."',
				    	pareja_salida='".$_POST["pareja_salida"]."', pareja_telefono_trabajo1='".$_POST["pareja_telefono_trabajo1"]."',
				    	pareja_tiempo_trabajo='".$_POST["pareja_tiempo_trabajo"]."', parejaex_mensualidad='".$_POST["parejaex_mensualidad"]."',
				    	parejaex_mensualidad_cant='".$_POST["parejaex_mensualidad_cant"]."', eg_casa_mensualidad='".$_POST["eg_casa_mensualidad"]."',
				    	eg_casa_servicios='".$_POST["eg_casa_servicios"]."', eg_alimentacion='".$_POST["eg_alimentacion"]."',
				    	eg_escuelas='".$_POST["eg_escuelas"]."', eg_carro_mensualidad='".$_POST["eg_carro_mensualidad"]."',
				    	eg_transporte='".$_POST["eg_transporte"]."', eg_tagera_credito='".$_POST["eg_tagera_credito"]."',
				    	eg_otros='".$_POST["eg_otros"]."', deudas_actuales='".$_POST["deudas_actuales"]."',
				    	deudas_cuantas='".$_POST["deudas_cuantas"]."', deudas_aquien='".$_POST["deudas_aquien"]."',
				    	deudas_cuanto='".$_POST["deudas_cuanto"]."', deudas_abono_mes='".$_POST["deudas_abono_mes"]."',
				    	resultado='".$_POST["resultado"]."', dinero_disponible='".$_POST["dinero_disponible"]."',
				    	financieras_otras_cliente='".$_POST["financieras_otras_cliente"]."', financieras_otras_nombre='".$_POST["financieras_otras_nombre"]."',
				    	financieras_otras_quedaste='".$_POST["financieras_otras_quedaste"]."', estas_buro='".$_POST["estas_buro"]."',
				    	estas_buro_porque='".$_POST["estas_buro_porque"]."', nombre_pareja_pe='".$_POST["nombre_pareja_pe"]."' 
				    	WHERE id=".$id;				
						$result5 = mysql_query($sql15);

			if ($_POST["familiar_id"] == '') {
					$sql15 = "INSERT INTO referencias(cliente, tipo, nombre, parentesco) 
					VALUES('".$id."', 'familiar_vive_ud', '".$_POST["nombre_pareja_pe"]."', 'Pareja')";
					$result5 = mysql_query($sql15);
					
					$sql2f = "SELECT * FROM referencias WHERE cliente='".$id."' AND nombre='".$_POST["nombre_pareja_pe"]."'
					ORDER BY id DESC";
				    $result2f = mysql_query($sql2f, $conn1);
				    $row2f = mysql_fetch_array($result2f);

				    	$sql15 = "UPDATE cliente SET id_pareja='".$row2f["id"]."' WHERE id=".$id;				
						$result5 = mysql_query($sql15);
			}else{
					$sql15 = "UPDATE referencias SET nombre='".$_POST["nombre_pareja_pe"]."' WHERE id=".$_POST["id_pareja"];				
					$result5 = mysql_query($sql15);
			};

		};// FIN de Perfil ECONOMICO
		if($seccion == '4'){// Perfil Propiedades				    	
				$hasta_donde = $_POST["numero_carros"] + 1;
				for ($i=1; $i < $hasta_donde; $i++) { // CARROS
						$x = 1;
						$idid = "id_carr".$i;  $id_carr = $_POST[$idid];
						$marcaid = "marca".$i;  $marca = $_POST[$marcaid];
						$modeloid = "modelo".$i;  $modelo = $_POST[$modeloid];
						$yearid = "year".$i;  $year = $_POST[$yearid];
						$propietarioid = "propietario".$i;  $propietario = $_POST[$propietarioid];
						$tipoid = "tipo".$i;  $tipo = $_POST[$tipoid];
						$multasid = "multas".$i;  $multas = $_POST[$multasid];

						$cuandoid = "cuando".$i;  $cuando = $_POST[$cuandoid];
						$placaid = "placa".$i;  $placa = $_POST[$placaid];
						$num_serieid = "num_serie".$i;  $num_serie = $_POST[$num_serieid];
						$comentariosid = "comentarios".$i;  $comentarios = $_POST[$comentariosid];

						$yearid = "year".$i;  $year = $_POST[$yearid];
						if($id_carr == ''){ $x=2;
							if($marca != ''){
								$sql12 = "INSERT INTO carro(cliente, marca, modelo, year, propietario, tipo, multas, cuando, placa, 
									num_serie, comentarios) 
								VALUES('".$id."', '".$marca."','".$modelo."', '".$year."', '".$propietario."', '".$tipo."', 
									'".$multas."', '".$cuando."', '".$placa."', '".$num_serie."', '".$comentarios."')";
								$result2 = mysql_query($sql12);
							};
						}else{$x=3;
							$sql2 = "UPDATE carro SET marca='".$marca."', modelo='".$modelo."', year='".$year."', 
							propietario='".$propietario."', tipo='".$tipo."', multas='".$multas."', cuando='".$cuando."',
							placa='".$placa."', num_serie='".$num_serie."', comentarios='".$comentarios."' WHERE id=".$id_carr;				
							$result2 = mysql_query($sql2);
						};
				};
		};// FIN de Perfil Propiedades
		if($seccion == '5'){// Perfil REFERENCIAS
				$hasta_donde = $_POST["copy_ref_cant"] + 1;// REFERENCIAS - GENTE
				for ($i=1; $i < $hasta_donde; $i++) { 
						$x = 1;
						$idid = "id_ref".$i;  $id_ref = $_POST[$idid];
						$ref_tipoid = "ref_tipo".$i;  $ref_tipo = $_POST[$ref_tipoid];
						$ref_familiar_parentescoid = "ref_familiar_parentesco".$i;  $ref_familiar_parentesco = $_POST[$ref_familiar_parentescoid];
						$ref_familiarid = "ref_familiar".$i;  $ref_familiar = $_POST[$ref_familiarid];
						$ref_familiar_domicilid = "ref_familiar_domicil".$i;  $ref_familiar_domicil = $_POST[$ref_familiar_domicilid];
						$ref_familiar_celularid = "ref_familiar_celular".$i;  $ref_familiar_celular = $_POST[$ref_familiar_celularid];
						$ref_familiar_telefonoid = "ref_familiar_telefono".$i;  $ref_familiar_telefono = $_POST[$ref_familiar_telefonoid];


						$yearid = "year".$i;  $year = $_POST[$yearid];
						if($id_ref == ''){ $x=2;
							if($ref_familiar != ''){$x=11;
								$sql12 = "INSERT INTO referencias(cliente, tipo, nombre, parentesco, celular, telefono, 
									domicilio, referencia) 
								VALUES('".$id."', '".$ref_tipo."','".$ref_familiar."', '".$ref_familiar_parentesco."', 
									'".$ref_familiar_celular."', '".$ref_familiar_telefono."', '".$ref_familiar_domicil."', 
									'".$referencia."')";
								$result2 = mysql_query($sql12);
							};
						}else{$x=3;
							$sql2 = "UPDATE referencias SET tipo='".$ref_tipo."', nombre='".$ref_familiar."', 
							parentesco='".$ref_familiar_parentesco."', celular='".$ref_familiar_celular."', 
							telefono='".$ref_familiar_telefono."', domicilio='".$ref_familiar_domicil."', 
							referencia='".$referencia."'
							WHERE id=".$id_ref;				
							$result2 = mysql_query($sql2);
						};
				};// REFERENCIAS - GENTE

				$hasta_donde2 = $_POST["copy_refc_cant"] + 1;// REFERENCIAS - CREDITICIAS
				for ($i=1; $i < $hasta_donde2; $i++) { 
						$x = 1;
						$idid2 = "id_refc".$i;  $id_refc = $_POST[$idid2];
						$num_tarjetaid = "num_tarjeta".$i;  $num_tarjeta = $_POST[$num_tarjetaid];
						$institucionid = "institucion".$i;  $institucion = $_POST[$institucionid];
						$limite_creditoid = "limite_credito".$i;  $limite_credito = $_POST[$limite_creditoid];
						
						$yearid = "year".$i;  $year = $_POST[$yearid];
						if($id_refc == ''){ $x=2;
							if($limite_credito != ''){$x=11;
								$sql12 = "INSERT INTO referencias_crediticias(cliente, num_tarjeta, limite_credito, institucion) 
								VALUES('".$id."', '".$num_tarjeta."','".$limite_credito."', '".$institucion."')";
								$result2 = mysql_query($sql12);
							};
						}else{$x=3;
							$sql2 = "UPDATE referencias_crediticias SET num_tarjeta='".$num_tarjeta."', limite_credito='".$limite_credito."', 
							institucion='".$institucion."' WHERE id=".$id_refc;				
							$result2 = mysql_query($sql2);
						};
				};// REFERENCIAS crediticias
		};// FIN de Perfil REFERENCIAS

		if($seccion == '6'){// Perfil ANALISIS DE CLIENTE

				    	$sql15 = "UPDATE cliente SET riesgo='".$_POST["riesgo"]."', google='".$_POST["google"]."',
				    	buro_credito='".$_POST["buro_credito"]."', linea_credito='".$_POST["linea_credito"]."', 
				    	buro_interno='".$_POST["buro_interno"]."', papeles_carro='".$_POST["papeles_carro"]."', 
				    	aval='".$_POST["aval"]."', comentarios_analisis='".$_POST["comentarios_analisis"]."', 
				    	observaciones_grales='".$_POST["observaciones_grales"]."' WHERE id=".$id;				
						$result5 = mysql_query($sql15);

		};// FIN de Perfil ANALISIS DE CLIENTE
		
	};
		
if($id == ''){			
	// contacto, apellido_materno, fecha_nacimiento, sexo, lugar_nacimiento, celular, rfc
	$sql0 = "SELECT * FROM cliente WHERE contacto='".$_POST["contacto"]."' AND apellido_materno='".$_POST["apellido_materno"]."'
	AND fecha_nacimiento='".$_POST["fecha_nacimiento"]."' AND sexo='".$_POST["sexo"]."' AND rfc='".$_POST["rfc"]."'
	AND lugar_nacimiento='".$_POST["lugar_nacimiento"]."' AND celular='".$_POST["celular"]."' ORDER BY id DESC";
	$result0 = mysql_query($sql0, $conn1);
	$row0 = mysql_fetch_array($result0);
	header("location: ../agregar-cliente.php?tipo=mod&id=".$row0["id"]);		
}
else{			
	header("location: ../agregar-cliente.php?tipo=mod&id=".$id."&x=".$x);	
};
	
				mysql_close($conn1);
				$llego = 'ok';
};
?>