<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};

if ($id != ''){
	$sql1 = "SELECT * FROM producto_financiero WHERE id='".$id."' ";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
};


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link href="styles.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
</head>

<body  onload="aliniciar()">
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
<span class="titlesec">SUCURSALES</span>
</div>  
    -->


<div class="tp">
<div class="subpanel">
<!--<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>
--></div>
  <div class="cf"></div>
</div>



<form method="post" action="panel/a_prod_fin.php?id=<?php echo $id;?>&vi=<?php echo $vi;?>" 
class="frmRegistro_relative" name="frmRegistro">
<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
<div class="onecol">
    <span class="titlecol-ad">
        <?php if($id == ''){echo 'Agregar';}else{echo 'Modificar';};?> Producto Financiero 
    </span>
  





  <div class="campitem-cliente">
    <div class="campc">
      <div class="pf_tit">Alias*</div>
      <input type="text" name="Alias" class="hospitalx" value="<?php echo $row["Alias"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <!--<input type="text" name="direccion" id="textfield" placeholder="Direccion" value="<?php echo $row["direccion"];?>"/>-->
    </div>
  </div>




<div class="campitem-cliente borde_de_abajo2">
    <div class="pf_tit">Tipo</div>
    <div class="campb">      
      <div class="pf_check example"> 
          <input name="tipo" type="radio" value="finan" id="Tipo1" onclick="checkfinanciera()" 
          <?php if($row["tipo"] == 'finan'){echo ' checked';};?>/>
          <!--<input id="checkbox1" type="checkbox" name="checkbox" value="1" checked="checked">-->
          <label for="Tipo1"><span><span></span></span>Financiera</label>
      </div>     
      <div class="pf_check"> 
          <input name="tipo" type="radio" value="empe" id="Tipo2" onclick="checkfinanciera()" 
          <?php if($row["tipo"] == 'empe'){echo ' checked';};?>/>
          <label for="Tipo1"><span><span></span></span>Empeño</label>
      </div>          
    </div>
</div> 




<div class="campitem-cliente borde_de_abajo2">
    <div class="pf_tit">Base de calculo para intereses</div>
    <div class="campb">      
      <div class="pf_check example"> 
          <input name="base_calculo_pi" type="radio" value="360" id="base_calculo_pi_1" 
          <?php if($row["base_calculo_pi"] == '360'){echo ' checked';};?>/>
          <label for="base_calculo_pi_1"><span><span></span></span>360 Dias</label>
      </div>     
      <div class="pf_check"> 
          <input name="base_calculo_pi" type="radio" value="365" id="base_calculo_pi_2" 
          <?php if($row["base_calculo_pi"] == '365'){echo ' checked';};?>/>
          <label for="base_calculo_pi_2"><span><span></span></span>365 Dias</label>
      </div>          
    </div>
</div> 




<div class="campitem-cliente borde_de_abajo2">
    <div class="pf_tit">
          <input name="interes_ord" type="checkbox" value="s" id="interes_ord" onclick="checkinteres_ord()" 
          <?php if($row["interes_ord"] == 's'){echo ' checked';};?>/>
          <label for="interes_ord"><span><span></span></span>Interés Ordinario</label>
    </div>
    <div class="campb" id="calculo_ordinario" style="display:<?php 
    if ($row["interes_ord"] == 's') {echo 'block';}else{echo 'none';}; ?>">  
      <div class="pf_titulito">Calculos sobre saldos ordinarios</div>
      <div class="pf_check example"> 
          <input name="calculo_so" type="radio" value="glo" class="inputradiador" id="calculo_so1" 
          <?php if($row["calculo_so"] == 'glo'){echo ' checked';};?>/>
          <label for="calculo_so1"><span><span></span></span>Globales</label>
      </div>     
      <div class="pf_check"> 
          <input name="calculo_so" type="radio" value="Ins" class="inputradiador" id="calculo_so2" 
          <?php if($row["calculo_so"] == 'Ins'){echo ' checked';};?>/>
          <label for="calculo_so2"><span><span></span></span>Insolutos</label>
      </div>          
    </div>
</div> 



