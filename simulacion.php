<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");


$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />


<!----------------------------------------      AUTOCOMPLETAR   ----------------------------------- -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
        
        <script type="text/javascript">
                $(document).ready(function(){
                    $("#busclie").autocomplete({
                      source:'getautocomplete.php',
                      multiple: true,
                      minLength:1
                    });
                });
        
        </script> 
        <!---------------------------------------------------------------------------------------- -->


</head>

<body>

    <div class="menubar" > 
  <a href="programacion.php" class="op log"></a>
<?php   $sql7 = "SELECT * FROM  usuario WHERE id='".$_SESSION["iduser"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
  <a href="cuenta.php" class="op loname">Bienvenido <?php echo $row7["nombre"];?>! <br /></a>


  <a href="salir.php" class="lo-logout-new" title="Salir"></a>
  <a href="programacion.php" class="op lop">Inicio</a>
  <a href="estadisticas.php" class="op mop">Estadisticas</a>
<?php if($_SESSION["tipo"] == 'admin'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php  };?>
</div>
  <!--
  <div class="bann-int">
<div class="today">
<?php  
  $created = date("Y-m-d H:i:s");
  $dia_hoy = substr($created,8,2);
  $mes_hoy = substr($created,5,2); 
?>
<span class="day"><?php echo replacemes($mes_hoy);?></span>
<span class="dayn"><?php echo $dia_hoy;?> </span>
</div>
<div class="btn-proys"><a href="programacion.php"><img src="checkicon.png" width="44" height="44" /></a></div>
<span class="titlesec">CLIENTES</span>
</div>
  -->
  
  <div class="tp">
	<div class="subpanel"><!--
		<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
		<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>-->
	</div>
	<div class="cf"></div>
</div>  
    
<div class="onecol" >

<span class="titlecol-ad">Mis Simulaciones Guardadas</span>

<div class="icons-men"><a href="agregar-simulacion.php"><img src="images/mas.svg" width="64" height="42" /></a></div>
<!--
<form action="" method="post" class="cuscliform" >
  <input type="text" name="busclie" id="busclie" placeholder=" Buscar Producto Financiero" class="buscli1"/> 
  <input type="submit" name="add"  value="Buscar" class="buscli2"/>
</form>
-->
<div class="divline"></div>
  
  <div class="initem">
    <div class="ti t-uname">FOLIO </div>
    <div class="t-uname">CLIENTE </div>
    <div class="ti t-uname">FECHA</div>
    <div class="ti t-uname">SOLICITA</div>
    <div class="t-uemail">PRODUCTO FINANCIERO</div>
    <div class="t-contact">PROMOTOR</div>
  </div>
<?php if($_POST["busclie"] != ''){

        $sqlpag= "SELECT * FROM cliente WHERE ".$subsecz." ";//PAGINADOR
         $rspag = mysql_query($sqlpag);
         $total_registros = mysql_num_rows($rspag);
         $total_paginas = ceil($total_registros / $tamanio_pag);
         mysql_free_result($rspag);

        $porciones = explode(" (", $_POST["busclie"]);
        $porciones_con = str_replace(")", "", $porciones["1"]);
        $sql1 = "SELECT * FROM cliente WHERE nombre_empresa like '%".$porciones["0"]."%' OR contacto like '%".$porciones_con."%' ORDER BY nombre_empresa ASC  LIMIT '".$inicio."','".$tamanio_pag."'    ";
      }else{
        $sqlpag= "SELECT * FROM cliente  ";//PAGINADOR
         $rspag = mysql_query($sqlpag);
         $total_registros = mysql_num_rows($rspag);
         $total_paginas = ceil($total_registros / $tamanio_pag);
         mysql_free_result($rspag);

        $sql1 = "SELECT * FROM cliente ORDER BY id DESC LIMIT ".$inicio.",".$tamanio_pag;
      };  		
		  $result1 = mysql_query($sql1, $conn1);
		  while($row1 = mysql_fetch_array($result1)){
?>
  <a class="initem"  href="agregar-cliente.php?tipo=mod&id=<?php echo $row1["id"];?>"
  <?php if($row1["vendedor"] ==''){echo 'style="color:#FF0000 !important;"';};?>>
    <div class="ti uname"><?php echo str_pad($row1["id"], 3, "0", STR_PAD_LEFT);?></div>
    <div class="uname"><?php echo $row1["contacto"].' '.$row1["apellido"];?></div>
    <div class="ti uname"><?php echo $row1["fecha"];?></div>
    <div class="ti uname"><?php echo $row1["fecha"];?></div>
    <div class="uemail"><?php echo $rowvend["nombre"];?></div>
    <div class="t-contact"><?php echo $row1["fecha"];?></div>    
  </a>
  <?php };?>
  <div class="cf"></div>
</div>
</body>
</html>

<?php

	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};	
?>