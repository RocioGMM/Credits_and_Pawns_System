<?php
session_start();
if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user') || ($_SESSION["tipo"] == 'vendedor')){
include ("panel/conn1.php");
include ("panel/rempla_fech.php");
$mas = $_POST["mas"];if($mas == ''){$mas = $_REQUEST["mas"];};
$otro_hoy = $_POST["otro_hoy"];if($otro_hoy == ''){$otro_hoy = $_REQUEST["otro_hoy"];};
$buscar = $_POST["buscar"];if($buscar == ''){$buscar = $_REQUEST["buscar"];};


if ($_SESSION["tipo"] == 'admin'){
	$lugar_lib = $_REQUEST["lugar"];
}else{
	$lugar_lib = $_SESSION["lugar"];	
};

if($lugar_lib == ''){$lugar_lib = '1';};


$tamanio_pag = 15;
$pagina = $_GET["pagina"];
	
if(!$pagina){
	$inicio = 0;
	$pagina = 1;
	}
else{
	$inicio = ($pagina  - 1) * $tamanio_pag;
	};
		
$sqlpag = "SELECT * FROM libramientos WHERE lugar='".$lugar_lib."'		";
$rspag = mysql_query($sqlpag);
$total_registros = mysql_num_rows($rspag);
$total_paginas = ceil($total_registros / $tamanio_pag);
mysql_free_result($rspag);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Administrador</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
input.cambusc {
	border: 1px solid #948EB7;
	color: #666;
	display: block;
	float: left;
	margin-top: 0px;
	margin-right: 7px;
	margin-bottom: 0px;
	margin-left: 0px;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="includes/ice/ice.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width">
</head>

<body>
<div class="gruap">
<!--
<div class="log-out">
  <div class="lo-logo"><img src="logosdi.png" height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>-->
<script type="text/javascript">
$(document).ready(function() {
	var s = $("#sticker");
	var pos = s.position();	
	var stickermax = $(document).outerHeight() - $("#footer").outerHeight() - s.outerHeight() - 40; //40 value is the total of the top and bottom margin
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		//s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);
		if (windowpos >= pos.top && windowpos < stickermax) {
			s.attr("style", ""); //kill absolute positioning
			s.addClass("stick"); //stick it
		} else if (windowpos >= stickermax) {
			s.removeClass(); //un-stick
			s.css({position: "absolute", top: stickermax + "px"}); //set sticker right above the footer
			
		} else {
			s.removeClass(); //top of page
		}
	});
	//alert(stickermax); //uncomment to show max sticker postition value on doc.ready
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var s = $("#stickem");
	var pos = s.position();	
	var stickermax = $(document).outerHeight() - $("#footer").outerHeight() - s.outerHeight() - 40; //40 value is the total of the top and bottom margin
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		//s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos -1px);
		if (windowpos >= pos.top && windowpos < stickermax) {
			s.attr("style", ""); //kill absolute positioning
			s.addClass("stickem"); //stick it
		} else if (windowpos >= stickermax) {
			s.removeClass(); //un-stick
			s.css({position: "absolute", top: stickermax + "px"}); //set sticker right above the footer
			
		} else {
			s.removeClass(); //top of page
		}
	});
	//alert(stickermax); //uncomment to show max sticker postition value on doc.ready
});
</script>


<div class="menubar">
  <a href="programacion.php" class="op log" id="logbiev"></a>