<div class="campitem-cliente borde_de_abajo2">
    <div class="pf_tit">
          <input name="interes_mor" type="checkbox" value="s" id="interes_mor" onclick="checkinteres_mora()" 
          <?php if($row["interes_mor"] == 's'){echo ' checked';};?>/>
          <label for="interes_mor"><span><span></span></span>Interés Moratorio</label>
    </div>
    <div class="campb" id="interes_morat" style="display:<?php 
    if ($row["interes_mor"] == '') {echo 'none';}else{echo 'block';}; ?>">  
      <div class="pf_titulito">Calculos sobre</div>
      <div class="pf_check example"> 
          <input name="calculo_so_m" type="radio" value="P_vensi" class="inputradiador" id="calculo_so_m1" 
          <?php if($row["calculo_so_m"] == 'P_vensi'){echo ' checked';};?>/>
          <label for="calculo_so_m1"><span><span></span></span>Pago Vencido</label>
      </div>     
      <div class="pf_check"> 
          <input name="calculo_so_m" type="radio" value="C_vensi" class="inputradiador" id="calculo_so_m2" 
          <?php if($row["calculo_so_m"] == 'C_vensi'){echo ' checked';};?>/>
          <label for="calculo_so_m2"><span><span></span></span>Capital Vencido</label>
      </div>          
    </div>
</div> 


  <div class="campitem-cliente2 borde_de_abajo2" id="maximodias">
    <div class="pf_tit">Maximos dias a cobrar en moratorio por cada pagare vencido 
    <input id="max_dias" name="max_dias" type="number" value="<?= $row["max_dias"]?>" class="inputchico" />
    </div>
  </div>


  <div class="campitem-cliente2 ">
    <div class="pf_tit">Condiciones</div>
    <div class="cf"></div>
  </div>







    
<?php
    $sql9h= "SELECT * FROM condiciones WHERE producto_financiero='".$id."' ORDER BY id ASC";
    $result9h = mysql_query($sql9h, $conn1);
    if($id != ''){
            $total_registros9h = mysql_num_rows($result9h);
    };
    if ($total_registros9h == '') {  $total_registros9h = 0;  };
    $nro_cond = 0;
?>

    <input type="hidden" name="nro_cond_t" id="nro_cond_t" value="<?= $total_registros9h?>"/>

