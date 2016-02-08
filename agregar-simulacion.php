<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};

if ($id != ''){
	$sql1 = "SELECT * FROM sucursales WHERE id='".$id."' ";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
};


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link href="styles.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
</head>

<body>

<!--
<div class="log-out">
  <div class="lo-logo"><img src="logoconcre.png" width="206" height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>-->

<div class="menubar" >
  <a href="programacion.php" class="op log"></a>
<?php   $sql7 = "SELECT * FROM  usuario WHERE id='".$_SESSION["iduser"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
  <a  class="op loname">Bienvenido <?php echo $row7["nombre"];?>! </a>



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
<div class="btn-proys"><a href="sucursales.php"><img src="back-clientes.png" width="44" height="44" /></a></div>
<span class="titlesec">SIMULACIONES</span>
</div> --> 
    


<div class="tp">
<div class="subpanel">
<!--<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>
--></div>
  <div class="cf"></div>
</div>



<form method="post" action="panel/a_suc.php?id=<?php echo $id;?>&vi=<?php echo $vi;?>" name="frmRegistro">
<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
<input type="hidden" id="fecha_hoy" name="fecha_hoy" value="<?php echo date("Y/m/d");?>">





<div class="onecol" id="configuracion_simulacion" style="display:block;">





<span class="titlecol-ad">
    <?php //if($tipo == ''){echo 'Agregar';}else{echo 'Modificar';};?> 
    Configuracion de Simulacion 
</span>
  



  <div class="campitem-cliente">    
    <div class="campb"> 
      <div>Producto financiero</div>
      <select class="hospitalx" onchange="select_pf()" name="producto_financiero" id="producto_financiero">
          <option value="" selected>Seleccione Producto financiero</option>
<?php
  $sql2 = "SELECT * FROM producto_financiero  ";
  $result2 = mysql_query($sql2, $conn1);
  while($row2 = mysql_fetch_array($result2)){
?>
    <option value="<?= $row2["id"];?>" <?php if($row["producto_financiero"] == $row2["id"]){echo 'selected';};
    ?>><?= $row2["Alias"];?></option>
<?php };?>
      </select>
    </div>
    <div class="campb dospor2" id="capital_pf" style="display:none;">
      <div>Capital</div>
      <div class="con_pesos">
        <div class="elde_pesos">$</div>
        <input type="number" id="capitalpf" name="capitalpf" class="hospitalx2" onkeypress="capitalfun()" onkeyup="capitalfun()">
      </div>
    </div>
  </div>



  <div class="campitem-cliente2" id="formadpago0" style="display:none;">    
    <div class="campf"> 
      <div>Forma de Pago</div>
      <select class="hospitalx" onchange="formadepago()" name="forma_de_pago" id="forma_de_pago">
          <option value="" selected>Seleccione una forma de Pago</option>
          <option value="1" <?php if($row9h["pf_capital_vb"]=='1'){echo 'selected';};?>>Interes con Capital a vencimiento</option>
          <option value="2" <?php if($row9h["pf_capital_vb"]=='2'){echo 'selected';};?>>Amortizacion con periodos regulares</option>
          <option value="3" <?php if($row9h["pf_capital_vb"]=='3'){echo 'selected';};?>>Amortizacion con periodos Iregulares</option>
      </select>
    </div>
    <div class="campg dosporch" id="forma_de_pago1" style="display:none;">
      <div>Plazo del credito</div>      
      <div class="campd"><input type="number" name="nro_dias" id="nro_dias" onkeypress="nrodias()" onkeyup="nrodias()" placeholder="0" class="hospitalx" ></div>
      <div class="campd dosporch">
        <select name="dias_pf" id="dias_pf" class="hospitalx" onchange="nrodias()">
          <option value="Dias" selected>Dias</option>
          <option value="Meses">Mes</option>
        </select>
      </div>
      <div class="cf"></div>
      <div>El Credito finalizara el <div id="fecha_fin_cr"></div></div>
    </div>
    <div class="campg dosporch" id="forma_de_pago2" style="display:none;">      
      <div class="campd"><div>Nº de Pagos</div>
          <input type="number" name="nro_pagos" id="nro_pagos" class="hospitalx"onkeypress="nropagosfn()" onkeyup="nropagosfn()" >
      </div>
      <div class="campd dosporch">
        <div>Periodo de Pagos</div>
        <select name="periodo_de_pago" id="periodo_de_pago" class="hospitalx" onchange="periododepago()">
            <option value="diario" selected="selected">diario</option>
            <option value="semanal">semanal</option>
            <option value="mensual">mensual</option>
            <option value="mensual (Mismo día)">mensual (Mismo día)</option>
            <option value="quincenal">quincenal</option>
            <option value="catorcenal">catorcenal</option>
            <option value="bimensual">bimensual</option>
            <option value="trimestral">trimestral</option>
        </select>
    </div>
      <div class="campd dosporch" id="diasdecortefn" style="display:none">
        <div>Dias de Corte</div>
        <select name="dias_de_corte" id="dias_de_corte" class="hospitalx clase_bl" onclick="dias_de_corte_func()">
          <option value="0" selected disabled></option>
          <option value="1" <?php if($row["numero_dependientes"] == '1'){echo 'selected';};?>> 1 </option>
          <option value="2" <?php if($row["numero_dependientes"] == '2'){echo 'selected';};?>> 2 </option>
          <option value="3" <?php if($row["numero_dependientes"] == '3'){echo 'selected';};?>> 3 </option>
          <option value="4" <?php if($row["numero_dependientes"] == '4'){echo 'selected';};?>> 4 </option>
          <option value="5" <?php if($row["numero_dependientes"] == '5'){echo 'selected';};?>> 5 </option>
          <option value="6" <?php if($row["numero_dependientes"] == '6'){echo 'selected';};?>> 6 </option>
          <option value="7" <?php if($row["numero_dependientes"] == '7'){echo 'selected';};?>> 7 </option>
          <option value="8" <?php if($row["numero_dependientes"] == '8'){echo 'selected';};?>> 8 </option>
          <option value="9" <?php if($row["numero_dependientes"] == '9'){echo 'selected';};?>> 9 </option>
          <option value="10" <?php if($row["numero_dependientes"] == '10'){echo 'selected';};?>> 10 </option>
          <option value="11" <?php if($row["numero_dependientes"] == '11'){echo 'selected';};?>> 11 </option>
          <option value="12" <?php if($row["numero_dependientes"] == '12'){echo 'selected';};?>> 12 </option>
      </select>
    </div>
      <div class="campd dosporch" id="diasdesemanafn" style="display:none">
        <div>Dia de la semana</div>
        <select name="dias_de_semana" id="dias_de_semana" class="hospitalx" >
          <option value="0" selected disabled></option>
          <option value="1" <?php if($row["dias_de_semana"] == '1'){echo 'selected';};?>> Lunes </option>
          <option value="2" <?php if($row["dias_de_semana"] == '2'){echo 'selected';};?>> Martes </option>
          <option value="3" <?php if($row["dias_de_semana"] == '3'){echo 'selected';};?>> Miercoles </option>
          <option value="4" <?php if($row["dias_de_semana"] == '4'){echo 'selected';};?>> Jueves </option>
          <option value="5" <?php if($row["dias_de_semana"] == '5'){echo 'selected';};?>> Viernes </option>
          <option value="6" <?php if($row["dias_de_semana"] == '6'){echo 'selected';};?>> Sabado </option>
          <option value="7" <?php if($row["dias_de_semana"] == '7'){echo 'selected';};?>> Domingo </option>
      </select>
    </div>
      
    </div>
  </div>

<div id="formaspagextras" style="display:block;"><!----------------------- FORMAS DE PAGOS EXTRAS -->




  <div class="campitem-cliente separacion-rallada2" id="forma_de_pago3" style="display:none;">
    <div class="pf_tit">Pagos con periodos irregulares</div>  


    
    <input type="hidden" id="cantidad_fech" name="cantidad_fech" value="1">


    
    <div class="nro_fechapago" id="nro_fechapago1">1</div>
    <div class="campf"> 
      <div>Fecha de pago</div>     
      <div class="campd">
          <select name="fechadepago_dias1" id="" class="hospitalx" >
          <option value="0" disabled="disabled" selected="">Dia</option>
          <option value="01"> 1 </option>
          <option value="02"> 2 </option>
          <option value="03"> 3 </option>
          <option value="04"> 4 </option>
          <option value="05"> 5 </option>
          <option value="06"> 6 </option>
          <option value="07"> 7 </option>
          <option value="08"> 8 </option>
          <option value="09"> 9 </option>
          <option value="10"> 10 </option>
          <option value="11"> 11 </option>
          <option value="12" selected=""> 12 </option>
          <option value="13"> 13 </option>
          <option value="14"> 14 </option>
          <option value="15"> 15 </option>
          <option value="16"> 16 </option>
          <option value="17"> 17 </option>
          <option value="18"> 18 </option>
          <option value="19"> 19 </option>
          <option value="20"> 20 </option>
          <option value="21"> 21 </option>
          <option value="22"> 22 </option>
          <option value="23"> 23 </option>
          <option value="24"> 24 </option>
          <option value="25"> 25 </option>
          <option value="26"> 26 </option>
          <option value="27"> 27 </option>
          <option value="28"> 28 </option>
          <option value="29"> 29 </option>
          <option value="30"> 30 </option>
          <option value="31"> 31 </option>
      </select>
      </div>
      <div class="campd dosporch">
        <select name="fechadepago_mes1" id="fechadepago_mes1" class="hospitalx">
          <option value="0" disabled="disabled" selected="">Mes</option>
          <option value="01"> Enero </option>
          <option value="02"> Febrero </option>
          <option value="03" selected=""> Marzo </option>
          <option value="04"> Abril </option>
          <option value="05"> Mayo </option>
          <option value="06"> Junio </option>
          <option value="07"> Julio </option>
          <option value="08"> Agosto </option>
          <option value="09"> Septiembre </option>
          <option value="10"> Octubre </option>
          <option value="11"> Noviembre </option>
          <option value="12"> Diciembre </option>
      </select>
    </div>
      <div class="campd dosporch" id="" style="display: block;">
        <select name="fechadepago_year1" id="fechadepago_year1" class="hospitalx   ">
          <option value="0" disabled="disabled" selected="">Año</option>
          <?php for ($i=1945; $i < 2099 + 30; $i++) { ?>
                  <option value="<?= $i;?>" <?php if(date("Y") == $i){echo 'selected';};?>> <?= $i;?> </option>
          <?php  };   ?>
          
      </select>
    </div>
      
    </div>
    
    <div class="campd dospor" id="capital_pf" style="display: block;">
      <div>Abono Capital</div>
      <div class="con_pesos">
        <div class="elde_pesos">$</div>
        <input type="number" id="abono_capital_irr1" name="abono_capital_irr1" class="hospitalx2" onkeypress="abonocapital_irr('1')" onkeyup="abonocapital_irr('1')">
      </div>
    </div>
    

    <div id="masfechasdepago"></div>

    <div class="cf"></div>
    <div class="clasaddfechasp" onclick="clonofecha_irr()">+</div>
    <div class="claselifechasp" onclick="elifecha_irr()" id="elifechirr" style="display:none;">-</div>
    <div class="cf"></div>


    <div class="campf"> 
      <div>Fecha de vencimiento</div>     
      <div class="campd">
          <select name="fecha_nacimiento_d" id="" class="hospitalx" >
          <option value="0" disabled="disabled" selected="">Dia</option>
          <option value="01"> 1 </option>
          <option value="02"> 2 </option>
          <option value="03"> 3 </option>
          <option value="04"> 4 </option>
          <option value="05"> 5 </option>
          <option value="06"> 6 </option>
          <option value="07"> 7 </option>
          <option value="08"> 8 </option>
          <option value="09"> 9 </option>
          <option value="10"> 10 </option>
          <option value="11"> 11 </option>
          <option value="12" selected=""> 12 </option>
          <option value="13"> 13 </option>
          <option value="14"> 14 </option>
          <option value="15"> 15 </option>
          <option value="16"> 16 </option>
          <option value="17"> 17 </option>
          <option value="18"> 18 </option>
          <option value="19"> 19 </option>
          <option value="20"> 20 </option>
          <option value="21"> 21 </option>
          <option value="22"> 22 </option>
          <option value="23"> 23 </option>
          <option value="24"> 24 </option>
          <option value="25"> 25 </option>
          <option value="26"> 26 </option>
          <option value="27"> 27 </option>
          <option value="28"> 28 </option>
          <option value="29"> 29 </option>
          <option value="30"> 30 </option>
          <option value="31"> 31 </option>
      </select>
      </div>
      <div class="campd dosporch">
        <select name="" id="" class="hospitalx">
          <option value="0" disabled="disabled" selected="">Mes</option>
          <option value="01"> Enero </option>
          <option value="02"> Febrero </option>
          <option value="03" selected=""> Marzo </option>
          <option value="04"> Abril </option>
          <option value="05"> Mayo </option>
          <option value="06"> Junio </option>
          <option value="07"> Julio </option>
          <option value="08"> Agosto </option>
          <option value="09"> Septiembre </option>
          <option value="10"> Octubre </option>
          <option value="11"> Noviembre </option>
          <option value="12"> Diciembre </option>
      </select>
    </div>
      <div class="campd dosporch" id="" style="display: block;">
        <select name="dias_de_corte" id="" class="hospitalx   ">
          <option value="0" disabled="disabled" selected="">Año</option>
          <?php for ($i=1945; $i < 2099 + 30; $i++) { ?>
                  <option value="<?= $i;?>" <?php if(date("Y") == $i){echo 'selected';};?>> <?= $i;?> </option>
          <?php  };   ?>
          
      </select>
    </div>
      
    </div>
  </div>
  





<div class="campitem-cliente2 separacion-rallada2" id="forma_de_pago5" style="display:none;">






<div class="campitem-cliente2" id="forma_de_pago1b" style="display:block;">
  <!--<div class="campitem-cliente borde_de_abajo2">-->
    <div class="pf_tit margen_abajo">
          Comicion
          <!--<input name="com_x_apertura" type="checkbox" value="s" id="com_x_apertura" >
          <label for="com_x_apertura"><span><span></span></span>Comicion por Apertura</label>-->
    </div>
    <div class="cf"></div>
    <div class="" id="comapertura">
      
      <div class="campd margen_abajo ">
        <div>Comision por apertura %</div>
        <div class=" con_pesos">
            <div class="elde_centaje">%</div>
            <input type="number" name="interes_ord_an1" class="hospitalx3">
            <div class="elde_pesos_iva">
                <input name="interes_ord_aniva1" type="checkbox" value="s" id="interes_ord_aniva">
                <label for="interes_ord_aniva"><span><span></span></span>IVA</label>
            </div>
        </div>
      </div>      
      <div class="campd margen_abajo dosporch">
        <div>Comision por apertura $</div>
        <div class=" con_pesos">
            <div class="elde_pesos">$</div>
            <input type="number" name="interes_ord_an1" class="hospitalx3">
            <div class="elde_pesos_iva">
                <input name="interes_ord_aniva1" type="checkbox" value="s" id="interes_ord_aniva">
                <label for="interes_ord_aniva"><span><span></span></span>IVA</label>
            </div>
        </div>
      </div>      
      
      <div class="cf"></div>
      
      <div class="campd">
        <div>Interes Ordinario</div>
        <div class=" con_pesos">
            <div class="elde_centaje">%</div>
            <input type="number" name="interes_ord_an1" class="hospitalx3">
            <div class="elde_pesos_iva">
                <input name="interes_ord_aniva1" type="checkbox" value="s" id="interes_ord_aniva">
                <label for="interes_ord_aniva"><span><span></span></span>IVA</label>
            </div>
        </div>
      </div>
      
      <div class="campd dosporch">
      <div>Interes Moratorio</div>
          <div class=" con_pesos">
            <div class="elde_centaje">%</div>
            <input type="number" name="interes_ord_an1" class="hospitalx3">
            <div class="elde_pesos_iva">
                <input name="interes_ord_aniva1" type="checkbox" value="s" id="interes_ord_aniva">
                <label for="interes_ord_aniva"><span><span></span></span>IVA</label>
            </div>
        </div>
      </div>      

    </div>
</div>

    <div class="campf"> 
      <div class="pf_tit">Fecha primer pago</div>     
      <div class="campd">
          <select name="fecha_nacimiento_d" id="" class="hospitalx">
          <option value="0" disabled="disabled" selected="">Dia</option>
          <option value="01"> 1 </option>
          <option value="02"> 2 </option>
          <option value="03"> 3 </option>
          <option value="04"> 4 </option>
          <option value="05"> 5 </option>
          <option value="06"> 6 </option>
          <option value="07"> 7 </option>
          <option value="08"> 8 </option>
          <option value="09"> 9 </option>
          <option value="10"> 10 </option>
          <option value="11"> 11 </option>
          <option value="12" selected=""> 12 </option>
          <option value="13"> 13 </option>
          <option value="14"> 14 </option>
          <option value="15"> 15 </option>
          <option value="16"> 16 </option>
          <option value="17"> 17 </option>
          <option value="18"> 18 </option>
          <option value="19"> 19 </option>
          <option value="20"> 20 </option>
          <option value="21"> 21 </option>
          <option value="22"> 22 </option>
          <option value="23"> 23 </option>
          <option value="24"> 24 </option>
          <option value="25"> 25 </option>
          <option value="26"> 26 </option>
          <option value="27"> 27 </option>
          <option value="28"> 28 </option>
          <option value="29"> 29 </option>
          <option value="30"> 30 </option>
          <option value="31"> 31 </option>
      </select>
      </div>
      <div class="campd dosporch">
        <select name="" id="" class="hospitalx">
          <option value="0" disabled="disabled" selected="">Mes</option>
          <option value="01"> Enero </option>
          <option value="02"> Febrero </option>
          <option value="03" selected=""> Marzo </option>
          <option value="04"> Abril </option>
          <option value="05"> Mayo </option>
          <option value="06"> Junio </option>
          <option value="07"> Julio </option>
          <option value="08"> Agosto </option>
          <option value="09"> Septiembre </option>
          <option value="10"> Octubre </option>
          <option value="11"> Noviembre </option>
          <option value="12"> Diciembre </option>
      </select>
    </div>
      <div class="campd dosporch" id="" style="display: block;">
        <select name="dias_de_corte" id="" class="hospitalx   ">
          <option value="0" disabled="disabled" selected="">Año</option>
        <?php for ($i=1945; $i < 2099 + 30; $i++) { ?>
          <option value="<?= $i;?>" <?php if(date("Y") == $i){echo 'selected';};?>> <?= $i;?> </option>
        <?php  };   ?>                    
        </select>
    </div>
      
    </div>
</div>



  
</div><!----------------------- FIN DE FORMAS DE PAGOS EXTRAS -->
  
  


  <div class="cf"></div>
  
  <div class="save-btns">
      <input type="button" name="add"  value="Simular" class="rax"/> </div>
  </div>









  
  <div class="cf"></div>

</form>
<?php //*?/?>



<div class="onecol" id="simular" style="display:none;">
    <div class="simular_header"></div>
    <div class="simular_calculos"></div>
</div>
  
  
  
  <div id="clonofecha0" style="display:none;">
      <div class="cf"></div>
    <div class="nro_fechapago" id="nro_fechapago1">1</div>
    <div class="campf"> 
      <div>Fecha de pago</div>     
      <div class="campd">
          <select name="fechadepago_dias1" id="" class="hospitalx" >
          <option value="0" disabled="disabled" selected="">Dia</option>
          <option value="01"> 1 </option>
          <option value="02"> 2 </option>
          <option value="03"> 3 </option>
          <option value="04"> 4 </option>
          <option value="05"> 5 </option>
          <option value="06"> 6 </option>
          <option value="07"> 7 </option>
          <option value="08"> 8 </option>
          <option value="09"> 9 </option>
          <option value="10"> 10 </option>
          <option value="11"> 11 </option>
          <option value="12" selected=""> 12 </option>
          <option value="13"> 13 </option>
          <option value="14"> 14 </option>
          <option value="15"> 15 </option>
          <option value="16"> 16 </option>
          <option value="17"> 17 </option>
          <option value="18"> 18 </option>
          <option value="19"> 19 </option>
          <option value="20"> 20 </option>
          <option value="21"> 21 </option>
          <option value="22"> 22 </option>
          <option value="23"> 23 </option>
          <option value="24"> 24 </option>
          <option value="25"> 25 </option>
          <option value="26"> 26 </option>
          <option value="27"> 27 </option>
          <option value="28"> 28 </option>
          <option value="29"> 29 </option>
          <option value="30"> 30 </option>
          <option value="31"> 31 </option>
      </select>
      </div>
      <div class="campd dosporch">
        <select name="fechadepago_mes1" id="fechadepago_mes1" class="hospitalx">
          <option value="0" disabled="disabled" selected="">Mes</option>
          <option value="01"> Enero </option>
          <option value="02"> Febrero </option>
          <option value="03" selected=""> Marzo </option>
          <option value="04"> Abril </option>
          <option value="05"> Mayo </option>
          <option value="06"> Junio </option>
          <option value="07"> Julio </option>
          <option value="08"> Agosto </option>
          <option value="09"> Septiembre </option>
          <option value="10"> Octubre </option>
          <option value="11"> Noviembre </option>
          <option value="12"> Diciembre </option>
      </select>
    </div>
      <div class="campd dosporch" id="" style="display: block;">
        <select name="fechadepago_year1" id="fechadepago_year1" class="hospitalx   ">
          <option value="0" disabled="disabled" selected="">Año</option>
          <?php for ($i=1945; $i < 2099 + 30; $i++) { ?>
                  <option value="<?= $i;?>" <?php if(date("Y") == $i){echo 'selected';};?>> <?= $i;?> </option>
          <?php  };   ?>
          
      </select>
    </div>
      
    </div>
    
    <div class="campd dospor" id="capital_pf" style="display: block;">
      <div>Abono Capital</div>
      <div class="con_pesos">
        <div class="elde_pesos">$</div>
        <input type="number" id="abono_capital_irr1" name="abono_capital_irr1" class="hospitalx2" >
      </div>
    </div>
    

  </div>
  


<script>
  function dias_de_corte_func(){
    var DiaCort = document.getElementById("dias_de_corte").value;

  }
  function elifecha_irr(){
        var CantDom=document.getElementById('cantidad_fech').value;//cuenta cant fechas irregulares
        CantDom2 = parseInt(CantDom);
        var nuevovalor = CantDom2 - 1;
        var nuevaid = "clonofecha" + CantDom2;

        $("#" + nuevaid).remove();

        if (nuevovalor == '1') {
            document.getElementById("elifechirr").style.display = "none";
        };

        document.getElementById('cantidad_fech').value = nuevovalor;
  }
  function clonofecha_irr(){
        var CantDom=document.getElementById('cantidad_fech').value;//cuenta cant fechas irregulares
        CantDom2 = parseInt(CantDom);
        var nuevovalor = CantDom2 + 1;
        var nuevaid = "clonofecha" + nuevovalor;

        var clonedDiv = $('#clonofecha0').clone(); // Clono
        clonedDiv.attr("id", nuevaid); // Cambio ID
        var segundo_p2 = document.getElementById('masfechasdepago');// Despues de quien lo quiero meter
        $('#masfechasdepago').append(clonedDiv);

        var padre = document.getElementById(nuevaid).getElementsByTagName("div");
        padre[1].innerHTML = nuevovalor;

        var padre_inpt = document.getElementById(nuevaid).getElementsByTagName("input");
        padre_inpt[0].name = "abono_capital_irr" + nuevovalor;
        padre_inpt[0].id = "abono_capital_irr" + nuevovalor;

        var padre_select = document.getElementById(nuevaid).getElementsByTagName("select");
        padre_select[0].name = "fechadepago_dias" + nuevovalor;
        padre_select[1].name = "fechadepago_mes" + nuevovalor;
        padre_select[2].name = "fechadepago_year" + nuevovalor;
        padre_select[0].id = "fechadepago_dias" + nuevovalor;
        padre_select[1].id = "fechadepago_mes" + nuevovalor;
        padre_select[2].id = "fechadepago_year" + nuevovalor;


        document.getElementById(nuevaid).style.display = "block";
        document.getElementById("elifechirr").style.display = "block";

        document.getElementById('cantidad_fech').value = nuevovalor;
  }

  function ComicionPorApertura(){
        var CantDom= document.getElementById("com_x_apertura").checked;
        if (CantDom == true){
          document.getElementById("comapertura").style.display = "block";
        }else{
          document.getElementById("comapertura").style.display = "none";      
        };
  }

  function nrodias(){
    var inptcapital = document.getElementById("nro_dias").value;
    if(inptcapital != '' && inptcapital != '0'){document.getElementById("forma_de_pago1b").style.display = "block";}
    else{document.getElementById("forma_de_pago1b").style.display = "none";};

    if(inptcapital != '' && inptcapital != '0'){
      var fechahoy = document.getElementById("fecha_hoy").value;
      var fechatipo = document.getElementById("dias_pf").value;
      var d = new Date(fechahoy);
      Cantasumar = parseInt(inptcapital);
      if(fechatipo == 'Dias'){
        d.setDate(d.getDate()+Cantasumar);/*sumo los dias correspondientes a la fecha*/
      };
      if(fechatipo == 'Meses'){
        d.setMonth(d.getMonth()+Cantasumar);/*sumo los dias correspondientes a la fecha*/
      };
      var fch = d.toLocaleString();/*transformo la fecha en formato fecha aceptable*/
      var fchcad = fch.split("/");//fotmato fecha de php
      var fchcad2 = fchcad[2].split(" ");
      var estaes = fchcad[0] + "/" + fchcad[1] + "/"  + fchcad2[0] ;
      document.getElementById("fecha_fin_cr").innerHTML = estaes;
    }
    else if(inptcapital == '0'){
      var fechahoy = document.getElementById("fecha_hoy").value;     
      var fchcad = fechahoy.split("/");
      document.getElementById("fecha_fin_cr").innerHTML = fchcad[2] + "/"  + fchcad[1] + "/"  + fchcad[0] ;
    }
  }
  function abonocapital_irr(id){
    var idavono = "abono_capital_irr" + id;
    var inptcapital = document.getElementById(idavono).value;
    if(inptcapital != '' && inptcapital != '0'){document.getElementById("forma_de_pago1b").style.display = "block";}
    else{document.getElementById("forma_de_pago1b").style.display = "none";};
  }
  function nropagosfn(){
    var inptcapital = document.getElementById("nro_pagos").value;
    //if(inptcapital != '' && inptcapital != '0'){document.getElementById("forma_de_pago1b").style.display = "block";}
    //else{document.getElementById("forma_de_pago1b").style.display = "none";};
  }

  function periododepago(){
        var CantDom= document.getElementById("periodo_de_pago").value;
        if (CantDom == 'quincenal') {
              document.getElementById("diasdecortefn").style.display = "block";
              document.getElementById("diasdesemanafn").style.display = "none";
        }
        else if (CantDom == 'catorcenal') {
              document.getElementById("diasdecortefn").style.display = "block";
              document.getElementById("diasdesemanafn").style.display = "none";
        }
        else if (CantDom == 'bimensual') {
              document.getElementById("diasdecortefn").style.display = "block";
              document.getElementById("diasdesemanafn").style.display = "none";
        }
        else if (CantDom == 'mensual') {
              document.getElementById("diasdecortefn").style.display = "block";
              document.getElementById("diasdesemanafn").style.display = "none";
        }
        else if (CantDom == 'semanal') {
              document.getElementById("diasdesemanafn").style.display = "block";
              document.getElementById("diasdecortefn").style.display = "none";
        }
        else{
              document.getElementById("diasdesemanafn").style.display = "none";
              document.getElementById("diasdecortefn").style.display = "none";
        };
  }

  function capitalfun(){
    var inptcapital = document.getElementById("capitalpf").value;
    if(inptcapital != ''){document.getElementById("formadpago0").style.display = "block";}
    else{document.getElementById("formadpago0").style.display = "none";};
  }

  function fecha_fin_cr(){
    document.getElementById("fecha_fin_cr").style.display = "block";
  }

  function select_pf(){
    var CantDom= document.getElementById("producto_financiero").value;
    if (CantDom != '') {
      document.getElementById("capital_pf").style.display = "block";   
      var inptcapital = document.getElementById("capitalpf").value;
      if(inptcapital != ''){
        document.getElementById("formaspagextras").style.display = "block";
      };
      capitalfun();
    }else{
      document.getElementById("capital_pf").style.display = "none";
      document.getElementById("formadpago0").style.display = "none";
      document.getElementById("formaspagextras").style.display = "none";
    };
  }

  function formadepago(){
        var CantDom= document.getElementById("forma_de_pago").value;
        if (CantDom == '1') {
          document.getElementById("forma_de_pago1").style.display = "block";
          document.getElementById("forma_de_pago2").style.display = "none";
          document.getElementById("forma_de_pago3").style.display = "none";
          document.getElementById("forma_de_pago5").style.display = "block";
        }else if (CantDom == '2') {
          document.getElementById("forma_de_pago2").style.display = "block";
          document.getElementById("forma_de_pago1").style.display = "none";
          document.getElementById("forma_de_pago3").style.display = "none";
          document.getElementById("forma_de_pago5").style.display = "block";
        }else if (CantDom == '3') {
          document.getElementById("forma_de_pago3").style.display = "block";
          document.getElementById("forma_de_pago1").style.display = "none";
          document.getElementById("forma_de_pago2").style.display = "none";
          document.getElementById("forma_de_pago5").style.display = "block";
        }else{
          document.getElementById("forma_de_pago1").style.display = "none";
          document.getElementById("forma_de_pago2").style.display = "none";
          document.getElementById("forma_de_pago3").style.display = "none";
          document.getElementById("forma_de_pago5").style.display = "none";
        }
  }
</script>

</body>
</html>

<?php

		mysql_close($conn1);
	}
else{
	header("location: login.php");
	};
	?>