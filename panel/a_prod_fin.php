<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$hoy_es = date("Y-m-d H:i:s");

$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};


if ($id == ''){ $aqui = '0';
	$sql11 = "INSERT INTO producto_financiero(Alias, tipo, base_calculo_pi, interes_ord, calculo_so, 
	interes_mor, calculo_so_m, max_dias, fecha_creacion, fecha_modificacion) 
	VALUES('".$_POST["Alias"]."', '".$_POST["tipo"]."', '".$_POST["base_calculo_pi"]."', '".$_POST["interes_ord"]."', 
	'".$_POST["calculo_so"]."', '".$_POST["interes_mor"]."', '".$_POST["calculo_so_m"]."', '".$_POST["max_dias"]."',
	'".$hoy_es."', '".$hoy_es."')";
	$result = mysql_query($sql11);
								
}else{
	$sql1 = "UPDATE producto_financiero SET Alias='".$_POST["Alias"]."',  tipo='".$_POST["tipo"]."',   
	base_calculo_pi='".$_POST["base_calculo_pi"]."',  interes_ord='".$_POST["interes_ord"]."', 
	calculo_so='".$_POST["calculo_so"]."', interes_mor='".$_POST["interes_mor"]."', 
	calculo_so_m='".$_POST["calculo_so_m"]."', max_dias='".$_POST["max_dias"]."',
	fecha_modificacion='".$hoy_es."' WHERE id=".$id;				
	$result = mysql_query($sql1);
};