<div class="campitem-cliente2 " id="agregar_mas_c0">
<?php while($row9h = mysql_fetch_array($result9h)){   
      if($id != ''){
      $nro_cond = $nro_cond + 1; 

      ?>
<input type="hidden" name="id_cond<?= $nro_cond?>" id="id_cond<?= $nro_cond?>" value="<?= $row9h["id"]?>"/>

<div class="campitem-cliente2 " id="agregar_mas_c<?= $nro_cond?>" style="display:block;">
  
    <div class="pf_cond"><?= $nro_cond?></div>
    <div class="pf_eli" id="pf_eli" onclick="eliminar_cond('<?= $nro_cond?>');">X</div>
    <input type="hidden" name="id_cond"/>
    <input type="hidden" name="nro_cond" id="nro_cond"/>
    <div class="pf_condiciones_in">
    <div class="pf_titulito2 pf_rallaarriba">Capital</div>
    
    <div class="campd dospor">
    <div>Desde</div>
        <div class="con_pesos">
          <div class="elde_pesos">$</div>
          <input type="number" name="pf_capital_va<?= $nro_cond?>" value="<?= $row9h["pf_capital_va"]?>" class="hospitalx2" placeholder="Valor A" />
        </div>
    </div>

    <div class="campd dospor">
        <div>Hasta</div>
        <div class="con_pesos" id="pf_capital_vb_d">
          <label for="textfield"></label>
          <div class="elde_pesos">$</div>
          <input type="number" name="pf_capital_vb<?= $nro_cond?>" value="<?= $row9h["pf_capital_vb"]?>" class="hospitalx2" placeholder="Valor B" />
        </div>
    </div>


    <div class="pf_titulito2">Dias</div>
    <div class="campd dospor ">
      <div>Desde</div>
      <input type="number" name="pf_dias_va<?= $nro_cond?>" value="<?= $row9h["pf_dias_va"]?>" class="hospitalx" placeholder="Valor A"/>
    </div>
    
    <div class="campd dospor "  name="pf_dias_vb_d" >
      <div>Hasta</div>
      <input type="number" name="pf_dias_vb<?= $nro_cond?>" value="<?= $row9h["pf_dias_vb"]?>" class="hospitalx" placeholder="Valor B"/>
    </div>
    

    <div class="pf_titulito2">Comisión por apertura</div>
    
    <div class="pf_comap_radio">
            <input name="comicion_ap<?= $nro_cond?>" type="radio" value="porcent" id="comicion_ap<?= $nro_cond?>" 
            onclick="comicion_apfn('<?= $nro_cond?>')" <?php if($row9h["comicion_ap"] == 'porcent'){echo 'checked';}; ?>  />
            <label for="comicion_ap<?= $nro_cond?>"><span><span></span></span></label>
    </div>
    <div class="campd con_pesos_radio">
      <div class="elde_pesos">%</div>
      <input type="number" name="comicion_ap_cant<?= $nro_cond?>" value="<?= $row9h["comicion_ap_cant"]?>" class="hospitalx3"/>
      <div class="elde_pesos_iva_radio">
          <input name="comicion_ap_iva<?= $nro_cond?>" type="checkbox" value="s" id="comicion_ap_iva<?= $nro_cond?>"
          <?php if($row9h["comicion_ap_iva"] == 's'){echo 'checked';}; ?>  />
          <label for="comicion_ap_iva<?= $nro_cond?>"><span><span></span></span>IVA</label>
      </div>
    </div>    

    <div class="pf_comap_radio dospor">
            <input name="comicion_ap<?= $nro_cond?>" onclick="comicion_apfnb('<?= $nro_cond?>')" id="comicion_ap_b<?= $nro_cond?>" 
            <?php if($row9h["comicion_ap"] == 'pesos'){echo 'checked';}; ?>   type="radio" value="pesos"  />
            <label for="comicion_ap_b<?= $nro_cond?>"><span><span></span></span></label>
    </div>
    <div class="campd con_pesos_radio">
      <div class="elde_pesos">$</div>
      <input type="number" name="comicion_ap_cant_b<?= $nro_cond?>" value="<?= $row9h["comicion_ap_cant_b"]?>"  
      id="comicion_ap_cant_b<?= $nro_cond?>" class="hospitalx3" value""/>
      <div class="elde_pesos_iva_radio">
          <input name="comicion_ap_iva_b<?= $nro_cond?>" type="checkbox" value="s" id="comicion_ap_iva_b<?= $nro_cond?>" 
          <?php if($row9h["comicion_ap_iva_b"] == 's'){echo 'checked';}; ?>  />
          <label for="comicion_ap_iva_b<?= $nro_cond?>"><span><span></span></span>IVA</label>
      </div>
    </div>
    <div class="cf"></div>
    
    <div class="campd">
        <div>Interes Ordinario Anual</div>
        <div class=" con_pesos">
            <div class="elde_pesos">$</div>
            <input type="number" name="interes_ord_an<?= $nro_cond?>" value="<?= $row9h["interes_ord_an"]?>" class="hospitalx3"/>
            <div class="elde_pesos_iva">
                <input name="interes_ord_aniva<?= $nro_cond?>" type="checkbox" value="s" id="interes_ord_aniva<?= $nro_cond?>"
                <?php if($row9h["interes_ord_aniva"] == 's'){echo 'checked';}; ?>  />
                <label for="interes_ord_aniva<?= $nro_cond?>"><span><span></span></span>IVA</label>
            </div>
        </div>
    </div>
    
    <div class="campd dospor">
          <div>Interes Moratorio Anual</div>
          <div class=" con_pesos">
              <div class="elde_pesos">$</div>
              <input type="number" name="interes_mor_an<?= $nro_cond?>" value="<?= $row9h["interes_mor_an"]?>" class="hospitalx3"/>
              <div class="elde_pesos_iva">
                  <input name="interes_mor_aniva<?= $nro_cond?>" type="checkbox" value="s" id="interes_mor_aniva<?= $nro_cond?>"
                  <?php if($row9h["interes_mor_aniva"] == 's'){echo 'checked';}; ?>  />
                  <label for="interes_mor_aniva<?= $nro_cond?>"><span><span></span></span>IVA</label>
              </div>
          </div>
    </div>

    <div  class="campd dospor costo_almacenaje" style="display:none;">
          <div>Costo de Almacenaje Mensual</div>
          <div class=" con_pesos">
              <div class="elde_pesos">$</div>
              <input type="number" name="costo_al_mes<?= $nro_cond?>"  value="<?= $row9h["costo_al_mes"]?>" class="hospitalx3"/>
              <div class="elde_pesos_iva">
                  <input name="costo_al_mesiva<?= $nro_cond?>" type="checkbox" value="s" id="costo_al_mesiva<?= $nro_cond?>" 
                  <?php if($row9h["costo_al_mesiva"] == 's'){echo 'checked';}; ?>  />
                  <label for="costo_al_mesiva<?= $nro_cond?>"><span><span></span></span>IVA</label>
              </div>
          </div>
    </div>

    <div class="cf"></div>
  </div>
  
  <div class="campitem-cliente2 textoempe" style="display:none">
    <strong>
      Periodo de gracia para interes moratorio 
      <input id="periodo_gracia<?= $nro_cond?>" name="periodo_gracia<?= $nro_cond?>"  
      value="<?= $row9h["periodo_gracia"]?>" type="number" class="inputchico" /><br><br>
      
      Comision por venta de prenda 
      <div class="inputcontinuo con_pesos_radio">
        <div class="elde_pesos">%</div>
        <input type="number" name="comicion_x_venta<?= $nro_cond?>"  value="<?= $row9h["comicion_x_venta"]?>" class="hospitalx4">
        <div class="elde_pesos_iva_radio">
            <input name="comicion_x_venta_iva<?= $nro_cond?>" type="checkbox" value="s" id="comicion_x_venta_iva<?= $nro_cond?>"
            <?php if($row9h["comicion_x_venta_iva"] == 's'){echo 'checked';}; ?>  >
            <label for="comicion_x_venta_iva<?= $nro_cond?>"><span><span></span></span>IVA</label>
        </div>
      </div>
      Dias de Gracia antes de venta de prenda 
      <input id="dia_gracia<?= $nro_cond?>" name="dia_gracia<?= $nro_cond?>" value="<?= $row9h["dia_gracia"]?>" 
      type="number" class="inputchico" /><br><br>

      Costo de reposicion de contraro 
      <div class="inputcontinuo  con_pesos">
              <div class="elde_pesos">$</div>
              <input type="number" name="costo_reposicion<?= $nro_cond?>" value="<?= $row9h["costo_reposicion"]?>" class="hospitalx4">
              <div class="elde_pesos_iva">
                  <input name="costo_reposicion_iva<?= $nro_cond?>" type="checkbox" value="s" id="costo_reposicion_iva<?= $nro_cond?>"
                  <?php if($row9h["costo_reposicion_iva"] == 's'){echo 'checked';}; ?>  >
                  <label for="costo_reposicion_iva<?= $nro_cond?>"><span><span></span></span>IVA</label>
              </div>
          </div>
    </strong>
  </div>

    <input type="hidden" name="eli_con" id="eli_con"/>

</div>
  <?php }; };?>