<?php 	$sql7 = "SELECT * FROM  usuario WHERE id='".$_SESSION["iduser"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
<a class="op loname" id="bienve">Bienvenido, <?php echo $row7["nombre"];?>! <br />
<?php 
		if ($_SESSION["tipo"] != 'user'){
		$sql7 = "SELECT * FROM vendedor WHERE id='".$_SESSION["vendedor"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
</a>
<?php };?>


  <a href="salir.php" class="lo-logout-new" title="Salir"></a>
  <a href="programacion.php" class="op lop">Inicio</a>
  <a href="estadisticas.php" class="op mop">Estadisticas</a>
<?php if($_SESSION["tipo"] == 'admin'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php  };?>

</div>

<div >


    <?php 	
			$created = date("Y-m-d H:i:s");
			//$created = date ( 'Y-m-d H:i:s' , strtotime( "$created -7 hour" ) );//resta 7 horas porque el server esta adelandado 7 horas			
			//echo $created;

			if($otro_hoy != ''){	$hoy = $otro_hoy;}
			else{  		$hoy = substr($created,0,4).'-'.substr($created,5,2).'-'.substr($created,8,2);		};
			//echo $hoy;
			
			$dia_hoy = substr($hoy,8,2);
			$mes_hoy = substr($hoy,5,2);
			$ano_hoy = substr($hoy,0,4);
			 
			$cuenta_dias = 1;
			$empieza = '';
			$dia_cuadro = $ano_hoy.'-'.$mes_hoy.'-01';
			$dia_primero = $ano_hoy.'-'.$mes_hoy.'-01';
			
			$fecha_inicio = $ano_hoy.'-'.$mes_hoy.'-01'; //primer dia del mes
			
			$mes = mktime( 0, 0, 0, $mes_hoy, 1, $ano_hoy ); //encontrar ultimo dia del mes
			$ultimo_dia = date("t",$mes);
			$fecha_fin = $ano_hoy.'-'.$mes_hoy.'-'.$ultimo_dia;// ultimo dia del mes

$dia_testeo = $dia_cuadro;
for($h = 1 ; $h < 32 ; $h ++){
 
	if ($_SESSION["tipo"] == 'vendedor'){
		$sql1 = "SELECT * FROM evento_act WHERE fecha='".$dia_testeo."' AND vendedor='".$_SESSION["vendedor"]."' ORDER BY fecha DESC";
	}else{
		$sql1 = "SELECT * FROM evento_act WHERE fecha='".$dia_testeo."' ORDER BY fecha DESC";
	};
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
	if($row["id"] != ''){ 		$matriz_testeo[$h] = 'ok'; 		};
	$dia_testeo = date ( 'Y-m-j' , strtotime( "$dia_testeo +1 day" ) );
	}
	$mes_sig = date ( 'Y-m-j' , strtotime( "$hoy +1 month" ) );
	$mes_ant = date ( 'Y-m-j' , strtotime( "$hoy -1 month" ) );


	?>
            
</div>






<div class="onecolc_tto">

<div class="menu_onecolc">
	<a href="" class="menu_onecolc_btn">
		<img src="images/USUARIO.svg" alt="Usuarios"/>
		<div class="menu_onecolc_text">Usuarios</div>
	</a>
	<a href="cliente.php" class="menu_onecolc_btn">
		<img src="images/CLIENTES.svg" alt="Clientes"/>
		<div class="menu_onecolc_text">Clientes</div>
	</a>
	<a href="sucursales.php" class="menu_onecolc_btn">
		<img src="images/SUCURSALES.svg" alt="Sucursales"  />
		<div class="menu_onecolc_text">Sucursales</div>
	</a>
	<a href="" class="menu_onecolc_btn">
		<img src="images/CARTERA.svg" alt="Cartera" />
		<div class="menu_onecolc_text">Cartera</div>
	</a>
	<a href="simulacion.php" class="menu_onecolc_btn">
		<img src="images/REPORTES.svg" alt="Simulacion"/>
		<div class="menu_onecolc_text">Simulacion</div>
	</a>
	<!--<a href="" class="menu_onecolc_btn"><img src="images/REPORTES.svg" alt="Reportes" title="Reportes" /></a>-->
	<a href="" class="menu_onecolc_btn">
		<img src="images/VENDEDORES.svg" alt="Vendedores" />
		<div class="menu_onecolc_text">Vendedores</div>
	</a>
	<a href="producto_financiero.php" class="menu_onecolc_btn">
		<img src="images/PROD_FINANCIERO.svg" alt="Productos Financieros"  />
		<div class="menu_onecolc_text">Productos Financieros</div>
	</a>
	<a href="" class="menu_onecolc_btn">
		<img src="images/EMPENOS.svg" alt="Empeños" />
		<div class="menu_onecolc_text">Empeños</div>
	</a>
	<a href="" class="menu_onecolc_btn">
		<img src="images/COBRANZAS.svg" alt="Cobranzas"  />
		<div class="menu_onecolc_text">Cobranzas</div>
	</a>
</div>




<div class="onecolc"> 



<span class="titlecol tcolor eiix">PAGOS</span>

<div class="divline"></div>
<div id="stickem"></div>
<!--  
  <div id="sticker">  
    <div class="time-j ti">FOLIO</div>
    <div class="t-contact">DATOS</div>
    <div class="t-actividad">ULTIMA MOD.</div>
    <div class="t-desit">PROGRESO</div>
    <div class="t-progres"></div>
  </div>   
-->




 <?php 
	$sql1 = "SELECT * FROM libramientos WHERE lugar='".$lugar_lib."' ORDER BY id DESC LIMIT ".$inicio.",".$tamanio_pag;;
	$result1 = mysql_query($sql1, $conn1);
	$total_registrosdeldia = mysql_num_rows($result1);
  ?>


<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

while($row = mysql_fetch_array($result1)){?>


  <div class="initem">
            
    <!--
    <a <?php  if ($_SESSION["tipo"] == 'admin'){?> href="agregar-libra.php?id=<?php echo $row["id"];?>"<?php };?> target="_self">  
    	<div class="time-j ti"><?php echo $row["id"];?></div>  
    </a>  -->
    
    
    <div class="time-j ti">  <?php echo $row["expediente"]// LIBRAMIENTO		?>	</div>
    <div class="contact">  
    					   <strong>Nombre</strong><br>	<?php echo $row["nombre"]// NOMBRE DEL AFECTADO		?>	<br>
    					   <strong>Encadenamiento</strong><br> <?php echo $row["encadenamiento"]// ENCADENAMIENTO		?>	
    </div>


    <div class="actividad"> <?php echo substr($row["ultima_actualizacion"],8,2).'-'.substr($row["ultima_actualizacion"],5,2).'-'.substr($row["ultima_actualizacion"],0,4); ///////////	FECHA?></div>
    

        
<?php if($_SESSION["tipo"] != 'user'){?>
<div class="ic-idel"><a href="agregar-libra.php?id=<?php echo $row["id"];?>" target="_self"><img src="editaricon.png" width="44" height="44" border="0" /></a></div>
<?php };?> 


<?php 		if($_SESSION["tipo"] == 'admin'){		?>
<div class="ic-idel"><a href="eliminar-libra.php?id=<?php echo $row["id"];?>" target="_self"><img src="delete1.png" width="44" height="44" border="0" /></a></div>
<?php 		};		?>
 

    <div class="t-progres imgalcost nitop"> 

    <?php 
    	$sql5 = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='1' ORDER BY id DESC";// Visita
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 

		$sqltl = "SELECT * FROM progreso_tipo WHERE id='1' ORDER BY id DESC";// Visita
		$resulttl = mysql_query($sqltl, $conn1);
		$rowtl = mysql_fetch_array($resulttl); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5["estado"]?>">
    			<img src="ico/<?= $rowtl["images"]?>" width="42" height="42" border="0" />
    		</a>
    		

   



    <?php 
    	$sql5b = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='2' ORDER BY id DESC";// Visita
		$result5b = mysql_query($sql5b, $conn1);
		$row5b = mysql_fetch_array($result5b); 

		$sqltlb = "SELECT * FROM progreso_tipo WHERE id='2' ORDER BY id DESC";// Visita
		$resulttlb = mysql_query($sqltlb, $conn1);
		$rowtlb = mysql_fetch_array($resulttlb); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5b["estado"]?>">
    			<img src="ico/<?= $rowtlb["images"]?>" width="42" height="42" border="0" />
    		</a>



 

    <?php 
    	$sql5c = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='3' ORDER BY id DESC";// Visita
		$result5c = mysql_query($sql5c, $conn1);
		$row5c = mysql_fetch_array($result5c); 

		$sqltlc = "SELECT * FROM progreso_tipo WHERE id='3' ORDER BY id DESC";// Visita
		$resulttlc = mysql_query($sqltlc, $conn1);
		$rowtlc = mysql_fetch_array($resulttlc); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5c["estado"]?>">
    			<img src="ico/<?= $rowtlc["images"]?>" width="42" height="42" border="0" />
    		</a>



    

    <?php 
    	$sql5d = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='4' ORDER BY id DESC";// Visita
		$result5d = mysql_query($sql5d, $conn1);
		$row5d = mysql_fetch_array($result5d); 

		$sqltld = "SELECT * FROM progreso_tipo WHERE id='4' ORDER BY id DESC";// Visita
		$resulttld = mysql_query($sqltld, $conn1);
		$rowtld = mysql_fetch_array($resulttld); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5d["estado"]?>">
    			<img src="ico/<?= $rowtld["images"]?>" width="42" height="42" border="0" />
    		</a>




    

    <?php 
    	$sql5e = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='5' ORDER BY id DESC";// Visita
		$result5e = mysql_query($sql5e, $conn1);
		$row5e = mysql_fetch_array($result5e); 

		$sqltle = "SELECT * FROM progreso_tipo WHERE id='5' ORDER BY id DESC";// Visita
		$resulttle = mysql_query($sqltle, $conn1);
		$rowtle = mysql_fetch_array($resulttle); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5e["estado"]?>">
    			<img src="ico/<?= $rowtle["images"]?>" width="42" height="42" border="0" />
    		</a>



    

    <?php 
    	$sql5f = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='6' ORDER BY id DESC";// Visita
		$result5f = mysql_query($sql5f, $conn1);
		$row5f = mysql_fetch_array($result5f); 

		$sqltlf = "SELECT * FROM progreso_tipo WHERE id='6' ORDER BY id DESC";// Visita
		$resulttlf = mysql_query($sqltlf, $conn1);
		$rowtlf = mysql_fetch_array($resulttlf); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5f["estado"]?>">
    			<img src="ico/<?= $rowtlf["images"]?>" width="42" height="42" border="0" />
    		</a>



    

    <?php 
    	$sql5f = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='7' ORDER BY id DESC";// Visita
		$result5f = mysql_query($sql5f, $conn1);
		$row5f = mysql_fetch_array($result5f); 

		$sqltlf = "SELECT * FROM progreso_tipo WHERE id='7' ORDER BY id DESC";// Visita
		$resulttlf = mysql_query($sqltlf, $conn1);
		$rowtlf = mysql_fetch_array($resulttlf); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5f["estado"]?>">
    			<img src="ico/<?= $rowtlf["images"]?>" width="42" height="42" border="0" />
    		</a>



    

    <?php 
    	$sql5f = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='8' ORDER BY id DESC";// Visita
		$result5f = mysql_query($sql5f, $conn1);
		$row5f = mysql_fetch_array($result5f); 

		$sqltlf = "SELECT * FROM progreso_tipo WHERE id='8' ORDER BY id DESC";// Visita
		$resulttlf = mysql_query($sqltlf, $conn1);
		$rowtlf = mysql_fetch_array($resulttlf); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5f["estado"]?>">
    			<img src="ico/<?= $rowtlf["images"]?>" width="42" height="42" border="0" />
    		</a>



    

    <?php 
    	$sql5f = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='9' ORDER BY id DESC";// Visita
		$result5f = mysql_query($sql5f, $conn1);
		$row5f = mysql_fetch_array($result5f); 

		$sqltlf = "SELECT * FROM progreso_tipo WHERE id='9' ORDER BY id DESC";// Visita
		$resulttlf = mysql_query($sqltlf, $conn1);
		$rowtlf = mysql_fetch_array($resulttlf); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5f["estado"]?>">
    			<img src="ico/<?= $rowtlf["images"]?>" width="42" height="42" border="0" />
    		</a>



    

    <?php 
    	$sql5f = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='10' ORDER BY id DESC";// Visita
		$result5f = mysql_query($sql5f, $conn1);
		$row5f = mysql_fetch_array($result5f); 

		$sqltlf = "SELECT * FROM progreso_tipo WHERE id='10' ORDER BY id DESC";// Visita
		$resulttlf = mysql_query($sqltlf, $conn1);
		$rowtlf = mysql_fetch_array($resulttlf); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5f["estado"]?>">
    			<img src="ico/<?= $rowtlf["images"]?>" width="42" height="42" border="0" />
    		</a>



    

    <?php 
    	$sql5f = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='11' ORDER BY id DESC";// Visita
		$result5f = mysql_query($sql5f, $conn1);
		$row5f = mysql_fetch_array($result5f); 

		$sqltlf = "SELECT * FROM progreso_tipo WHERE id='11' ORDER BY id DESC";// Visita
		$resulttlf = mysql_query($sqltlf, $conn1);
		$rowtlf = mysql_fetch_array($resulttlf); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5f["estado"]?>">
    			<img src="ico/<?= $rowtlf["images"]?>" width="42" height="42" border="0" />
    		</a>



    

    <?php 
    	$sql5f = "SELECT * FROM progreso WHERE libramiento='".$row["id"]."' AND tipo ='12' ORDER BY id DESC";// Visita
		$result5f = mysql_query($sql5f, $conn1);
		$row5f = mysql_fetch_array($result5f); 

		$sqltlf = "SELECT * FROM progreso_tipo WHERE id='12' ORDER BY id DESC";// Visita
		$resulttlf = mysql_query($sqltlf, $conn1);
		$rowtlf = mysql_fetch_array($resulttlf); 

    	//if($row5["estado"] == $evento_ck_ult){
    ?>
    		<a class="imagen-icolib" style="background-color:#<?= $row5f["estado"]?>">
    			<img src="ico/<?= $rowtlf["images"]?>" width="42" height="42" border="0" />
    		</a>





    </div>
    
    
    
    <!--<div class="i-stat">
    <?php if($row["entregado"] == '1'){?>Entregado<br /><?php }?>
    <?php if($row["pagado"] == '1'){?>Pagado<?php }//*/?>
    <?php if($row["entregado"] != '1' && $row["pagado"] != '1'){?>Capturado	<?php };//*/?>
    </div>-->
    
     

    <br /> 
  
  </div>
<?php };?> 




  
  
  
  <div class="paginadors"><!---------------------------------------- PAGINADOR  ---------------------------------- -->
<?php if(($pagina - 1) > 0){?>
<div class="paginadors2 separapagder">
  <?php echo '<a href="index.php?pagina='.($pagina - 1).'" >Anterior</a>';?></div>
<?php };?>


<?php
  if($pagina > 5){
    $inicio0s = $pagina - 5;
    $fin0s =  $pagina - 1;
    for($i=$inicio0s;$i<=$fin0s;$i++){     echo '<div class="paginadors2 separapagder"><a href="programacion.php?pagina='.$i.'">'.$i.'</a></div>';          };
  };
?>
<?php
if($total_paginas > 1){
  if($pagina > 5){
    $inicio1s = $pagina;
    $fin1s =  $pagina + 5;
  }else{
    $inicio1s = 1;
    $fin1s =  "11";    
  };
  if($fin1s > $total_paginas){$fin1s = $total_paginas;}
  for($i=$inicio1s;$i<=$fin1s;$i++){
    if($pagina == $i){        echo '<div class="paginadors3 separapagder">'.$i.'</div>';      }
    else{      echo '<div class="paginadors2 separapagder"><a href="programacion.php?pagina='.$i.'">'.$i.'</a></div>';      };
    };

  };
?>

<?php if(($pagina + 1) <= $total_paginas){?>
    <div class="paginadors2"><?php echo '<a href="programacion.php?pagina='.($pagina + 1).'">Siguiente</a>';?></div>
<?php };?>
</div>






  
  
  <div class="cf"></div>
</div>


</div>






</div>
</body>
</html>

<?php
	mysql_close($conn1);
	}
else{
	//header("location: index.php");
	echo $_SESSION["user"];
	};	
?>