if($id == ''){
	$sql3 = "SELECT * FROM producto_financiero WHERE Alias='".$_POST["Alias"]."' AND fecha_creacion='".$hoy_es."' ORDER BY id DESC ";
    $result3 = mysql_query($sql3, $conn1);
	$row3 = mysql_fetch_array($result3);
	$id = $row3["id"];
};
	$banderita = '';
	for ($i=1; $i < $_POST["nro_cond_t"] + 1; $i++) { 
		$id_cond = '';
		$id_cond_id = "id_cond".$i; $id_cond = $_POST[$id_cond_id];
		$pf_capital_va_id = "pf_capital_va".$i; $pf_capital_va = $_POST[$pf_capital_va_id];
		$pf_capital_vb_id = "pf_capital_vb".$i; $pf_capital_vb = $_POST[$pf_capital_vb_id];
		$pf_dias_va_id = "pf_dias_va".$i; $pf_dias_va = $_POST[$pf_dias_va_id];
		$pf_dias_vb_id = "pf_dias_vb".$i; $pf_dias_vb = $_POST[$pf_dias_vb_id];
		$comicion_ap_id = "comicion_ap".$i; $comicion_ap = $_POST[$comicion_ap_id];
		$comicion_ap_cant_id = "comicion_ap_cant".$i; $comicion_ap_cant = $_POST[$comicion_ap_cant_id];
		$comicion_ap_iva_id = "comicion_ap_iva".$i; $comicion_ap_iva = $_POST[$comicion_ap_iva_id];
		$comicion_ap_cant_b_id = "comicion_ap_cant_b".$i; $comicion_ap_cant_b = $_POST[$comicion_ap_cant_b_id];
		$comicion_ap_iva_b_id = "comicion_ap_iva_b".$i; $comicion_ap_iva_b = $_POST[$comicion_ap_iva_b_id];
		$interes_ord_an_id = "interes_ord_an".$i; $interes_ord_an = $_POST[$interes_ord_an_id];
		$interes_ord_aniva_id = "interes_ord_aniva".$i; $interes_ord_aniva = $_POST[$interes_ord_aniva_id];
		$interes_mor_an_id = "interes_mor_an".$i; $interes_mor_an = $_POST[$interes_mor_an_id];
		$interes_mor_aniva_id = "interes_mor_aniva".$i; $interes_mor_aniva = $_POST[$interes_mor_aniva_id];
		$costo_al_mes_id = "costo_al_mes".$i; $costo_al_mes = $_POST[$costo_al_mes_id];
		$costo_al_mesiva_id = "costo_al_mesiva".$i; $costo_al_mesiva = $_POST[$costo_al_mesiva_id];
		$periodo_gracia_id = "periodo_gracia".$i; $periodo_gracia = $_POST[$periodo_gracia_id];
		$comicion_x_venta_id = "comicion_x_venta".$i; $comicion_x_venta = $_POST[$comicion_x_venta_id];
		$comicion_x_venta_iva_id = "comicion_x_venta_iva".$i; $comicion_x_venta_iva = $_POST[$comicion_x_venta_iva_id];
		$dia_gracia_id = "dia_gracia".$i; $dia_gracia = $_POST[$dia_gracia_id];
		$costo_reposicion_id = "costo_reposicion".$i; $costo_reposicion = $_POST[$costo_reposicion_id];
		
		$banderita .= '('.$id_cond.'';

		if($id_cond == ''){
		$sql12 = "INSERT INTO condiciones(producto_financiero, pf_capital_va, pf_capital_vb, pf_dias_va, pf_dias_vb, 
			comicion_ap, comicion_ap_cant, comicion_ap_iva, comicion_ap_cant_b, comicion_ap_iva_b, interes_ord_an, 
			interes_ord_aniva, interes_mor_an, interes_mor_aniva, costo_al_mes, costo_al_mesiva, periodo_gracia, 
			comicion_x_venta, comicion_x_venta_iva, dia_gracia, costo_reposicion) 
		VALUES('".$id."', '".$pf_capital_va."', '".$pf_capital_vb."', '".$pf_dias_va."', '".$pf_dias_vb."',
			'".$comicion_ap."', '".$comicion_ap_cant."', '".$comicion_ap_iva."', '".$comicion_ap_cant_b."',			
			'".$comicion_ap_iva_b."', '".$interes_ord_an."', '".$interes_ord_aniva."', '".$interes_mor_an."', 
			'".$interes_mor_aniva."', '".$costo_al_mes."', '".$costo_al_mesiva."', '".$periodo_gracia."', 
			'".$comicion_x_venta."','".$comicion_x_venta_iva."', '".$dia_gracia."', '".$costo_reposicion."')";
			$banderita .= '-a)';
		}else{
			$sql12 = "UPDATE condiciones SET pf_capital_va='".$pf_capital_va."',  pf_capital_vb='".$pf_capital_vb."',   
			pf_dias_va='".$pf_dias_va."', pf_dias_vb='".$pf_dias_vb."', comicion_ap='".$comicion_ap."',
			comicion_ap_cant='".$comicion_ap_cant."', comicion_ap_iva='".$comicion_ap_iva."', 
			comicion_ap_cant_b='".$comicion_ap_cant_b."', comicion_ap_iva_b='".$comicion_ap_iva_b."', 
			interes_ord_an='".$interes_ord_an."', interes_ord_aniva='".$interes_ord_aniva."', 
			interes_mor_an='".$interes_mor_an."', interes_mor_aniva='".$interes_mor_aniva."', 
			costo_al_mes='".$costo_al_mes."', costo_al_mesiva='".$costo_al_mesiva."', periodo_gracia='".$periodo_gracia."', 
			comicion_x_venta='".$comicion_x_venta."', comicion_x_venta_iva='".$comicion_x_venta_iva."', 
			dia_gracia='".$dia_gracia."', costo_reposicion='".$costo_reposicion."' WHERE id=".$id_cond;	
			$banderita .= '-b)';
		};
		$result2 = mysql_query($sql12);
	};
		
	if($vi == ''){			header("location: ../producto_financiero.php?id=".$_POST["id"]."&id_cond=".$banderita);		}
	else{			header("location: ../agregar-producto_f.php");		};
	
				mysql_close($conn1);
				$llego = 'ok';
};
?>