</div>


  <div class="campitem-cliente2 ">
    <div class="pf_tit2" onclick="agregar_mas_cfn()">(+) Agregar nueva condicion al producto financiero</div>
  </div>

  
  
  


  <div class="cf"></div>
  
  <div class="save-btns">
      <input type="submit" name="add"  value="Guardar" class="rax"/> </div>
  </div>




</div>


  
  
  
  
  
  
  
  
  <div class="cf"></div>
</div>
</form>
<?php //*?/?>

 
  
  <div class="campitem-cliente2 " id="agregar_mas_c" style="display:none;">
    <div class="pf_cond">1</div>
    <div class="pf_eli" id="pf_eli">X</div>
    <input type="hidden" name="id_cond"/>
    <input type="hidden" name="nro_cond" id="nro_cond"/>
    <div class="pf_condiciones_in">
    <div class="pf_titulito2 pf_rallaarriba">Capital</div>
    
    <div class="campd dospor">
    <div>Desde</div>
        <div class="con_pesos">
          <div class="elde_pesos">$</div>
          <input type="number" name="pf_capital_va" class="hospitalx2" placeholder="Valor A" />
        </div>
    </div>

    <div class="campd dospor">
        <div>Hasta</div>
        <div class="con_pesos" id="pf_capital_vb_d">
          <label for="textfield"></label>
          <div class="elde_pesos">$</div>
          <input type="number" name="pf_capital_vb" class="hospitalx2" placeholder="Valor B" />
        </div>
    </div>


    <div class="pf_titulito2">Dias</div>
    <div class="campd dospor ">
      <div>Desde</div>
      <input type="number" name="pf_dias_va" class="hospitalx" placeholder="Valor A"/>
    </div>
    
    <div class="campd dospor "  name="pf_dias_vb_d" >
      <div>Hasta</div>
      <input type="number" name="pf_dias_vb" class="hospitalx" placeholder="Valor B"/>
    </div>
    

    <div class="pf_titulito2">Comisión por apertura</div>
    
    <div class="pf_comap_radio">
            <input name="comicion_ap" type="radio" value="porcent" id="comicion_ap" onclick="comicion_apfn()" />
            <label for="comicion_ap"><span><span></span></span></label>
    </div>
    <div class="campd con_pesos_radio">
      <div class="elde_pesos">%</div>
      <input type="number" name="comicion_ap_cant<?= $nro_cond?>" class="hospitalx3" value""/>
      <div class="elde_pesos_iva_radio">
          <input name="comicion_ap_iva" type="checkbox" value="s" id="comicion_ap_iva"/>
          <label for="comicion_ap_iva"><span><span></span></span>IVA</label>
      </div>
    </div>    

    <div class="pf_comap_radio dospor">
            <input name="comicion_ap" type="radio" value="pesos" id="comicion_ap_b" onclick="comicion_apfnb()" />
            <label for="comicion_ap_b"><span><span></span></span></label>
    </div>
    <div class="campd con_pesos_radio">
      <div class="elde_pesos">$</div>
      <input type="number" name="comicion_ap_cant_b" id="comicion_ap_cant_b" class="hospitalx3" value""/>
      <div class="elde_pesos_iva_radio">
          <input name="comicion_ap_iva_b" type="checkbox" value="s" id="comicion_ap_iva_b" />
          <label for="comicion_ap_iva_b"><span><span></span></span>IVA</label>
      </div>
    </div>
    <div class="cf"></div>
    
    <div class="campd">
        <div>Interes Ordinario Anual</div>
        <div class=" con_pesos">
            <div class="elde_pesos">$</div>
            <input type="number" name="interes_ord_an" class="hospitalx3" placeholder=""/>
            <div class="elde_pesos_iva">
                <input name="interes_ord_aniva" type="checkbox" value="s" id="interes_ord_aniva"/>
                <label for="interes_ord_aniva"><span><span></span></span>IVA</label>
            </div>
        </div>
    </div>
    
    <div class="campd dospor">
          <div>Interes Moratorio Anual</div>
          <div class=" con_pesos">
              <div class="elde_pesos">$</div>
              <input type="number" name="interes_mor_an" class="hospitalx3" placeholder=""/>
              <div class="elde_pesos_iva">
                  <input name="interes_mor_aniva" type="checkbox" value="s" id="interes_mor_aniva"/>
                  <label for="interes_mor_aniva"><span><span></span></span>IVA</label>
              </div>
          </div>
    </div>

    <div  class="campd dospor costo_almacenaje" style="display:none;">
          <div>Costo de Almacenaje Mensual</div>
          <div class=" con_pesos">
              <div class="elde_pesos">$</div>
              <input type="number" name="costo_al_mes" class="hospitalx3" placeholder=""/>
              <div class="elde_pesos_iva">
                  <input name="costo_al_mesiva" type="checkbox" value="s" id="costo_al_mesiva" />
                  <label for="costo_al_mesiva"><span><span></span></span>IVA</label>
              </div>
          </div>
    </div>

    <div class="cf"></div>
  </div>
  
  <div class="campitem-cliente2 textoempe" style="display:none">
    <strong>
      Periodo de gracia para interes moratorio 
      <input id="periodo_gracia" name="periodo_gracia" type="number" class="inputchico" /><br><br>
      
      Comision por venta de prenda 
      <div class="inputcontinuo con_pesos_radio">
        <div class="elde_pesos">%</div>
        <input type="number" name="comicion_x_venta" class="hospitalx4">
        <div class="elde_pesos_iva_radio">
            <input name="comicion_x_venta_iva" type="checkbox" value="s" id="comicion_x_venta_iva">
            <label for="comicion_x_venta_iva"><span><span></span></span>IVA</label>
        </div>
      </div>
      Dias de Gracia antes de venta de prenda 
      <input id="dia_gracia" name="dia_gracia" type="number" class="inputchico" /><br><br>

      Costo de reposicion de contraro 
      <div class="inputcontinuo  con_pesos">
              <div class="elde_pesos">$</div>
              <input type="number" name="costo_reposicion" class="hospitalx4" placeholder="">
              <div class="elde_pesos_iva">
                  <input name="costo_reposicion_iva" type="checkbox" value="s" id="costo_reposicion_iva">
                  <label for="costo_reposicion_iva"><span><span></span></span>IVA</label>
              </div>
          </div>
    </strong>
  </div>

    <input type="hidden" name="eli_con" id="eli_con"/>
  </div>

<script>

function aliniciar(){
      <?php if($row["tipo"] == 'empe'){echo ' checkfinanciera();';};?>   
}
    function comicion_apfn(id){
            var id1 = "comicion_ap_cant_b" + id;
            var id2 = "comicion_ap_iva_b" + id;
            document.getElementById(id1).value = "";
            document.getElementById(id2).checked=0;
    }
    function comicion_apfnb(id){
          var id1 = "comicion_ap_cant" + id;
          var id2 = "comicion_ap_iva" + id;
          document.getElementById(id1).value = "";
          document.getElementById(id2).checked=0;
    }
    
function checkfinanciera(){
  var CantDom= document.getElementById("Tipo1").checked;
        if (CantDom == true){         
          //document.getElementById("costo_almacenaje").style.display = "none";
          var s = document.getElementsByClassName("costo_almacenaje");
          var e;
          for (e = 0; e < s.length; e++) {
              s[e].style.display = "none";
          }
          var x = document.getElementsByClassName("textoempe");
          var i;
          for (i = 0; i < x.length; i++) {
              x[i].style.display = "none";
          }
        }else{
          //document.getElementById("costo_almacenaje").style.display = "block"; 
          var s = document.getElementsByClassName("costo_almacenaje");
          var e;
          for (e = 0; e < s.length; e++) {
              s[e].style.display = "block";
          }
          var x = document.getElementsByClassName("textoempe");
          var i;
          for (i = 0; i < x.length; i++) {
              x[i].style.display = "block";
          }     
        };
}

function agregar_mas_cfn(){
    var CantDom=document.getElementById('nro_cond_t').value;//cuenta cant de domicilios hay
    CantDom2 = parseInt(CantDom);
    var nuevovalor = CantDom2 + 1;
    var nuevaid = "agregar_mas_c" + nuevovalor;

    var clonedDiv = $('#agregar_mas_c').clone(); // Clono
    clonedDiv.attr("id", nuevaid); // Cambio ID
    var segundo_p2 = document.getElementById('agregar_mas_c0');// Despues de quien lo quiero meter
    $('#agregar_mas_c0').append(clonedDiv);

    var padre = document.getElementById(nuevaid).getElementsByTagName("div");
    padre[0].innerHTML = nuevovalor;

    var padre_inpt = document.getElementById(nuevaid).getElementsByTagName("input");
    padre_inpt[1].name = "nro_cond" + nuevovalor;
    padre_inpt[1].id = "nro_cond" + nuevovalor;
    padre_inpt[2].name = "pf_capital_va" + nuevovalor;
    padre_inpt[3].name = "pf_capital_vb" + nuevovalor;
    padre_inpt[4].name = "pf_dias_va" + nuevovalor;
    padre_inpt[5].name = "pf_dias_vb" + nuevovalor;
    padre_inpt[6].name = "comicion_ap" + nuevovalor;
    padre_inpt[6].id = "comicion_ap" + nuevovalor;
    padre_inpt[7].id = "comicion_ap_cant" + nuevovalor;
    padre_inpt[7].name = "comicion_ap_cant" + nuevovalor;
    padre_inpt[8].name = "comicion_ap_iva" + nuevovalor;
    padre_inpt[8].id = "comicion_ap_iva" + nuevovalor;
    padre_inpt[9].name = "comicion_ap" + nuevovalor;
    padre_inpt[9].id = "comicion_ap_b" + nuevovalor;
    padre_inpt[10].id = "comicion_ap_cant_b" + nuevovalor;
    padre_inpt[10].name = "comicion_ap_cant_b" + nuevovalor;
    padre_inpt[11].name = "comicion_ap_iva_b" + nuevovalor;
    padre_inpt[11].id = "comicion_ap_iva_b" + nuevovalor;
    padre_inpt[12].name = "interes_ord_an" + nuevovalor;
    padre_inpt[13].name = "interes_ord_aniva" + nuevovalor;
    padre_inpt[14].name = "interes_mor_an" + nuevovalor;
    padre_inpt[15].name = "interes_mor_aniva" + nuevovalor;
    padre_inpt[16].name = "costo_al_mes" + nuevovalor;
    padre_inpt[17].name = "costo_al_mesiva" + nuevovalor;


    padre_inpt[18].id = "periodo_gracia" + nuevovalor;
    padre_inpt[18].name = "periodo_gracia" + nuevovalor;

    padre_inpt[19].id = "comicion_x_venta" + nuevovalor;
    padre_inpt[19].name = "comicion_x_venta" + nuevovalor;
    padre_inpt[20].id = "comicion_x_venta_iva" + nuevovalor;
    padre_inpt[20].name = "comicion_x_venta_iva" + nuevovalor;

    padre_inpt[21].id = "dia_gracia" + nuevovalor;
    padre_inpt[21].name = "dia_gracia" + nuevovalor;

    padre_inpt[22].id = "costo_reposicion" + nuevovalor;
    padre_inpt[22].name = "costo_reposicion" + nuevovalor;
    padre_inpt[23].id = "costo_reposicion_iva" + nuevovalor;
    padre_inpt[23].name = "costo_reposicion_iva" + nuevovalor;
/*
    var padre_select = document.getElementById(nuevaid).getElementsByTagName("select");
    padre_select[0].name = "pf_capital_tipo" + nuevovalor;
    padre_select[1].name = "pf_dias_tipo" + nuevovalor;
    padre_select[0].id = "pf_capital_tipo" + nuevovalor;
    padre_select[1].id = "pf_dias_tipo" + nuevovalor;

    padre[10].id =  "pf_capital_vb_d" + nuevovalor;
    var js = "muestra_oculta2('"+ nuevovalor +"');";
    var jsid = "pf_capital_tipo" + nuevovalor;
    document.getElementById(jsid).setAttribute("onclick", js); 

    padre[12].id =  "pf_dias_vb_d" + nuevovalor;
    var js2 = "muestra_oculta3('"+ nuevovalor +"');";
    var jsid2 = "pf_dias_tipo" + nuevovalor;
    document.getElementById(jsid2).setAttribute("onclick", js2);  */

    padre[1].id =  "pf_eli" + nuevovalor;
    var js3 = "eliminar_cond('"+ nuevovalor +"');";
    var jsid3 = "pf_eli" + nuevovalor;
    document.getElementById(jsid3).setAttribute("onclick", js3); 

    //padre_inpt[6]
    var js4 = "comicion_apfn('"+ nuevovalor +"');";
    var jsid4 = "comicion_ap" + nuevovalor;
    document.getElementById(jsid4).setAttribute("onclick", js4); 

    //padre_inpt[9]
    var js5 = "comicion_apfnb('"+ nuevovalor +"');";
    var jsid5 = "comicion_ap_b" + nuevovalor;
    document.getElementById(jsid5).setAttribute("onclick", js5); 

    document.getElementById(nuevaid).style.display = "block";

    document.getElementById('nro_cond_t').value = nuevovalor;
}
function muestra_oculta2(id){
        var seleid = "pf_capital_tipo" + id;
        var valorb = "pf_capital_vb_d" + id;
        var CantDoms= document.getElementById(seleid).value;
        if(CantDoms == '1'){
          document.getElementById(valorb).style.display = "block";
        }
        else{
          document.getElementById(valorb).style.display = "none";
        };
  }
function eliminar_cond(id){

    var CantDom2 = parseInt(id);
    var nuevaid0 = "agregar_mas_c" + CantDom2;
    var padre_inpt = document.getElementById(nuevaid0).getElementsByTagName("input");
    padre_inpt[18].value = 'si';
    //document.getElementById(nuevaid0).style.display = 'none';

    var CantCondi=document.getElementById('nro_cond_t').value;//cuenta cant de condiciones hay
    CantCondi = parseInt(CantCondi);
    document.getElementById('nro_cond_t').value = CantCondi - 1;
    //CantCondi_mas = CantCondi + 1;

    var id_a_borrar = "#" + nuevaid0;
    $(id_a_borrar).remove();// BORRA
    if(id < CantCondi){
    for (var i = CantDom2; i < CantCondi; i++) {
      var i0 = parseInt(i);
      var valoractual = i0 + 1;
      var nuevovalor = i0;
      nuevaid = "agregar_mas_c" + valoractual;
      //var padre.length=0;
      var padre = new Array();
      padre = document.getElementById(nuevaid).getElementsByTagName("div");
    padre[0].innerHTML = nuevovalor;

    var padre_inpt = document.getElementById(nuevaid).getElementsByTagName("input");
    padre_inpt[1].name = "nro_cond" + nuevovalor;
    padre_inpt[1].id = "nro_cond" + nuevovalor;
    padre_inpt[2].name = "pf_capital_va" + nuevovalor;
    padre_inpt[3].name = "pf_capital_vb" + nuevovalor;
    padre_inpt[4].name = "pf_dias_va" + nuevovalor;
    padre_inpt[5].name = "pf_dias_vb" + nuevovalor;
    padre_inpt[6].name = "comicion_ap" + nuevovalor;
    padre_inpt[6].id = "comicion_ap" + nuevovalor;
    padre_inpt[7].id = "comicion_ap_cant" + nuevovalor;
    padre_inpt[7].name = "comicion_ap_cant" + nuevovalor;
    padre_inpt[8].name = "comicion_ap_iva" + nuevovalor;
    padre_inpt[8].id = "comicion_ap_iva" + nuevovalor;
    padre_inpt[9].name = "comicion_ap" + nuevovalor;
    padre_inpt[9].id = "comicion_ap_b" + nuevovalor;
    padre_inpt[10].id = "comicion_ap_cant_b" + nuevovalor;
    padre_inpt[10].name = "comicion_ap_cant_b" + nuevovalor;
    padre_inpt[11].name = "comicion_ap_iva_b" + nuevovalor;
    padre_inpt[11].id = "comicion_ap_iva_b" + nuevovalor;
    padre_inpt[12].name = "interes_ord_an" + nuevovalor;
    padre_inpt[13].name = "interes_ord_aniva" + nuevovalor;
    padre_inpt[14].name = "interes_mor_an" + nuevovalor;
    padre_inpt[15].name = "interes_mor_aniva" + nuevovalor;
    padre_inpt[16].name = "costo_al_mes" + nuevovalor;
    padre_inpt[17].name = "costo_al_mesiva" + nuevovalor;

    padre_inpt[18].id = "periodo_gracia" + nuevovalor;
    padre_inpt[18].name = "periodo_gracia" + nuevovalor;

    padre_inpt[19].id = "comicion_x_venta" + nuevovalor;
    padre_inpt[19].name = "comicion_x_venta" + nuevovalor;
    padre_inpt[20].id = "comicion_x_venta_iva" + nuevovalor;
    padre_inpt[20].name = "comicion_x_venta_iva" + nuevovalor;

    padre_inpt[21].id = "dia_gracia" + nuevovalor;
    padre_inpt[21].name = "dia_gracia" + nuevovalor;

    padre_inpt[22].id = "costo_reposicion" + nuevovalor;
    padre_inpt[22].name = "costo_reposicion" + nuevovalor;
    padre_inpt[23].id = "costo_reposicion_iva" + nuevovalor;
    padre_inpt[23].name = "costo_reposicion_iva" + nuevovalor;

    padre[1].id =  "pf_eli" + nuevovalor;
    var js3 = "eliminar_cond('"+ nuevovalor +"');";
    var jsid3 = "pf_eli" + nuevovalor;
    document.getElementById(jsid3).setAttribute("onclick", js3); 

    //padre_inpt[6]
    var js4 = "comicion_apfn('"+ nuevovalor +"');";
    var jsid4 = "comicion_ap" + nuevovalor;
    document.getElementById(jsid4).setAttribute("onclick", js4); 

    //padre_inpt[9]
    var js5 = "comicion_apfnb('"+ nuevovalor +"');";
    var jsid5 = "comicion_ap_b" + nuevovalor;
    document.getElementById(jsid5).setAttribute("onclick", js5); 

    };//fin del for
  };//fin del if
}
function muestra_oculta3(id){
        var seleid = "pf_dias_tipo" + id;
        var valorb = "pf_dias_vb_d" + id;
        var CantDoms= document.getElementById(seleid).value;
        if(CantDoms == '1'){
          document.getElementById(valorb).style.display = "block";
        }
        else{
          document.getElementById(valorb).style.display = "none";
        };
  }
  function muestra_oculta(id){
        if (document.getElementById){ //se obtiene el id
        var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
        el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
        }
    }

  function checkinteres_mora(){
        var CantDom= document.getElementById("interes_mor").checked;
        if (CantDom == true){
         
 document.getElementById("interes_morat").style.display = "block";
        }else{
          document.getElementById("interes_morat").style.display = "none";      
        };
  }
  function checkinteres_ord(){
        var CantDom= document.getElementById("interes_ord").checked;
        if (CantDom == true){
          document.getElementById("calculo_ordinario").style.display = "block";
        }else{
          document.getElementById("calculo_ordinario").style.display = "none";      
        };
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