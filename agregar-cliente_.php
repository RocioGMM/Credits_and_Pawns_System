<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};
$seccion = $_POST["seccion"];if($seccion == ''){$seccion = $_REQUEST["seccion"];};

if ($id != ''){
	$sql1 = "SELECT * FROM cliente WHERE id='".$id."' ";
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
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>




<!------------------------------------------------------------    Mapa SELECCIONABLE      ---------------------------------------- -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

       <script type="text/javascript">
         ///////////// FUNCION QUE PASA EL VALOR DE LAT Y LONG DEL MARKADOR DEL MAPA AL INPUT PARA QUE SEA PROCESADO EN EL FORMULARIO
        function valo(){
            for(i=1;i<sss + a;i++){ 
              window["marker" + i] 
            };
        var mensaje = marker.getPosition();
        //document.valore.value=mensaje;
        document.getElementById("lat_long").value = mensaje;
        }
      </script>
 <script type="text/javascript">
      var script = '<script type="text/javascript" src="src/richmarker';
      if (document.location.search.indexOf('compiled') !== -1) {
        script += '-compiled';
      }
      script += '.js"><' + '/script>';
      document.write(script);
    </script>

<script type="text/javascript" src="richmarker-compiled.js"></script>

<script type="text/javascript">
  <?php      
  
  $sql2i = "SELECT * FROM domicilio WHERE cliente='".$id."' ";
  $result2i = mysql_query($sql2i, $conn1);
  $total_registros2i = mysql_num_rows($result2i);
  $cant_dom_map_ini0 = 0;
  if($row2i["lat_long"] == ''){
        $lat_act = '29.0824736' ; $long_act = '-110.96222'; $dist_act = '12'; 
  }else{
        $lat_act = '29.0824736' ; $long_act = '-110.96222'; $dist_act = '15'; 
  };
  ?>
      /**
       * Called on the intiial page load.
       */
<?php while($row2i = mysql_fetch_array($result2i)){  $cant_dom_map_ini0 = $cant_dom_map_ini0 + 1;?>       
      var map<?= $cant_dom_map_ini0?>;
      var marker<?= $cant_dom_map_ini0?>;
<?php };?>      
      function init() {
        var mapCenter = new google.maps.LatLng(<?php echo $lat_act;?>, <?php echo $long_act;?>);

<?php 
$sql2i = "SELECT * FROM domicilio WHERE cliente='".$id."' ";
  $result2i = mysql_query($sql2i, $conn1);
  $total_registros2i = mysql_num_rows($result2i);
  $cant_dom_map_ini0 = 0;
while($row2i = mysql_fetch_array($result2i)){  $cant_dom_map_ini0 = $cant_dom_map_ini0 + 1;?> 
        map<?= $cant_dom_map_ini0?> = new google.maps.Map(document.getElementById('map<?= $cant_dom_map_ini0?>'), {
          zoom: <?php echo $dist_act;?>,
          center: mapCenter,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
          //mapTypeId: google.maps.MapTypeId.TERRAIN

        marker<?= $cant_dom_map_ini0?> = new RichMarker({
          position: mapCenter,<?php //if($row1["lat"] != '' && $row1["long"] != ''){echo 'new google.maps.LatLng('.$lat_act.', '.$long_act.');';}else{ echo 'mapCenter,';};?>
          map: map<?= $cant_dom_map_ini0?>,
          draggable: true,
          flat: true,
          anchor: RichMarkerPosition.MIDDLE,
          content: '<img src="images/' + 'punterorojo.png" class="puntero_maps"/>'
          });
<?php };?>
        var div = document.createElement('DIV');
        div.innerHTML = '';




        google.maps.event.addListener(marker1, 'position_changed', function() {
          log('Posicion del Markador: ' + marker1.getPosition());
        });

        google.maps.event.addDomListener(document.getElementById('set-content'),
          'click', function() {
          setMarkerContent();
        });

        google.maps.event.addDomListener(document.getElementById('toggle-map'),
          'click', function() {
          toggleMap();
        });

        google.maps.event.addDomListener(document.getElementById('toggle-anchor'),
          'click', function() {
          toggleAnchor();
        });

        google.maps.event.addDomListener(document.getElementById('toggle-flat'),
          'click', function() {
          toggleFlat();
        });
        google.maps.event.addDomListener(document.getElementById('toggle-visible'),
          'click', function() {
          toggleVisible();
        });

        google.maps.event.addDomListener(document.getElementById('toggle-draggable'),
          'click', function() {
          marker1.setDraggable(!marker1.getDraggable());
        });
      }

      function log(msg) {
        var log = document.getElementById('log');
        log.innerHTML = msg;
      }

      function setMarkerContent() {
        var content = document.getElementById('marker-content').value;
        marker1.setContent(content);
      }

      function toggleMap() {
        if (marker1.getMap() == map1) {
          marker1.setMap(map2);
        } else {
          marker1.setMap(map1);
        }
      }

      function toggleFlat() {
        marker.setFlat(!marker.getFlat());
      }

      function toggleVisible() {
        marker.setVisible(!marker.getVisible());
      }

      function toggleAnchor() {
        var anchor = marker.getAnchor();

        if (anchor == 9) {
          anchor = 1;
        } else {
          anchor++;
        }

        marker.setAnchor(anchor);
      }

      // Register an event listener to fire when the page finishes loading.
      google.maps.event.addDomListener(window, 'load', init);
    </script>
    <!------------------------------------------------------------   FIN  Mapa SELECCIONABLE      ---------------------------------------- -->




</head>

<body>
<!--
<div class="log-out">
  <div class="lo-logo"><img src="logopocket.png"  height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>-->

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
  <!--<a href="cliente.php" class="op atr" title="Listado de Clientes">Atras</a>-->
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
  <div class="btn-proys"><a href="cliente.php"><img src="back-clientes.png" width="44" height="44" /></a></div>
  <span class="titlesec">CLIENTES</span>
</div>  -->
    


<div class="tp">
<div class="subpanel">
<!--<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>
--></div>
  <div class="cf"></div>
</div>



<form method="post" action="panel/a_cli.php?id=<?php echo $id;?>&vi=<?php echo $vi;?>" name="frmRegistro">
<input type="hidden" name="seccion" value="<?= $seccion;?>"/>
<input type="hidden" name="id" value="<?= $id?>"/>

<div class="onecol"><span class="titlecol-ad"><?php 
  if($tipo == ''){echo 'Agregar cliente';};
  ?>  </span>
  




<?php /*if($_SESSION["tipo"] != 'vendedor') {?>
  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <!--<input type="text" name="vendedor" id="textfield" placeholder="Vendedor asignado:" value="<?php echo $row["vendedor"];?>"/>-->
      <select name="vendedor" id="textfield"  class="hospitalx">
      <option value="" disabled="disabled" selected>Vendedor </option>
      <?php //  
        $sql9h= "SELECT * FROM vendedor ORDER BY nombre, apellido ASC";
        $result9h = mysql_query($sql9h, $conn1);
        while($row9h = mysql_fetch_array($result9h)){ 
      ?>    
      <option value="<?php echo $row9h["id"]?>"<?php 
                  if($row["vendedor"] == $row9h["id"]){
                  echo ' selected';}; 
                  ?>><?php echo $row9h["nombre"].' '.$row9h["apellido"]?></option>
      <?php };///?>
      </select>
    </div><div class="campb dospor">
      <label for="textfield"></label>
      <!--<input type="text" name="rfc" id="textfield" placeholder="RFC:" value="<?php echo $row["rfc"];?>"/>      -->
    </div>
  </div>
<?php };//*/?>





<!--------------------------------------- INICIA ------------------------ -->
<?php if($id != ''){?>



<div class="clientes-menu">
  <a class="clientes-menu-item2"><?php echo $row["contacto"].' <br> '.$row["apellido_materno"].' <br> '.$row["apellido_paterno"]; ?></a>
  <a href="agregar-cliente.php?tipo=mod&id=<?= $id?>&seccion=1" class="clientes-menu-item">Perfil Personal</a>
  <a href="agregar-cliente.php?tipo=mod&id=<?= $id?>&seccion=2" class="clientes-menu-item">Perfil Laboral</a>
  <a href="agregar-cliente.php?tipo=mod&id=<?= $id?>&seccion=3" class="clientes-menu-item">Perfil Económico</a>
  <a href="agregar-cliente.php?tipo=mod&id=<?= $id?>&seccion=4" class="clientes-menu-item">Propiedades</a>
  <a href="agregar-cliente.php?tipo=mod&id=<?= $id?>&seccion=5" class="clientes-menu-item">Referencias</a>
  <a href="agregar-cliente.php?tipo=mod&id=<?= $id?>&seccion=6" class="clientes-menu-item">Analisis del cliente</a>
</div>

  <div class="campitem-cliente">
    <div class="imgcliente"></div>
    <div class="campb111 dosporch">
      <div class="dattaclieti0">
        <div class="dattaclieti"><strong>Nombre Completo:</strong> <?php echo $row["contacto"].' '.$row["apellido_materno"];?></div>           
        <div class="dattaclieti"><strong>Email:</strong> <?php echo $row["email"];?></div>     
        <div class="dattaclieti"><strong>Buro de Credito:</strong> <?php echo $row["buro_credito"];?></div>      
        <div class="dattaclieti"><strong>Buro Interno: </strong> <?php echo $row["buro_interno"];?></div>
        <div class="dattaclieti"><strong>Google:</strong> <?php echo $row["google"];?></div>      
        <div class="dattaclieti"><strong>Papeles de Carro:</strong> <?php echo $row["papeles_carro"];?></div>    
        <div class="dattaclieti"><strong>Aval:</strong> <?php echo $row["aval"];?></div>
      </div>   
      <div class="dattaclieti0"> 
        <div class="dattaclieti"><strong>Edad:</strong> <?php 
        if ($row["fecha_nacimiento"] != '0000-00-00') {
              $fecha_1 = new DateTime($row["fecha_nacimiento"]);
              $fecha_2 = new DateTime(date("Y-m-d"));
              $fecha_0 = date_diff($fecha_1, $fecha_2);//saco la cantidad de años de diferencia
              echo $fecha_0->y;
              //printf('%d años', $fecha->y);
              //echo $row["edad"];
        }
        ?></div>      
        <div class="dattaclieti"><strong>Cel:</strong> <?php echo $row["celular"];?></div>      
        <div class="dattaclieti"><strong>Tel:</strong> <?php echo $row["telefono"];?></div> 
        <div class="dattaclieti"><strong>Solicita:</strong> <?php echo $row[""];?></div>              
        <div class="dattaclieti"><strong></strong> <?php echo $row["GPS"];?></div>                
        <div class="dattaclieti"><strong>Destino:</strong> <?php echo $row[""];?></div>        
        <div class="dattaclieti"><strong>Linea de Creditos:</strong> <?php echo $row["linea_credito"];?></div> 
      </div>
    </div>
    <div class="comclienti"><strong>Comentarios</strong></div>
    <?php if($id != '' && $seccion == ''){?>
    <div class="camp_ext_ini">
        <div class="camp_ext_ini_item">
            <strong>Vivienda:</strong>  <?php echo $row["tipo_casa"];?> 
            <?php 
            if($row["numero_dependientes"] != '0' && $row["numero_dependientes"] != ''){
              echo ' - '.$row["numero_dependientes"].' dependientes';
            };
            if($row["num_personas_tech"] != '0' && $row["num_personas_tech"] != ''){
              echo ' - '.$row["num_personas_tech"].' personas viviendo';
            };
            if($row["salud_comentario"] != '0' && $row["salud_comentario"] != ''){
              echo ' - '.$row["salud_comentario"].' problemas de salud';
            };?>
            <br>
            <?php
            $sql2 = "SELECT * FROM domicilio WHERE cliente='".$id."' ORDER BY id DESC ";
            $result2 = mysql_query($sql2, $conn1);
            $row2 = mysql_fetch_array($result2);
            if($row2["id"] != ''){
              echo $row2["domicilio"].' ('.$row2["calles"].') Desde: '.$row2["desde_cuando"];
            };?>
            <div class="separacion-rallada"></div>
            <strong>Horarios de Casa</strong>
            <?php // FALTA  ?>
        </div>
        <div class="camp_ext_ini_item">
            <strong>Ocupacion:</strong> <?php echo $row["ocupacion"];?><br>
            <?php
              //if ($row["ocupacion"] == 'Empleado') {
                    if ($row["empresa_nombre"] !='') {
                      echo '<strong>Nombre de la empresa: </strong>'.$row["empresa_nombre"];
                    };if ($row["empresa_sector"] !='') {
                      echo '<strong>Sector: </strong>'.$row["empresa_sector"];
                    };if ($row["empresa_puesto"] !='') {
                      echo '<strong>Puesto: </strong>'.$row["empresa_puesto"].'<br>';
                    };if ($row["empresa_direccion"] !='') {
                      echo '<strong>Domicilio: </strong>'.$row["empresa_direccion"].' ('.$row["empresa_referencia"].')<br>';
                    };if ($row["trabajo_tiempo"] !='') {
                      echo '<strong>Tiempo Trabajando en la empresa: </strong>'.$row["trabajo_tiempo"].'<br>';
                    };if ($row["empresa_puesto"] !='') {
                      echo '<strong>Horario que trabaja: </strong>'.$row["empresa_puesto"].'<br>';
                    };if ($row["trabajo_telefono1"] !='') {
                      echo '<strong>Telefono del trabajo: </strong>'.$row["trabajo_telefono1"].'<br>';
                    };if ($row["jefe_nombre"] !='') {
                      echo '<strong>Jefe Inmediato:  </strong>'.$row["jefe_nombre"];
                    };if ($row["jefe_celular"] !='') {
                      echo '<strong>Celular: </strong>'.$row["jefe_celular"].'<br>';
                    };
              //};
            ?>
        </div>
        <div class="camp_ext_ini_item">
            <strong>Estado civil:</strong> <?php echo $row["estado_civil"];?><br>
            <?php 
                //if ($row["estado_civil"] == 'Casado' || $row["estado_civil"] == 'Union_Libre') {
                $ingresos_mens = $row["ganancias_mes"]+$row["otros_ingresos_monto"]+$row["pareja_ganancia"];
                $egresos_mens = $row["eg_casa_mensualidad"]+$row["eg_casa_servicios"]+$row["eg_alimentacion"]+$row["eg_escuelas"];
                $egresos_mens = $egresos_mens + $row["eg_carro_mensualidad"] + $row["eg_transporte"] + $row["eg_tagera_credito"];
                $egresos_mens = $egresos_mens + $row["eg_celulares"] + $row["eg_otros"] + $row["parejaex_mensualidad_cant"];
            ?>
            <div class="ganacias_ini0">
              <div class="ganacias_ini1">
                  <div class="ganacias_ini2">
                        <div class="ganacias_ini4">$<?php echo $ingresos_mens;?></div>
                        <div class="ganancias_ini5">Ingresos Mensuales</div>
                  </div>
                  <div class="ganacias_ini3">
                        <?php echo $row["ganancias_mes"].' Ingresos - '.$row["otros_ingresos_monto"].' Otros Ingresos - '.$row["pareja_ganancia"].' Pareja'?>
                  </div>
                  <div class="ganacias_ini2 borde_de_abajo">
                        <div class="ganacias_ini4">$<?php echo $egresos_mens;?></div>
                        <div class="ganancias_ini5">Egresos Mensuales</div>
                  </div>
                  <div class="ganacias_ini3">
                        <?php 
                        echo $row["eg_casa_mensualidad"].' Mensualidad Casa - '.$row["eg_casa_servicios"].' Servicios - '.$row["eg_alimentacion"].' Alimentacion - ';
                        if($row["eg_escuelas"] != '' && $row["eg_escuelas"] != '0'){$row["eg_escuelas"].' Escuelas - ';};
                        if($row["eg_carro_mensualidad"] != '' && $row["eg_carro_mensualidad"] != '0'){$row["eg_carro_mensualidad"].' Carro - ';};
                        if($row["eg_transporte"] != '' && $row["eg_transporte"] != '0'){$row["eg_transporte"].' Transporte - ';};
                        if($row["eg_tagera_credito"] != '' && $row["eg_tagera_credito"] != '0'){$row["eg_tagera_credito"].' Tarjeta de Credito - ';};
                        if($row["eg_celulares"] != '' && $row["eg_celulares"] != '0'){$row["eg_celulares"].' Celulares - ';};
                        if($row["parejaex_mensualidad_cant"] != '' && $row["parejaex_mensualidad_cant"] != '0'){$row["parejaex_mensualidad_cant"].' Mensualidad a Ex Pareja - ';};                        
                        ?>
                  </div>
              </div>
              <div class="ganacias_ini1">
                  <div class="ganacias_ini7">
                        <div class="ganacias_ini8">$<?php echo $ingresos_mens-$egresos_mens;?></div>
                        <div class="ganancias_ini9">Disponibles Mensuales</div>
                  </div>
              </div>
              <div class="ganacias_ini1">
                  <div class="ganacias_ini7">
                        <div class="ganacias_ini8">$<?php echo $row["dinero_disponible"];?></div>
                        <div class="ganancias_ini9">Cliente dice que dispone para pagar el crédito</div>
                  </div>
              </div>
            </div>
            <?php //};?>
        </div>
        <div class="camp_ext_ini_item">
          <strong>Propiedades</strong>
          <?php $ralla_prop = 0;
              $sql4 = "SELECT * FROM carro WHERE cliente='".$id."' ORDER BY id DESC ";
              $result4 = mysql_query($sql4, $conn1);
              while($row4 = mysql_fetch_array($result4)){
                $ralla_prop = $ralla_prop + 1;
                //marca modelo  year  propietario tipo  multas cuando placa num_serie comentarios
         ?>
            <div class="separacion-rallada"></div>
          <?php  };?>
        </div>
        <div class="camp_ext_ini_item">
                  <strong>Referencias Personales</strong>

            <?php $ralla_ref = 0;
              $sql3 = "SELECT * FROM referencias WHERE cliente='".$id."' ORDER BY id DESC ";
              $result3 = mysql_query($sql3, $conn1);
              while($row3 = mysql_fetch_array($result3)){
                $ralla_ref = $ralla_ref + 1;
            ?>
              <?php if($ralla_ref != '1'){?><div class="separacion-rallada"></div><?php };?>
                <strong><?php 
                    if($row3["tipo"] == 'familiar_vive_ud'){echo ') Familiar que vive con usted )';};
                    if($row3["tipo"] == 'familiar_no_vive_ud'){echo '( Familiar que no vive con usted )';};
                    if($row3["tipo"] == 'comp_trabajo'){echo '( Compañero de Trabajo )';};
                    if($row3["tipo"] == 'amigo'){echo '( Amigo )';};
                ?></strong>
                <?= $row3["nombre"]?><br>
                <strong>Domicilio: </strong>   <?= $row3["domicilio"]?><br>
                <strong>Parentesco: </strong> <?= $row3["parentesco"]?><br>
                <strong>Celular: </strong> <?= $row3["celular"]?><br>
                <strong>Telefono: </strong> <?= $row3["telefono"]?><br>
                <a><strong>Ver Mapa</strong></a>
                
            <?php };?>
        </div>
        <div class="camp_ext_ini_item">
                  <strong>Referencias Crediticias</strong>

            <?php $ralla_ref = 0;
              $sql3 = "SELECT * FROM referencias_crediticias WHERE cliente='".$id."' ORDER BY id DESC ";
              $result3 = mysql_query($sql3, $conn1);
              while($row3 = mysql_fetch_array($result3)){
                $ralla_ref = $ralla_ref + 1;
            ?>
              <?php if($ralla_ref != '1'){?><div class="separacion-rallada"></div><?php };?>
                <strong>Numero de Tarjeta: </strong>   <?= $row3["num_tarjeta"]?><br>
                <strong>Institucion: </strong> <?= $row3["institucion"]?><br>
                <strong>Limite de crédito exacto: </strong> <?= $row3["limite_credito"]?><br>
                
            <?php };?>
        </div>
    </div>
    <?php };?>
  </div>


  <?php };?>
<!---------------------------------------  FIN INICIA ------------------------ -->




<!---------------------------------------  PERFIL PERSONAL ------------------------ -->
<div id="P_Personal" style="display:block;">


<?php if($id == '' || $seccion == '1'){?>

<span class="titlecol-ad">Perfil Personal</span>

<?php if ($id != ''){ $desha = 'disabled'; $clase_bl = 'clase_bl';?>
  <div class="campitem-cliente2">
    <div class="campd ">
      <label for="textfield"></label>
      <div>Folio</div>
      <input type="text" name="folio" id="textfield" class="hospitalx clase_bl" value="<?php echo $row["id"];?>" disabled/>
    </div>
  </div>
<?php };?>

  <div class="campitem-cliente2">
    <div class="campd ">
      <label for="textfield"></label>
      <!--<input type="text" name="folio" id="textfield" placeholder="Folio" value="<?php echo $row["folio"];?>"/>-->
      <div>Nombre</div>
      <input type="text" name="contacto" value="<?php echo $row["contacto"];?>" class="hospitalx mayusculas <?= $clase_bl?>" <?= $desha?>/>
    </div>
    <div class="campd  dosporch">
      <div>Apellido Materno</div>
      <input type="text" name="apellido_materno" class="hospitalx mayusculas <?= $clase_bl?>"  value="<?php echo $row["apellido_materno"];?>" <?= $desha?>/>
    </div>
    <div class="campd  dosporch">
      <div>Apellido Paterno</div>
      <input type="text" name="apellido_paterno" class="hospitalx mayusculas <?= $clase_bl?>"  value="<?php echo $row["apellido_paterno"];?>" <?= $desha?>/>
    </div>
  </div>



  <div class="campitem-cliente2">
    <div class="campd">
      <div>Lugar de Nacimiento</div>
      <!--<input type="text" name="apellido_paterno" class="hospitalx mayusculas" placeholder="Apellido Paterno" value="<?php echo $row["apellido_paterno"];?>"/>-->
      <!--<input type="text" name="lugar_nacimiento" id="textfield" placeholder="Lugar Nacimiento:" value="<?php echo $row["lugar_nacimiento"];?>"/>-->
      <select name="lugar_nacimiento" id="lugar_nacimiento"  class="hospitalx <?= $clase_bl?>" <?= $desha?>>
            <option value="0" disabled="disabled" selected>Estado</option>
          <?php
                $sql2 = "SELECT * FROM estado ORDER BY nombre ASC ";
                $result2 = mysql_query($sql2, $conn1);
                while($row2 = mysql_fetch_array($result2)){
          ?>
            <option value="<?= $row2["id"];?>" 
                              <?php if($row["lugar_nacimiento"] == $row2["id"]){echo 'selected';}
                                  elseif($row2["id"] == '2' && $id == ''){ echo 'selected'; };   ?>>
                        <?= $row2["nombre"];?></option>
          <?php };?>
      </select>
    </div>
    <div class="campd dosporch">
      <div>Fecha de Nacimiento</div>
      <!--<input type="text" name="fecha_nacimiento" id="textfield" placeholder="Fecha Nacimiento:" value="<?php echo $row["fecha_nacimiento"];?>"/>-->
      <select name="fecha_nacimiento_d" id="fecha_nacimiento_d"  class="hospitalx <?= $clase_bl?>"  <?= $desha?>>
          <option value="0" disabled="disabled" selected>Dia</option>
          <option value="01" <?php if($dia_ac == '01'){echo 'selected';};?>> 1 </option>
          <option value="02" <?php if($dia_ac == '02'){echo 'selected';};?>> 2 </option>
          <option value="03" <?php if($dia_ac == '03'){echo 'selected';};?>> 3 </option>
          <option value="04" <?php if($dia_ac == '04'){echo 'selected';};?>> 4 </option>
          <option value="05" <?php if($dia_ac == '05'){echo 'selected';};?>> 5 </option>
          <option value="06" <?php if($dia_ac == '06'){echo 'selected';};?>> 6 </option>
          <option value="07" <?php if($dia_ac == '07'){echo 'selected';};?>> 7 </option>
          <option value="08" <?php if($dia_ac == '08'){echo 'selected';};?>> 8 </option>
          <option value="09" <?php if($dia_ac == '09'){echo 'selected';};?>> 9 </option>
          <option value="10" <?php if($dia_ac == '10'){echo 'selected';};?>> 10 </option>
          <option value="11" <?php if($dia_ac == '11'){echo 'selected';};?>> 11 </option>
          <option value="12" <?php if($dia_ac == '12'){echo 'selected';};?>> 12 </option>
          <option value="13" <?php if($dia_ac == '13'){echo 'selected';};?>> 13 </option>
          <option value="14" <?php if($dia_ac == '14'){echo 'selected';};?>> 14 </option>
          <option value="15" <?php if($dia_ac == '15'){echo 'selected';};?>> 15 </option>
          <option value="16" <?php if($dia_ac == '16'){echo 'selected';};?>> 16 </option>
          <option value="17" <?php if($dia_ac == '17'){echo 'selected';};?>> 17 </option>
          <option value="18" <?php if($dia_ac == '18'){echo 'selected';};?>> 18 </option>
          <option value="19" <?php if($dia_ac == '19'){echo 'selected';};?>> 19 </option>
          <option value="20" <?php if($dia_ac == '20'){echo 'selected';};?>> 20 </option>
          <option value="21" <?php if($dia_ac == '21'){echo 'selected';};?>> 21 </option>
          <option value="22" <?php if($dia_ac == '22'){echo 'selected';};?>> 22 </option>
          <option value="23" <?php if($dia_ac == '23'){echo 'selected';};?>> 23 </option>
          <option value="24" <?php if($dia_ac == '24'){echo 'selected';};?>> 24 </option>
          <option value="25" <?php if($dia_ac == '25'){echo 'selected';};?>> 25 </option>
          <option value="26" <?php if($dia_ac == '26'){echo 'selected';};?>> 26 </option>
          <option value="27" <?php if($dia_ac == '27'){echo 'selected';};?>> 27 </option>
          <option value="28" <?php if($dia_ac == '28'){echo 'selected';};?>> 28 </option>
          <option value="29" <?php if($dia_ac == '29'){echo 'selected';};?>> 29 </option>
          <option value="30" <?php if($dia_ac == '30'){echo 'selected';};?>> 30 </option>
          <option value="31" <?php if($dia_ac == '31'){echo 'selected';};?>> 31 </option>
      </select>
      <select name="fecha_nacimiento_m" id="fecha_nacimiento_m"  class="hospitalx <?= $clase_bl?>" <?= $desha?>>
          <option value="0" disabled="disabled" selected>Mes</option>
          <option value="01" <?php if($mes_ac == '01'){echo 'selected';};?>> Enero </option>
          <option value="02" <?php if($mes_ac == '02'){echo 'selected';};?>> Febrero </option>
          <option value="03" <?php if($mes_ac == '03'){echo 'selected';};?>> Marzo </option>
          <option value="04" <?php if($mes_ac == '04'){echo 'selected';};?>> Abril </option>
          <option value="05" <?php if($mes_ac == '05'){echo 'selected';};?>> Mayo </option>
          <option value="06" <?php if($mes_ac == '06'){echo 'selected';};?>> Junio </option>
          <option value="07" <?php if($mes_ac == '07'){echo 'selected';};?>> Julio </option>
          <option value="08" <?php if($mes_ac == '08'){echo 'selected';};?>> Agosto </option>
          <option value="09" <?php if($mes_ac == '09'){echo 'selected';};?>> Septiembre </option>
          <option value="10" <?php if($mes_ac == '10'){echo 'selected';};?>> Octubre </option>
          <option value="11" <?php if($mes_ac == '11'){echo 'selected';};?>> Noviembre </option>
          <option value="12" <?php if($mes_ac == '12'){echo 'selected';};?>> Diciembre </option>
      </select>
      <select name="fecha_nacimiento_a" id="fecha_nacimiento_a"  class="hospitalx <?= $clase_bl?>" <?= $desha?>>
          <option value="0" disabled="disabled" selected>Año</option>
          <option value="1941" <?php if($mes_a == '1941'){echo 'selected';};?>> 1941 </option>
          <option value="1942" <?php if($mes_a == '1942'){echo 'selected';};?>> 1942 </option>
          <option value="1943" <?php if($mes_a == '1943'){echo 'selected';};?>> 1943 </option>
          <option value="1944" <?php if($mes_a == '1944'){echo 'selected';};?>> 1944 </option>
          <option value="1945" <?php if($mes_a == '1945'){echo 'selected';};?>> 1945 </option>
          <option value="1946" <?php if($mes_a == '1946'){echo 'selected';};?>> 1946 </option>
          <option value="1947" <?php if($mes_a == '1947'){echo 'selected';};?>> 1947 </option>
          <option value="1948" <?php if($mes_a == '1948'){echo 'selected';};?>> 1948 </option>
          <option value="1949" <?php if($mes_a == '1949'){echo 'selected';};?>> 1949 </option>
          <option value="1950" <?php if($mes_a == '1950'){echo 'selected';};?>> 1950 </option>
          <option value="1951" <?php if($mes_a == '1951'){echo 'selected';};?>> 1951 </option>
          <option value="1952" <?php if($mes_a == '1952'){echo 'selected';};?>> 1952 </option>
          <option value="1953" <?php if($mes_a == '1953'){echo 'selected';};?>> 1953 </option>
          <option value="1954" <?php if($mes_a == '1954'){echo 'selected';};?>> 1954 </option>
          <option value="1955" <?php if($mes_a == '1955'){echo 'selected';};?>> 1955 </option>
          <option value="1956" <?php if($mes_a == '1956'){echo 'selected';};?>> 1956 </option>
          <option value="1957" <?php if($mes_a == '1957'){echo 'selected';};?>> 1957 </option>
          <option value="1958" <?php if($mes_a == '1958'){echo 'selected';};?>> 1958 </option>
          <option value="1959" <?php if($mes_a == '1959'){echo 'selected';};?>> 1959 </option>
          <option value="1960" <?php if($mes_a == '1960'){echo 'selected';};?>> 1960 </option>
          <option value="1961" <?php if($mes_a == '1961'){echo 'selected';};?>> 1961 </option>
          <option value="1962" <?php if($mes_a == '1962'){echo 'selected';};?>> 1962 </option>
          <option value="1963" <?php if($mes_a == '1963'){echo 'selected';};?>> 1963 </option>
          <option value="1964" <?php if($mes_a == '1964'){echo 'selected';};?>> 1964 </option>
          <option value="1965" <?php if($mes_a == '1965'){echo 'selected';};?>> 1965 </option>
          <option value="1966" <?php if($mes_a == '1966'){echo 'selected';};?>> 1966 </option>
          <option value="1967" <?php if($mes_a == '1967'){echo 'selected';};?>> 1967 </option>
          <option value="1968" <?php if($mes_a == '1968'){echo 'selected';};?>> 1968 </option>
          <option value="1969" <?php if($mes_a == '1969'){echo 'selected';};?>> 1969 </option>
          <option value="1970" <?php if($mes_a == '1970'){echo 'selected';};?>> 1970 </option>
          <option value="1971" <?php if($mes_a == '1971'){echo 'selected';};?>> 1971 </option>
          <option value="1972" <?php if($mes_a == '1972'){echo 'selected';};?>> 1972 </option>
          <option value="1973" <?php if($mes_a == '1973'){echo 'selected';};?>> 1973 </option>
          <option value="1974" <?php if($mes_a == '1974'){echo 'selected';};?>> 1974 </option>
          <option value="1975" <?php if($mes_a == '1975'){echo 'selected';};?>> 1975 </option>
          <option value="1976" <?php if($mes_a == '1976'){echo 'selected';};?>> 1976 </option>
          <option value="1977" <?php if($mes_a == '1977'){echo 'selected';};?>> 1977 </option>
          <option value="1978" <?php if($mes_a == '1978'){echo 'selected';};?>> 1978 </option>
          <option value="1979" <?php if($mes_a == '1979'){echo 'selected';};?>> 1979 </option>
          <option value="1980" <?php if($mes_a == '1980' || $mes_ac == ''){echo 'selected';};?>> 1980 </option>
          <option value="1981" <?php if($mes_a == '1981'){echo 'selected';};?>> 1981 </option>
          <option value="1982" <?php if($mes_a == '1982'){echo 'selected';};?>> 1982 </option>
          <option value="1983" <?php if($mes_a == '1983'){echo 'selected';};?>> 1983 </option>
          <option value="1984" <?php if($mes_a == '1984'){echo 'selected';};?>> 1984 </option>
          <option value="1985" <?php if($mes_a == '1985'){echo 'selected';};?>> 1985 </option>
          <option value="1986" <?php if($mes_a == '1986'){echo 'selected';};?>> 1986 </option>
          <option value="1987" <?php if($mes_a == '1987'){echo 'selected';};?>> 1987 </option>
          <option value="1988" <?php if($mes_a == '1988'){echo 'selected';};?>> 1988 </option>
          <option value="1989" <?php if($mes_a == '1989'){echo 'selected';};?>> 1989 </option>
          <option value="1990" <?php if($mes_a == '1990'){echo 'selected';};?>> 1990 </option>
          <option value="1991" <?php if($mes_a == '1991'){echo 'selected';};?>> 1991 </option>
          <option value="1992" <?php if($mes_a == '1992'){echo 'selected';};?>> 1992 </option>
          <option value="1993" <?php if($mes_a == '1993'){echo 'selected';};?>> 1993 </option>
          <option value="1994" <?php if($mes_a == '1994'){echo 'selected';};?>> 1994 </option>
          <option value="1995" <?php if($mes_a == '1995'){echo 'selected';};?>> 1995 </option>
          <option value="1996" <?php if($mes_a == '1996'){echo 'selected';};?>> 1996 </option>
          <option value="1997" <?php if($mes_a == '1997'){echo 'selected';};?>> 1997 </option>
          <option value="1998" <?php if($mes_a == '1998'){echo 'selected';};?>> 1998 </option>
          <option value="1999" <?php if($mes_a == '1999'){echo 'selected';};?>> 1999 </option>
      </select>
    </div>
    <div class="campd dosporch">
      <div>Sexo</div>
      <select name="sexo"  class="hospitalx <?= $clase_bl?>" <?= $desha?>>        
        <option value="h"> Hombre </option>
        <option value="m"> Mujer </option>
      </select>
    </div>
  </div>



  <div class="campitem-cliente2">
    <div class="campd ">
      <div>E-Mail</div>
      <input type="text" name="email" class="hospitalx" placeholder="email:" value="<?php echo $row["email"];?>"/>
    </div>

    <div class="campd dosporch">
      <div>Celular</div>
      <input type="text" name="celular" class="hospitalx" placeholder="Celular" value="<?php echo $row["celular"];?>"/>
    </div>
    <div class="campd dosporch">
      <?php if ($id != ''){?>
      <div>Telefono</div>
      <input type="text" name="telefono" class="hospitalx" placeholder="Telefono" value="<?php echo $row["telefono"];?>"/>
      <?php };?>
    </div>
  </div>




  <div class="campitem-cliente">
    <div class="campb">
      <div>RFC</div>
      <input type="text" name="rfc" id="textfield" placeholder="" value="<?php echo $row["rfc"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>CURP</div>
      <input type="text" name="CURP" id="textfield" placeholder="" value="<?php echo $row["CURP"];?>"/>
    </div>
  </div>



   <div class="campitem">
   <div>Como se entero</div>    
    <div class="campb">
      <!--<textarea name="como_entero"  cols="" rows="" placeholder=""><?php echo $row["como_entero"];?></textarea>-->
      <!--<input type="text" name="como_entero" id="textfield" placeholder="como_entero:" value="<?php echo $row["como_entero"];?>"/>-->      
      <select name="como_entero"  class="hospitalx">        
        <option value="lona" <?php if($row["como_entero"] == 'lona'){echo 'selected';}; ?>  > Lona </option>
        <option value="periodico" <?php if($row["como_entero"] == 'periodico'){echo 'selected';};  ?>  > Periodico </option>      
        <option value="radio" <?php if($row["como_entero"] == 'radio'){echo 'selected';};  ?>  > Radio </option>      
        <option value="facebook" <?php if($row["como_entero"] == 'facebook'){echo 'selected';}; ?>  > Facebook </option>      
        <option value="vendobara" <?php if($row["como_entero"] == 'vendobara'){echo 'selected';};  ?>  > Vendobara </option>   
        <option value="recomendado" <?php if($row["como_entero"] == 'recomendado'){echo 'selected';};  ?>  > Recomendado </option>   
        <option value="cambaceo" <?php if($row["como_entero"] == 'cambaceo'){echo 'selected';}; ?>  > Cambaceo </option>   
        <option value="vio_el_local" <?php if($row["como_entero"] == 'vio_el_local'){echo 'selected';}; ?>  > Vio el local </option>   
        <option value="otro" <?php if($row["como_entero"] == 'otro'){echo 'selected';}; ?>  > Otro </option>
      </select>
    </div>
  </div>

<?php };if($seccion == '1'){
  $sql2 = "SELECT * FROM domicilio WHERE cliente='".$id."' ";
  $result2 = mysql_query($sql2, $conn1);
  $total_registros2 = mysql_num_rows($result2);
  $cantidad_dom_w = 1;
  //$row2 = mysql_fetch_array($result2);
  ?>

  <div class="campitem-cliente2">
    <input type="hidden" name="numero_domicilios" id="numero_domicilios" value="<?= $total_registros2;?>"/>
    <div>Domicilio <a onclick="mas_dom()">(+)</a></div>   
  </div>


<div class="campitem-cliente2" id="domicilios_extras">
<?php while($row2 = mysql_fetch_array($result2)){ if($row2["id"] != ''){?>
<input type="hidden" name="id_dom<?= $cantidad_dom_w?>" value="<?= $row2["id"]?>"/>
  <div id="copydom<?= $cantidad_dom_w?>">
      <div class="campitem-cliente2">
            <div>Domicilio <?= $cantidad_dom_w?></div>
            <div class="campd">
                <div>Direccion</div>
                <input type="text" name="domicilio<?= $cantidad_dom_w?>" class="hospitalx" value="<?= $row2["domicilio"];?>"/>
            </div>
            <div class="campd dosporch">
                <div>Entre que calles y referencia de domicilio</div>
                <input type="text" name="calles<?= $cantidad_dom_w?>" class="hospitalx" value="<?= $row2["calles"];?>"/>
            </div>
            <div class="campd dosporch">
                <div>Desde Cuando vives ahi</div>
                <!--<input type="text" name="desde_cuando<?= $cantidad_dom_w?>" class="hospitalx" value="<?= $row2["desde_cuando"];?>"/>-->
        <select name="desde_cuando_m_<?= $cantidad_dom_w?>" class="hospitalx desde_c" >
          <option value="0" disabled="disabled" selected>Mes</option>
          <option value="01" <?php if($mes_ac == '01'){echo 'selected';};?>> Enero </option>
          <option value="02" <?php if($mes_ac == '02'){echo 'selected';};?>> Febrero </option>
          <option value="03" <?php if($mes_ac == '03'){echo 'selected';};?>> Marzo </option>
          <option value="04" <?php if($mes_ac == '04'){echo 'selected';};?>> Abril </option>
          <option value="05" <?php if($mes_ac == '05'){echo 'selected';};?>> Mayo </option>
          <option value="06" <?php if($mes_ac == '06'){echo 'selected';};?>> Junio </option>
          <option value="07" <?php if($mes_ac == '07'){echo 'selected';};?>> Julio </option>
          <option value="08" <?php if($mes_ac == '08'){echo 'selected';};?>> Agosto </option>
          <option value="09" <?php if($mes_ac == '09'){echo 'selected';};?>> Septiembre </option>
          <option value="10" <?php if($mes_ac == '10'){echo 'selected';};?>> Octubre </option>
          <option value="11" <?php if($mes_ac == '11'){echo 'selected';};?>> Noviembre </option>
          <option value="12" <?php if($mes_ac == '12'){echo 'selected';};?>> Diciembre </option>
      </select>
      <select name="desde_cuando_a_<?= $cantidad_dom_w?>" class="hospitalx desde_c" >
          <option value="0" disabled="disabled" selected>Año</option>
          <option value="1941" <?php if($mes_a == '1941'){echo 'selected';};?>> 1941 </option>
          <option value="1942" <?php if($mes_a == '1942'){echo 'selected';};?>> 1942 </option>
          <option value="1943" <?php if($mes_a == '1943'){echo 'selected';};?>> 1943 </option>
          <option value="1944" <?php if($mes_a == '1944'){echo 'selected';};?>> 1944 </option>
          <option value="1945" <?php if($mes_a == '1945'){echo 'selected';};?>> 1945 </option>
          <option value="1946" <?php if($mes_a == '1946'){echo 'selected';};?>> 1946 </option>
          <option value="1947" <?php if($mes_a == '1947'){echo 'selected';};?>> 1947 </option>
          <option value="1948" <?php if($mes_a == '1948'){echo 'selected';};?>> 1948 </option>
          <option value="1949" <?php if($mes_a == '1949'){echo 'selected';};?>> 1949 </option>
          <option value="1950" <?php if($mes_a == '1950'){echo 'selected';};?>> 1950 </option>
          <option value="1951" <?php if($mes_a == '1951'){echo 'selected';};?>> 1951 </option>
          <option value="1952" <?php if($mes_a == '1952'){echo 'selected';};?>> 1952 </option>
          <option value="1953" <?php if($mes_a == '1953'){echo 'selected';};?>> 1953 </option>
          <option value="1954" <?php if($mes_a == '1954'){echo 'selected';};?>> 1954 </option>
          <option value="1955" <?php if($mes_a == '1955'){echo 'selected';};?>> 1955 </option>
          <option value="1956" <?php if($mes_a == '1956'){echo 'selected';};?>> 1956 </option>
          <option value="1957" <?php if($mes_a == '1957'){echo 'selected';};?>> 1957 </option>
          <option value="1958" <?php if($mes_a == '1958'){echo 'selected';};?>> 1958 </option>
          <option value="1959" <?php if($mes_a == '1959'){echo 'selected';};?>> 1959 </option>
          <option value="1960" <?php if($mes_a == '1960'){echo 'selected';};?>> 1960 </option>
          <option value="1961" <?php if($mes_a == '1961'){echo 'selected';};?>> 1961 </option>
          <option value="1962" <?php if($mes_a == '1962'){echo 'selected';};?>> 1962 </option>
          <option value="1963" <?php if($mes_a == '1963'){echo 'selected';};?>> 1963 </option>
          <option value="1964" <?php if($mes_a == '1964'){echo 'selected';};?>> 1964 </option>
          <option value="1965" <?php if($mes_a == '1965'){echo 'selected';};?>> 1965 </option>
          <option value="1966" <?php if($mes_a == '1966'){echo 'selected';};?>> 1966 </option>
          <option value="1967" <?php if($mes_a == '1967'){echo 'selected';};?>> 1967 </option>
          <option value="1968" <?php if($mes_a == '1968'){echo 'selected';};?>> 1968 </option>
          <option value="1969" <?php if($mes_a == '1969'){echo 'selected';};?>> 1969 </option>
          <option value="1970" <?php if($mes_a == '1970'){echo 'selected';};?>> 1970 </option>
          <option value="1971" <?php if($mes_a == '1971'){echo 'selected';};?>> 1971 </option>
          <option value="1972" <?php if($mes_a == '1972'){echo 'selected';};?>> 1972 </option>
          <option value="1973" <?php if($mes_a == '1973'){echo 'selected';};?>> 1973 </option>
          <option value="1974" <?php if($mes_a == '1974'){echo 'selected';};?>> 1974 </option>
          <option value="1975" <?php if($mes_a == '1975'){echo 'selected';};?>> 1975 </option>
          <option value="1976" <?php if($mes_a == '1976'){echo 'selected';};?>> 1976 </option>
          <option value="1977" <?php if($mes_a == '1977'){echo 'selected';};?>> 1977 </option>
          <option value="1978" <?php if($mes_a == '1978'){echo 'selected';};?>> 1978 </option>
          <option value="1979" <?php if($mes_a == '1979'){echo 'selected';};?>> 1979 </option>
          <option value="1980" <?php if($mes_a == '1980' || $mes_ac == ''){echo 'selected';};?>> 1980 </option>
          <option value="1981" <?php if($mes_a == '1981'){echo 'selected';};?>> 1981 </option>
          <option value="1982" <?php if($mes_a == '1982'){echo 'selected';};?>> 1982 </option>
          <option value="1983" <?php if($mes_a == '1983'){echo 'selected';};?>> 1983 </option>
          <option value="1984" <?php if($mes_a == '1984'){echo 'selected';};?>> 1984 </option>
          <option value="1985" <?php if($mes_a == '1985'){echo 'selected';};?>> 1985 </option>
          <option value="1986" <?php if($mes_a == '1986'){echo 'selected';};?>> 1986 </option>
          <option value="1987" <?php if($mes_a == '1987'){echo 'selected';};?>> 1987 </option>
          <option value="1988" <?php if($mes_a == '1988'){echo 'selected';};?>> 1988 </option>
          <option value="1989" <?php if($mes_a == '1989'){echo 'selected';};?>> 1989 </option>
          <option value="1990" <?php if($mes_a == '1990'){echo 'selected';};?>> 1990 </option>
          <option value="1991" <?php if($mes_a == '1991'){echo 'selected';};?>> 1991 </option>
          <option value="1992" <?php if($mes_a == '1992'){echo 'selected';};?>> 1992 </option>
          <option value="1993" <?php if($mes_a == '1993'){echo 'selected';};?>> 1993 </option>
          <option value="1994" <?php if($mes_a == '1994'){echo 'selected';};?>> 1994 </option>
          <option value="1995" <?php if($mes_a == '1995'){echo 'selected';};?>> 1995 </option>
          <option value="1996" <?php if($mes_a == '1996'){echo 'selected';};?>> 1996 </option>
          <option value="1997" <?php if($mes_a == '1997'){echo 'selected';};?>> 1997 </option>
          <option value="1998" <?php if($mes_a == '1998'){echo 'selected';};?>> 1998 </option>
          <option value="1999" <?php if($mes_a == '1999'){echo 'selected';};?>> 1999 </option>
      </select>
          </div>
      </div>
      <input type="hidden" name="lat_long<?= $cantidad_dom_w?>" id="lat_long<?= $cantidad_dom_w?>" size="40" >
      <!-- <input onclick="valo()" value="averiguar" type="button">--> 
      <div id="map<?= $cantidad_dom_w?>" class="maps_clickeable"></div>
  </div>
  <?php $cantidad_dom_w = $cantidad_dom_w + 1;}; }; ?>
</div>



  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <div>Dependientes</div>
      <input type="hidden" name="numero_dependientes_ant" id="numero_dependientes_ant" value="0"/>
      <input type="hidden" name="numero_dependientes0" id="numero_dependientes0" value="<?= $row["numero_dependientes"]?>"/>
      <select name="numero_dependientes" id="numero_dependientes"  class="hospitalx" onchange="mas_dep()">
          <option value="0" disabled="disabled" selected>Cantidad de Dependientes </option>
          <option value="0" <?php if($row["numero_dependientes"] == '0'){echo 'selected';};?>> 0 </option>
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
    <div class="campb dosporch">
      <label for="textfield"></label>
      <!--<input type="text" name="calles" id="textfield" placeholder="Entre que calles y referencia de domicilio" value="<?php echo $row["calles"];?>"/>-->
    </div>
  </div>


  <div class="campitem-cliente2" id="dependientes_extras">
  <?php $de_ca_m = 0;
  $sql2d= "SELECT * FROM dependientes WHERE cliente='".$id."' ORDER BY id ASC";
  $result2d = mysql_query($sql2d, $conn1);
  while($row2d = mysql_fetch_array($result2d)){
    $de_ca_m = $de_ca_m + 1;
    ?>
        <div id="copydep<?= $de_ca_m ?>">
          <div class="campitem-cliente">
           <div>Dependiente <?= $de_ca_m ?></div>
            <div class="campb">
              <div>Edad</div>
              <input type="text" name="edad<?= $de_ca_m ?>" id="textfield" placeholder="" value="<?php echo $row2d["edad"];?>"/>
            </div>
            <div class="campb dosporch">
              <div>Sexo</div>
              <select name="sexo<?= $de_ca_m ?>"  class="hospitalx">
                <option value="h" <?php if ($row2d["sexo"] == 'h'){echo 'selected';};?>> Hombre </option>
                <option value="m" <?php if ($row2d["sexo"] == 'm'){echo 'selected';};?>> Mujer </option>
              </select>
            </div>
          </div>
        </div>
  <?php };?>
  </div>





  <div class="campitem-cliente">
    <div class="campb">
      <div>Nº personas bajo el mismo techo</div>
      <input type="text" name="num_personas_tech" id="textfield" placeholder="Nº personas bajo el mismo techo" value="<?php echo $row["num_personas_tech"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Alguno de ustedes tiene problemas de salud?</div>
      <!--<input type="text" name="salud_problemas" id="textfield" placeholder="Alguno de ustedes tiene problemas de salud?" value="<?php echo $row["salud_problemas"];?>"/>-->
      <select name="salud_problemas" id="salud_problemas"  class="hospitalx" onchange="fn_salud_problemas()">
        <option value="Si" <?php if($row["salud_problemas"] == 'Si'){echo 'selected';};?>> Si </option>
        <option value="No" <?php if($row["salud_problemas"] == 'No' || $row["salud_problemas"] == ''){echo 'selected';};?>> No </option>
      </select> 
    </div>
  </div>



   <div class="campitem2" id="salud_comentario" style="display:<?php if($row["salud_problemas"] == 'Si'){echo 'block';}else{echo 'none';};?>" >
   <div>Que Problema?</div>    
    <div class="campc">
      <textarea name="salud_comentario"  cols="" rows="" placeholder=""><?php echo $row["salud_comentario"];?></textarea>
      <!--<input type="text" name="salud_comentario" id="textfield" placeholder="Que Problema?" value="<?php echo $row["salud_comentario"];?>"/>-->
    </div>
  </div>





  <?php
      $sql2f = "SELECT * FROM referencias WHERE id='".$row["familiar_id"]."' ORDER BY id ASC";
      $result2f = mysql_query($sql2f, $conn1);
      $row2f = mysql_fetch_array($result2f);
  ?>  
  <input type="hidden" name="familiar_id" value="<?= $row["familiar_id"];?>"/>  
  <div class="campitem-cliente">
    <div class="campb">
        <div>Vive en Casa...</div>
        <!--<input type="text" name="tipo_casa" id="textfield" placeholder="tipo_casa" value="<?php echo $row["tipo_casa"];?>"/>-->
        <select name="tipo_casa" id="tipo_casa"  class="hospitalx" onchange="select_tipo_c()">
          <option value="Propia" <?php if($row["tipo_casa"] == 'Propia'){echo 'selected';};?>> Propia </option>
          <option value="Financiada" <?php if($row["tipo_casa"] == 'Financiada'){echo 'selected';};?>> Financiada </option>
          <option value="Rentada" <?php if($row["tipo_casa"] == 'Rentada'){echo 'selected';};?>> Rentada </option>
          <option value="Familiar" <?php if($row["tipo_casa"] == 'Familiar'){echo 'selected';};?>> De un Familiar </option>
        </select>
    </div>
    <div class="campb dosporch" id="Familiar" style="display:<?php if($row["tipo_casa"] == 'Familiar'){echo 'block';}else{echo 'none';};?>">
     <div>En donde Vive?</div>
     <select name="ref_tipo_ref"  class="hospitalx" onchange="elfamiliar()">
          <option value="familiar_vive_ud" <?php if($row2f["tipo"] == 'familiar_vive_ud'){echo 'selected';};?>> Familiar vive con usted </option>
          <option value="familiar_no_vive_ud" <?php if($row2f["tipo"] == 'familiar_no_vive_ud'){echo 'selected';};?>> Me presta la casa </option>
      </select> 
    </div>
  </div>


  <div class="campitem-cliente" id="Rentada" style="display:<?php if($row["tipo_casa"] == 'Rentada'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Nombre arrendador</div>
      <input type="text" name="arrendador_nombre" id="textfield" placeholder="" value="<?php echo $row["arrendador_nombre"];?>"/>
    </div>
    <div class="campb dosporch">
    <div>Celular arrendador</div>
      <input type="text" name="arrendador_celular" id="textfield" placeholder="" value="<?php echo $row["arrendador_celular"];?>"/>
    </div>
  </div>





  <div class="campitem-cliente" id="Familiar" style="display:<?php if($row["tipo_casa"] == 'Familiar'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Nombre del familiar</div>
      <input type="text" name="familiar_nombre" id="textfield" placeholder="" value="<?php echo $row["familiar_nombre"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Parentesco</div>
      <input type="text" name="familiar_parentesco" id="textfield" placeholder="" value="<?php echo $row["familiar_parentesco"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente" id="Familiar2" style="display:<?php if($row["tipo_casa"] == 'Familiar'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Domicilio del familiar</div>
      <input type="text" name="familiar_domicilio" id="textfield" placeholder="" value="<?php echo $row["familiar_domicilio"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Referencia del domicilio</div>
      <input type="text" name="familiar_referencia_dom" id="textfield" placeholder="" value="<?php echo $row["familiar_referencia_dom"];?>"/>
    </div>
  </div>

<?php };?>



</div>
<!---------------------------------------  FIN PERFIL PERSONAL ------------------------ -->

<?php if($seccion == '2'){?>

<!---------------------------------------  PERFIL LABORAL ------------------------ -->
<div id="perfil_laboral">

<span class="titlecol-ad">Perfil Laboral</span>

  <div class="campitem-cliente2">
    <div class="campb">
      <div>Ocupacion</div>
      <!--<input type="text" name="ocupacion" id="textfield" placeholder="Ocupacion:" value="<?php echo $row["ocupacion"];?>"/>-->
      <select name="ocupacion" id="ocupacion"  class="hospitalx" onchange="ocupafun()">      
        <option value="Empleado" <?php if($row["ocupacion"] == 'Empleado'){echo 'selected';};?>> Empleado </option>
        <option value="Independiente" <?php if($row["ocupacion"] == 'Independiente'){echo 'selected';};?>> Independiente </option>
        <option value="Pensionado" <?php if($row["ocupacion"] == 'Pensionado' || $row["ocupacion"] == ''){echo 'selected';};?>> Pensionado </option>
      </select>
    </div>
    <div class="campb dosporch" id="trab1" style="display: <?php 
    if($row["ocupacion"] == 'Empleado' || $row["ocupacion"] == 'Independiente'){echo 'block';}else{echo 'none';};?>">
      <div>Nombre de la empresa</div>
      <input type="text" name="empresa_nombre" id="textfield" placeholder="" value="<?php echo $row["empresa_nombre"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2" id="trab2" style="display: <?php if($row["ocupacion"] == 'Empleado'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Sector de la Empresa</div>
      <input type="text" name="empresa_sector" id="textfield" placeholder="" value="<?php echo $row["empresa_sector"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Puesto de la Empresa</div>
      <input type="text" name="empresa_puesto" id="textfield" placeholder="" value="<?php echo $row["empresa_puesto"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2" id="trab3" style="display: <?php if($row["ocupacion"] == 'Empleado'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Nombre del Jefe</div>
      <input type="text" name="jefe_nombre" id="textfield" placeholder="" value="<?php echo $row["jefe_nombre"];?>"/>
      
    </div>
    <div class="campb dosporch">
      Celular del Jefe
      <input type="text" name="jefe_celular" id="textfield" placeholder="" value="<?php echo $row["jefe_celular"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2" id="trab4" style="display: <?php 
  if($row["ocupacion"] == 'Empleado' || $row["ocupacion"] == 'Independiente'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Direccion de la Empresa</div>
      <input type="text" name="empresa_direccion" id="textfield" placeholder="" value="<?php echo $row["empresa_direccion"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Referencias de la Direccion</div>
      <input type="text" name="empresa_referencia" id="textfield" placeholder="" value="<?php echo $row["empresa_referencia"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2" id="trab5" style="display: <?php 
  if($row["ocupacion"] == 'Empleado' || $row["ocupacion"] == 'Independiente'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Horario de Trabajo</div>
      <input type="text" name="trabajo_horario" id="textfield" placeholder="" value="<?php echo $row["trabajo_horario"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Hora de Entrada</div>
      <input type="text" name="trabajo_entrada" id="textfield" placeholder="" value="<?php echo $row["trabajo_entrada"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2" id="trab7" style="display: <?php 
  if($row["ocupacion"] == 'Empleado' || $row["ocupacion"] == 'Independiente'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Hora de Salida</div>
      <input type="text" name="trabajo_salida" id="textfield" placeholder="" value="<?php echo $row["trabajo_salida"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Telefono de la Empresa</div>
      <input type="text" name="trabajo_telefono1" id="textfield" placeholder="" value="<?php echo $row["trabajo_telefono1"];?>"/>
    </div>
  </div>

<!--
  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="trabajo_telefono2" id="textfield" placeholder="trabajo_telefono2:" value="<?php echo $row["trabajo_telefono2"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="trabajo_telefono3" id="textfield" placeholder="trabajo_telefono3" value="<?php echo $row["trabajo_telefono3"];?>"/>
    </div>
  </div>
-->

  <div class="campitem-cliente2" id="trab8" style="display: <?php 
  if($row["ocupacion"] == 'Empleado' || $row["ocupacion"] == 'Independiente'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Tiempo de Trabajo en la Empresa</div>
      <input type="text" name="trabajo_tiempo" id="textfield" placeholder="" value="<?php echo $row["trabajo_tiempo"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <!--<input type="text" name="jefe_nombre" id="textfield" placeholder="jefe_nombre" value="<?php echo $row["jefe_nombre"];?>"/>-->
    </div>
  </div>



</div>
<!---------------------------------------  FIN PERFIL LABORAL ------------------------ -->

<?php };if($seccion == '3'){?>

<!---------------------------------------  PERFIL ECONOMICO ------------------------ -->

<div id="perfil_economico">
  

<span class="titlecol-ad">Perfil Economico</span>

  <div class="campitem-cliente2">
    <div class="campb">
      <div>Ganancia promedio al mes, libre de impuestos?</div>
      <input type="text" name="ganancias_mes" id="textfield" placeholder="" value="<?php echo $row["ganancias_mes"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Como te pagan?</div>
      <!--<input type="text" name="pago_tipo" id="textfield" placeholder="Como te pagan? " value="<?php echo $row["pago_tipo"];?>"/>-->

      <select name="pago_tipo"  class="hospitalx">
      <option value="" disabled="disabled" selected>Seleccione</option>
        <option value="Semanal" <?php if($row["pago_tipo"] == 'Semanal'){echo 'selected';};?>> Semanal </option>
        <option value="Quincenal" <?php if($row["pago_tipo"] == 'Quincenal'){echo 'selected';};?>> Quincenal </option>
        <option value="Mensual" <?php if($row["pago_tipo"] == 'Mensual'){echo 'selected';};?>> Mensual </option>
        <option value="Otro" <?php if($row["pago_tipo"] == 'Otro'){echo 'selected';};?>> Otro </option>
      </select>

    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <div>Que días del mes te pagan?</div>
      <input type="text" name="pago_dia" id="textfield" placeholder="" value="<?php echo $row["pago_dia"];?>"/>
     </div>
    <div class="campb dosporch">
      <div>Te Pagan en:</div>
      <!--<input type="text" name="pago_lugar" id="textfield" placeholder="pago_lugar" value="<?php echo $row["pago_lugar"];?>"/>-->
      <select name="pago_lugar" id="pago_lugar"  class="hospitalx" onclick="tipopagofn()">
        <option value="" selected disabled> Seleccione </option>
        <option value="Banco" <?php if($row["pago_lugar"] == 'Banco'){echo 'selected';};?>> Banco </option>
        <option value="Efectivo" <?php if($row["pago_lugar"] == 'Efectivo'){echo 'selected';};?>> Efectivo </option>
      </select>   
    </div>
  </div>


  <div class="campitem-cliente2" id="banco" style="display: <?php if($row["pago_lugar"] == 'Banco'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>En cual Banco?</div>
      <input type="text" name="pago_banco" id="textfield" placeholder="" value="<?php echo $row["pago_banco"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Sucursal o cajero en el que lo cobra</div>
      <input type="text" name="pago_banco_succaj" id="textfield" placeholder="" value="<?php echo $row["pago_banco_succaj"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2" id="efectivo" style="display: <?php if($row["pago_lugar"] == 'Efectivo'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>A que horas?</div>
      <input type="text" name="pago_horario" id="textfield" placeholder="" value="<?php echo $row["pago_horario"];?>"/>
    </div>
    <div class="campb dosporch"><!--
      <div>En donde te lo entregan?</div>
      <input type="text" name="pago_donde" id="textfield" placeholder="" value="<?php echo $row["pago_donde"];?>"/>-->
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <div>Tienes otros ingresos?</div>
      <!--<input type="text" name="otros_ingresos" id="textfield" placeholder="Tienes otros ingresos?" value="<?php echo $row["otros_ingresos"];?>"/>-->
      <select name="otros_ingresos" id="otros_ingresos"  class="hospitalx" onchange="otrosingresosfn()">
        <option value="Si" <?php if($row["otros_ingresos"] == 'Si'){echo 'selected';};?>> Si </option>
        <option value="No" <?php 
        if($row["otros_ingresos"] == 'No' || $row["otros_ingresos"] == ''){echo 'selected';};?>> No </option>
      </select>   
    </div>
    <div class="campb dosporch">      
    </div>
  </div>


  <div class="campitem-cliente2" id="ingext" style="display:<?php if($row["otros_ingresos"] == 'Si'){echo'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Monto mensual libre</div>
      <input type="text" name="otros_ingresos_monto" id="textfield" placeholder="" value="<?php echo $row["otros_ingresos_monto"];?>"/>
    </div>
    <div class="campb dosporch">
      
      <div>Tipo de ingresos</div>
      <input type="text" name="otros_ingresos_tipoingr" id="textfield" placeholder="" value="<?php echo $row["otros_ingresos_tipoingr"];?>"/>
      
    </div>
  </div>


  <div class="campitem">
    <div class="campb">
      <div>Estado civil</div>
       <select name="estado_civil" id="estado_civil"  class="hospitalx" onchange="estado_civilfn()">
        <option value="" disabled="disabled" selected>Seleccione</option>
        <option value="Soltero" <?php if($row["estado_civil"] == 'Soltero'){echo 'selected';};?>> Soltero </option>
        <option value="Casado" <?php if($row["estado_civil"] == 'Casado'){echo 'selected';};?>> Casado </option>
        <option value="Union_Libre" <?php if($row["estado_civil"] == 'Union_Libre'){echo 'selected';};?>> Union Libre </option>
        <option value="Divorciado" <?php if($row["estado_civil"] == 'Divorciado'){echo 'selected';};?>> Divorciado </option>
        <option value="Viudo" <?php if($row["estado_civil"] == 'Viudo'){echo 'selected';};?>> Viudo </option>
      </select> 
    </div> 
    <div class="campb dosporch" id="casado8" style="display:<?php 
  if($row["estado_civil"] == 'Casado' || $row["estado_civil"] == 'Union_Libre'){echo 'block';}else{echo 'none';};?>">
      <div>Nombre de tu pareja</div>
      <input type="text" name="nombre_pareja_pe" id="textfield" value="<?php echo $row["nombre_pareja_pe"];?>"/>
     </div>
  </div>

<input type="hidden" name="id_pareja" id="id_pareja" value="<?php if($row["id_pareja"] != '0'){echo $row["id_pareja"];};?>"/>

  <div class="campitem-cliente2" id="casado1" style="display:<?php 
  if($row["estado_civil"] == 'Casado' || $row["estado_civil"] == 'Union_Libre'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Cuanto gana en promedio al mes tu pareja, libres?</div>
      <input type="text" name="pareja_ganancia" id="textfield" placeholder="" value="<?php echo $row["pareja_ganancia"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Nombre de la empresa donde trabaja</div>
      <input type="text" name="pareja_empresa" id="textfield" placeholder="" value="<?php echo $row["pareja_empresa"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2" id="casado2" style="display:<?php 
  if($row["estado_civil"] == 'Casado' || $row["estado_civil"] == 'Union_Libre'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Sector</div>
      <input type="text" name="pareja_sector" id="textfield" placeholder="" value="<?php echo $row["pareja_sector"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Puesto que desempeña</div>
      <input type="text" name="pareja_puesto" id="textfield" placeholder="" value="<?php echo $row["pareja_puesto"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2" id="casado3" style="display:<?php 
  if($row["estado_civil"] == 'Casado' || $row["estado_civil"] == 'Union_Libre'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Direccion del Trabajo</div>
      <input type="text" name="pareja_direccion" id="textfield" placeholder="" value="<?php echo $row["pareja_direccion"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Referencia para ubicar su trabajo</div>
      <input type="text" name="pareja_referencia" id="textfield" placeholder="" value="<?php echo $row["pareja_referencia"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2" id="casado4" style="display:<?php 
  if($row["estado_civil"] == 'Casado' || $row["estado_civil"] == 'Union_Libre'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Horario de trabajo</div>
      <!--<input type="text" name="pareja_horario" id="textfield" placeholder="pareja_horario:" value="<?php echo $row["pareja_horario"];?>"/>-->
      <select name="pareja_horario"  class="hospitalx">
        <option value="Quebrado" <?php if($row["pareja_horario"] == 'Quebrado'){echo 'selected';};?>> Quebrado </option>
        <option value="Corrido" <?php if($row["pareja_horario"] == 'Corrido'){echo 'selected';};?>> Corrido </option>
      </select> 
    </div>
    <div class="campb dosporch">
      <div>Hora de entrada</div>
      <input type="text" name="pareja_entrada" id="textfield" placeholder="" value="<?php echo $row["pareja_entrada"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2" id="casado5" style="display:<?php 
  if($row["estado_civil"] == 'Casado' || $row["estado_civil"] == 'Union_Libre'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Hora de salida</div>
      <input type="text" name="pareja_salida" id="textfield" placeholder="" value="<?php echo $row["pareja_salida"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Telefono del trabajo</div>
      <input type="text" name="pareja_telefono_trabajo1" id="textfield" placeholder="" value="<?php echo $row["pareja_telefono_trabajo1"];?>"/>
    </div>
  </div>

<!--
  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
    <input type="text" name="pareja_telefono_trabajo2" id="textfield" placeholder="Telefono del trabajo" value="<?php echo $row["pareja_telefono_trabajo2"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="pareja_telefono_trabajo3" id="textfield" placeholder="Telefono del trabajo" value="<?php echo $row["pareja_telefono_trabajo3"];?>"/>
    </div>
  </div>

-->

  <div class="campitem-cliente2" id="casado7" style="display:<?php 
  if($row["estado_civil"] == 'Casado' || $row["estado_civil"] == 'Union_Libre'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Cuanto tiempo lleva trabajando ahi?</div>
      <input type="text" name="pareja_tiempo_trabajo" id="textfield" placeholder="" value="<?php echo $row["pareja_tiempo_trabajo"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <!--<input type="text" name="iiiiiissss" id="textfield" placeholder="iiiiiissss" value="<?php echo $row["iiiiiissss"];?>"/>-->
    </div>
  </div>


  <div class="campitem-cliente2" id="separado1" style="display:<?php 
  if($row["estado_civil"] == 'Divorciado'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Le da una mensualidad a su ex pareja?</div>
      <!--<input type="text" name="parejaex_mensualidad" id="textfield" placeholder="" value="<?php echo $row["parejaex_mensualidad"];?>"/>-->
      <select name="parejaex_mensualidad"  class="hospitalx">
        <option value="Si" <?php if($row["parejaex_mensualidad"] == 'Si'){echo 'selected';};?>> Si </option>
        <option value="No" <?php if($row["parejaex_mensualidad"] == 'No'){echo 'selected';};?>> No </option>
      </select> 
    </div>
    <div class="campb dosporch">
      <div>Que Cantidad?</div>
      <input type="text" name="parejaex_mensualidad_cant" id="textfield" placeholder="" value="<?php echo $row["parejaex_mensualidad_cant"];?>"/>
    </div>
  </div>


  <div class="campitem">
  <div><p>EGRESOS:</div>
    <div class="campb">
      <div>Mensualidad de casa</div>
      <input type="text" name="eg_casa_mensualidad" id="textfield" placeholder="" value="<?php echo $row["eg_casa_mensualidad"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Servicios de la casa</div>
      <input type="text" name="eg_casa_servicios" id="textfield" placeholder="" value="<?php echo $row["eg_casa_servicios"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <div>Alimentacion</div>
      <input type="text" name="eg_alimentacion" id="textfield" placeholder="" value="<?php echo $row["eg_alimentacion"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Escuelas</div>
      <input type="text" name="eg_escuelas" id="textfield" placeholder="" value="<?php echo $row["eg_escuelas"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <div>Mensualidad de carro</div>
      <input type="text" name="eg_carro_mensualidad" id="textfield" placeholder="" value="<?php echo $row["eg_carro_mensualidad"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Gasolina y/o Transportes</div>
      <input type="text" name="eg_transporte" id="textfield" placeholder="" value="<?php echo $row["eg_transporte"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <div>Tarjetas de credito</div>
      <input type="text" name="eg_tagera_credito" id="textfield" placeholder="" value="<?php echo $row["eg_tagera_credito"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Celulares</div>
      <input type="text" name="eg_celulares" id="textfield" placeholder="" value="<?php echo $row["eg_celulares"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      Otros
      <input type="text" name="eg_otros" id="textfield" placeholder="" value="<?php echo $row["eg_otros"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <!--<input type="text" name="iiiiiissss" id="textfield" placeholder="iiiiiissss" value="<?php echo $row["iiiiiissss"];?>"/>-->
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <div>Tienes deudas actuales?</div>
      <select name="deudas_actuales" id="deudas_actuales"  class="hospitalx" onclick="deudas_actualesfn()">
        <option value="Si" <?php if($row["deudas_actuales"] == 'Si'){echo 'selected';};?>> Si </option>
        <option value="No" <?php if($row["deudas_actuales"] == 'No' || $row["deudas_actuales"] == ''){echo 'selected';};?>> No </option>
      </select> 
    </div>
    <div class="campb dosporch"  id="de_act1" style="display:<?php if($row["deudas_actuales"] == 'Si'){echo 'block';}else{echo 'none';};?>">
      <div>Cuantas deudas?</div>
      <select name="deudas_cuantas"  class="hospitalx">
          <option value="0" <?php if($row["deudas_cuantas"] == '0'){echo 'selected';};?>> 0 </option>
          <option value="1" <?php if($row["deudas_cuantas"] == '1'){echo 'selected';};?>> 1 </option>
          <option value="2" <?php if($row["deudas_cuantas"] == '2'){echo 'selected';};?>> 2 </option>
          <option value="3" <?php if($row["deudas_cuantas"] == '3'){echo 'selected';};?>> 3 </option>
          <option value="4" <?php if($row["deudas_cuantas"] == '4'){echo 'selected';};?>> 4 </option>
          <option value="5" <?php if($row["deudas_cuantas"] == '5'){echo 'selected';};?>> 5 </option>
      </select> 
    </div>
  </div>


  <div class="campitem-cliente2" id="de_act2" style="display:<?php if($row["deudas_actuales"] == 'Si'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>A quien le debes?</div>
      <input type="text" name="deudas_aquien" id="textfield" placeholder="" value="<?php echo $row["deudas_aquien"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Cuanto le debes?</div>
      <input type="text" name="deudas_cuanto" id="textfield" placeholder="" value="<?php echo $row["deudas_cuanto"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2" id="de_act3" style="display:<?php if($row["deudas_actuales"] == 'Si'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Cuando abonas mensual?</div>
      <input type="text" name="deudas_abono_mes" id="textfield" placeholder="" value="<?php echo $row["deudas_abono_mes"];?>"/>
    </div>
    <div class="campb dosporch">
    </div>
  </div>


  <div class="campitem">
    <div class="campb">
      <div>Resultado (ingresos - egresos)</div>
      <input type="text" name="resultado" id="textfield" placeholder="" value="<?php echo $row["resultado"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb ">
      <div>De cuanto dinero mensual dispones para cumplir con los pagos de un nuevo crédito?</div>
      <input type="text" name="dinero_disponible" id="textfield" placeholder="" value="<?php echo $row["dinero_disponible"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <div>Has sido cliente de otras financieras?</div>
      <!--<input type="text" name="financieras_otras_cliente" id="textfield" placeholder="iiiiiissss" value="<?php echo $row["financieras_otras_cliente"];?>"/>-->
      <select name="financieras_otras_cliente" id="financieras_otras_cliente"  class="hospitalx" onclick="otrafinan()">
        <option value="Si" <?php if($row["financieras_otras_cliente"] == 'Si'){echo 'selected';};?>> Si </option>
        <option value="No" <?php if($row["financieras_otras_cliente"] == 'No' || $row["financieras_otras_cliente"] == ''){echo 'selected';};?>> No </option>
      </select>    
    </div>
    <div class="campb dosporch"> 
    </div>
  </div>


  <div class="campitem-cliente2" id="financieras_otras_ext" style="display:<?php if($row["financieras_otras_cliente"] == 'Si'){echo 'block';}else{echo 'none';};?>">
    <div class="campb">
      <div>Cual financiera?</div>
      <input type="text" name="financieras_otras_nombre" id="textfield" placeholder="" value="<?php echo $row["financieras_otras_nombre"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Como quedaste?</div>
      <input type="text" name="financieras_otras_quedaste" id="textfield" placeholder="" value="<?php echo $row["financieras_otras_quedaste"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <div>Estas en buró de crédito?</div>
      <select name="estas_buro"  class="hospitalx">
        <option value="Si" <?php if($row["estas_buro"] == 'Si'){echo 'selected';};?>> Si </option>
        <option value="No" <?php if($row["estas_buro"] == 'No' || $row["estas_buro"] == ''){echo 'selected';};?>> No </option>
      </select>
    </div>
    <div class="campb dosporch">
      <div>Por que?</div>
      <input type="text" name="estas_buro_porque" id="textfield" placeholder="" value="<?php echo $row["estas_buro_porque"];?>"/>
    </div>
  </div>


</div>
<!---------------------------------------  FIN PERFIL ECONOMICO ------------------------ -->
<?php }if($seccion == '4'){?>

<!---------------------------------------    PROPIEDADES ------------------------ -->

<div id="propiedades">
  

<span class="titlecol-ad">Propiedades</span>

<div class="campitem-cliente2">  
  <div onclick="mas_carr()">Carro (+)</div>
</div>

<?php 
  $sql2f = "SELECT * FROM carro WHERE cliente='".$id."' ORDER BY id DESC";
  $result2f = mysql_query($sql2f, $conn1);
  $total_registros2f = mysql_num_rows($result2f);
  $cant_carr_act = 0;
?>
<input type="hidden" name="numero_carros" id="numero_carros" value="<?= $total_registros2f?>"/>

<div id="copycarr">


<?php  while($row2f = mysql_fetch_array($result2f)){  $cant_carr_act = $cant_carr_act + 1;?>
<input type="hidden" name="id_carr<?= $cant_carr_act?>" id="id_carr<?= $cant_carr_act?>" value="<?= $row2f["id"];?>"/>

<div id="copycarr<?= $cant_carr_act?>">


  <div class="campitem-cliente2">  
  <div class="tit-carr">Carro <?= $cant_carr_act?></div>
    <div class="campb">
      <div>Marca</div>
      <input type="text" name="marca<?= $cant_carr_act?>" value="<?= $row2f["marca"];?>" id="textfield" />
    </div>
    <div class="campb dosporch">
      <div>Modelo</div>
      <input type="text" name="modelo<?= $cant_carr_act?>" value="<?= $row2f["modelo"];?>" id="textfield"/>
    </div>
  </div>



  <div class="campitem-cliente2">
    <div class="campb">
      <div>Año</div>
      <input type="text" name="year<?= $cant_carr_act?>" value="<?= $row2f["year"];?>" id="textfield"/>
    </div>
    <div class="campb dosporch">
    <div>Propietario</div>
      <select name="propietario<?= $cant_carr_act?>"  class="hospitalx">
        <option value="A_tu_nombre" <?php if($row2f["year"]=='A_tu_nombre' || $row2f["year"]==''){echo 'selected';};?>> A tu nombre </option>
        <option value="Financiado" <?php if($row2f["year"]=='Financiado'){echo 'selected';};?>> Financiado </option>
        <option value="Del_Trabajo" <?php if($row2f["year"]=='Del_Trabajo'){echo 'selected';};?>> Del Trabajo </option>
        <option value="de_Familiar" <?php if($row2f["year"]=='de_Familiar'){echo 'selected';};?>> de un Familiar </option>
      </select>
    </div>
  </div>



  <div class="campitem-cliente2">
    <div class="campb">
      <div>Tipo</div>
      <select name="tipo<?= $cant_carr_act?>"  class="hospitalx">
        <option value="Nacional" <?php if($row2f["tipo"]=='Nacional' || $row2f["tipo"]==''){echo 'selected';};?>> Nacional </option>
        <option value="Importado" <?php if($row2f["tipo"]=='Importado'){echo 'selected';};?>> Importado </option>
        <option value="Americano" <?php if($row2f["tipo"]=='Americano'){echo 'selected';};?>> Americano </option>
      </select>
    </div>
    <div class="campb dosporch">
      <div>Debe multas?</div>
      <select name="multas<?= $cant_carr_act?>"  class="hospitalx">
        <option value="Si" <?php if($row2f["multas"]=='Si'){echo 'selected';};?>> Si</option>
        <option value="No" <?php if($row2f["multas"]=='No' || $row2f["tipo"]==''){echo 'selected';};?>> No </option>
      </select>
    </div>
  </div>



  <div class="campitem-cliente2">
    <div class="campb">
      <div>Cuanto?</div><input type="text" name="cuando<?= $cant_carr_act?>" value="<?= $row2f["cuando"];?>" id="textfield"/>
    </div>
    <div class="campb dosporch">
      <div>Numero de placa</div><input type="text" name="placa<?= $cant_carr_act?>" value="<?= $row2f["placa"];?>" id="textfield"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <div>Numero de serie</div><input type="text" name="num_serie<?= $cant_carr_act?>" value="<?= $row2f["num_serie"];?>" id="textfield"/>
    </div>
    <div class="campb dosporch">
      <div>Comentarios</div><input type="text" name="comentarios<?= $cant_carr_act?>" value="<?= $row2f["comentarios"];?>" id="textfield"/>
    </div>
  </div>


</div>

  <?php };?>
</div>


<!--

  <div class="campitem-cliente2">  
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="marca" id="textfield" placeholder="Marca:" value="<?php echo $row["marca"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="modelo" id="textfield" placeholder="Modelo" value="<?php echo $row["modelo"];?>"/>
    </div>
  </div>



  <div class="campitem-cliente2">
    <div class="campb">
      <input type="text" name="year" id="textfield" placeholder="Año" value="<?php echo $row["year"];?>"/>
    </div>
    <div class="campb dosporch">
      <select name="propietario"  class="hospitalx">
        <option value="" disabled="disabled" selected>Propietario</option>
        <option value="A_tu_nombre" <?php if($row["propietario"] == 'A_tu_nombre'){echo 'selected';};?>> A tu nombre </option>
        <option value="Financiado" <?php if($row["propietario"] == 'Financiado'){echo 'selected';};?>> Financiado </option>
        <option value="Del_Trabajo" <?php if($row["propietario"] == 'Del_Trabajo'){echo 'selected';};?>> Del Trabajo </option>
        <option value="de_Familiar" <?php if($row["propietario"] == 'de_Familiar'){echo 'selected';};?>> de un Familiar </option>
      </select>
    </div>
  </div>



  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <select name="tipo"  class="hospitalx">
        <option value="" disabled="disabled" selected>Tipo</option>
        <option value="Nacional" <?php if($row["tipo"] == 'Nacional'){echo 'selected';};?>> Nacional</option>
        <option value="Importado" <?php if($row["tipo"] == 'Importado'){echo 'selected';};?>> Importado </option>
        <option value="Americano" <?php if($row["tipo"] == 'Americano'){echo 'selected';};?>> Americano </option>
      </select>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <select name="multas"  class="hospitalx">
        <option value="" disabled="disabled" selected>Debe multas?</option>
        <option value="Si" <?php if($row["multas"] == 'Si'){echo 'selected';};?>> Si</option>
        <option value="No" <?php if($row["multas"] == 'No'){echo 'selected';};?>> No </option>
      </select>
    </div>
  </div>



  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="cuando" id="textfield" placeholder="Cuanto?" value="<?php echo $row["cuando"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="placa" id="textfield" placeholder="Numero de placa" value="<?php echo $row["placa"];?>"/>
    </div>
  </div>




  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="num_serie" id="textfield" placeholder="Numero de serie:" value="<?php echo $row["num_serie"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="comentarios" id="textfield" placeholder="Comentarios" value="<?php echo $row["comentarios"];?>"/>
    </div>
  </div>


-->

</div>

<!---------------------------------------  FIN PROPIEDADES ------------------------ -->

<?php };if($seccion == '5'){?>

<!---------------------------------------  FIN REFERENCIAS ------------------------ -->

<div id="referencias">


  

<div class="titlecol-ad" onclick="copy_ref()">REFERENCIAS (+)</div>

<?php 
  $sql2f = "SELECT * FROM referencias WHERE cliente='".$id."' ORDER BY id DESC";
  $result2f = mysql_query($sql2f, $conn1);
  $total_registros2f = mysql_num_rows($result2f);
  $cant_ref_act = 0;
?>
<input type="hidden" name="copy_ref_cant" id="copy_ref_cant" value="<?= $total_registros2f?>"/>

<div id="copy_ref">
<?php  while($row2f = mysql_fetch_array($result2f)){  $cant_ref_act = $cant_ref_act + 1;?>
  
<input type="hidden" name="id_ref<?= $cant_ref_act;?>" id="id_ref<?= $cant_ref_act;?>" value="<?= $row2f["id"];?>"/>

<div id="copy_ref<?= $cant_ref_act;?>">
  
  <div class="campitem-cliente2">
    <div class="campb">
    <div>Tipo</div>
      <select name="ref_tipo<?= $cant_ref_act;?>"  class="hospitalx" onchange="elfamiliar('<?= $cant_ref_act;?>')">
          <option value="familiar_vive_ud" <?php if($row2f["tipo"] == 'familiar_vive_ud'){echo 'selected';};?>> Familiar que vive con usted </option>
          <option value="familiar_no_vive_ud" <?php if($row2f["tipo"] == 'familiar_no_vive_ud'){echo 'selected';};?>> Familiar que no vive con usted </option>
          <option value="comp_trabajo" <?php if($row2f["tipo"] == 'comp_trabajo'){echo 'selected';};?>> Compañero de Trabajo </option>
          <option value="amigo" <?php if($row2f["tipo"] == 'amigo'){echo 'selected';};?>> Amigo </option>
      </select> 
    </div>
    <div class="campb dosporch" id="ref_parentesco<?= $cant_ref_act;?>"  style="display:block;">
      <div>Parentesco</div>
      <input type="text" name="ref_familiar_parentesco<?= $cant_ref_act;?>" value="<?= $row2f["parentesco"]?>" id="textfield" />
    </div>
  </div>

  <div class="campitem-cliente2">
    <div class="campb">
      <div>Nombre</div>
      <input type="text" name="ref_familiar<?= $cant_ref_act;?>" value="<?= $row2f["nombre"]?>" id="textfield" />
    </div>
    <div class="campb dosporch">
      <div>Domicilio</div>
      <input type="text" name="ref_familiar_domicil<?= $cant_ref_act;?>" value="<?= $row2f["domicilio"]?>" id="textfield" />
    </div>
  </div>

  <div class="campitem-cliente2 copy_ref0">
    <div class="campb">
      <div>Celular</div>
      <input type="text" name="ref_familiar_celular<?= $cant_ref_act;?>" value="<?= $row2f["celular"]?>" id="textfield"/>
    </div>
    <div class="campb dosporch">
      <div>Telefono</div>
      <input type="text" name="ref_familiar_telefono<?= $cant_ref_act;?>" value="<?= $row2f["telefono"]?>" id="textfield"/>
    </div>
  </div>

</div>
    <?php };?>
</div>
<!----------------------------------- -->

  <div  class="titlecol-ad" onclick="copy_ref_cred()" >REFERENCIAS CREDITICIAS (+)</div>

<?php 
  $sql2f = "SELECT * FROM referencias_crediticias WHERE cliente='".$id."' ORDER BY id DESC";
  $result2f = mysql_query($sql2f, $conn1);
  $total_registros2f = mysql_num_rows($result2f);
  $cant_ref_act = 0;
?>
  <input type="hidden" name="copy_refc_cant" id="copy_refc_cant" value="<?= $total_registros2f;?>"/>

<div id="copy_ref_c">
<?php  while($row2f = mysql_fetch_array($result2f)){  $cant_ref_act = $cant_ref_act + 1;?>
  
<input type="hidden" name="id_refc<?= $cant_ref_act;?>" id="id_refc<?= $cant_ref_act;?>" value="<?= $row2f["id"];?>"/>

<div id="copy_ref_c<?= $cant_ref_act;?>" >
  
  <div class="campitem-cliente2">
    <div class="tit-carr">Referencia Crediticia <?= $cant_ref_act;?></div>
    <div class="campb">
      <div>Numero de tarjeta</div>
      <input type="text" name="num_tarjeta<?= $cant_ref_act;?>" value="<?= $row2f["num_tarjeta"];?>" id="textfield" />
    </div>
    <div class="campb dosporch">
      <div>Institucion</div>
      <input type="text" name="institucion<?= $cant_ref_act;?>" value="<?= $row2f["institucion"];?>" id="textfield" />
    </div>
  </div>

  <div class="campitem-cliente2 copy_ref0">
    <div class="campb">
      <div>Limite de crédito exacto</div>
      <input type="text" name="limite_credito<?= $cant_ref_act;?>" value="<?= $row2f["limite_credito"];?>" id="textfield" />
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
    </div>
  </div>

</div>
    <?php };?>
  </div>
<!--

  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="num_tarjeta" id="textfield" placeholder="Numero de tarjeta" value="<?php echo $row["num_tarjeta"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="institucion" id="textfield" placeholder="Institucion" value="<?php echo $row["institucion"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="limite_credito" id="textfield" placeholder="Limite de crédito exacto" value="<?php echo $row["limite_credito"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
    </div>
  </div>
-->




</div>

<!---------------------------------------  FIN REFERENCIAS ------------------------ -->

<?php };if($seccion == '6'){?>
<!---------------------------------------   ANALISIS DE CLIENTE ------------------------ -->

<div id="analisis_cliente">

<span class="titlecol-ad">ANALISIS DE CLIENTE</span>


  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <!--<input type="text" name="riesgo" id="textfield" placeholder="Riesgo" value="<?php echo $row["riesgo"];?>"/>-->
      <select name="riesgo"  class="hospitalx">
        <option value="" disabled="disabled" selected>Riesgo</option>
        <option value="Alto" <?php if($row["riesgo"] == 'Alto'){echo 'selected';};?>> Si</option>
        <option value="Bajo" <?php if($row["riesgo"] == 'Bajo'){echo 'selected';};?>> No </option>
      </select>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="google" id="textfield" placeholder="Google" value="<?php echo $row["google"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="buro_credito" id="textfield" placeholder="Buró de crédito" value="<?php echo $row["buro_credito"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="linea_credito" id="textfield" placeholder="Linea de crédito" value="<?php echo $row["linea_credito"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="buro_interno" id="textfield" placeholder="Buró interno:" value="<?php echo $row["buro_interno"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <!--<input type="text" name="papeles_carro" id="textfield" placeholder="Papeles carro" value="<?php echo $row["papeles_carro"];?>"/>-->
      <select name="papeles_carro"  class="hospitalx">
        <option value="" disabled="disabled" selected>Papeles carro</option>
        <option value="Si" <?php if($row["papeles_carro"] == 'Si'){echo 'selected';};?>> Si</option>
        <option value="No" <?php if($row["papeles_carro"] == 'No'){echo 'selected';};?>> No </option>
      </select>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="aval" id="textfield" placeholder="Aval" value="<?php echo $row["aval"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="comentarios_analisis" id="textfield" placeholder="Comentarios" value="<?php echo $row["comentarios_analisis"];?>"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="observaciones_grales" id="textfield" placeholder="Observaciones:" value="<?php echo $row["observaciones_grales"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <!--<input type="text" name="iiiiiissss" id="textfield" placeholder="iiiiiissss" value="<?php echo $row["iiiiiissss"];?>"/>-->
    </div>
  </div>

<!--
  <div class="campitem-cliente2">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="iiiiiissss" id="textfield" placeholder="iiiiiissss:" value="<?php echo $row["iiiiiissss"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="iiiiiissss" id="textfield" placeholder="iiiiiissss" value="<?php echo $row["iiiiiissss"];?>"/>
    </div>
  </div>
-->


</div>

<!---------------------------------------  FIN ANALISIS DE CLIENTE ------------------------ -->


<?php   };  // FIN DE MODIFICAR   ?>
  <div class="cf"></div>
  


  <?php if ($seccion != ''){?>
  <div class="save-btns">
      <input type="submit" name="add"  value="Guardar" class="rax"/> 
      <!--<a href="agregar-cliente.php?tipo=mod&id=<?= $id?>" class="volvercli">Volver</a>-->
  </div>
  
  <?php };?>
  
  
  
  
  
  <div class="cf"></div>
</div>
</form>
<?php //*?/?>



<div id="copydom">
    <div class="campitem-cliente2">
          <div>Domicilio</div>
          <div class="campd">
              <div>Direccion</div>
              <input type="text" name="domicilio" class="hospitalx" placeholder="" value="<?php echo $row["domicilio"];?>"/>
          </div>
          <div class="campd dosporch">
              <div>Entre que calles y referencia de domicilio</div>
              <input type="text" name="calles" class="hospitalx" placeholder="" value="<?php echo $row["calles"];?>"/>
          </div>
          <div class="campd dosporch">
              <div>Desde Cuando vives ahi</div>
              <input type="text" name="desde_cuando" class="hospitalx" placeholder="" value="<?php echo $row["desde_cuando"];?>"/>
        </div>
    </div>
</div>

<div id="copydep">
  <div class="campitem-cliente">
   <div>Dependiente 1</div>
    <div class="campb">
      <div>Edad</div>
      <input type="text" name="edad" id="textfield" placeholder="" value="<?php echo $row["edad"];?>"/>
    </div>
    <div class="campb dosporch">
      <div>Sexo</div>
      <select name="sexo"  class="hospitalx">
        <option value="h"> Hombre </option>
        <option value="m"> Mujer </option>
      </select>
    </div>
  </div>
  <!--<div class="campitem-cliente2" id="dependientes_extras"></div>-->
</div>



<div id="copycarr0" style="display:none;">
  


  <div class="campitem-cliente2">  
  <div class="tit-carr">Carro</div>
    <div class="campb">
      <div>Marca</div>
      <input type="text" name="marca" id="textfield"/>
    </div>
    <div class="campb dosporch">
      <div>Modelo</div>
      <input type="text" name="modelo" id="textfield"/>
    </div>
  </div>



  <div class="campitem-cliente2">
    <div class="campb">
      <div>Año</div>
      <input type="text" name="year" id="textfield"/>
    </div>
    <div class="campb dosporch">
    <div>Propietario</div>
      <select name="propietario"  class="hospitalx">
        <option value="A_tu_nombre" selected> A tu nombre </option>
        <option value="Financiado" > Financiado </option>
        <option value="Del_Trabajo"> Del Trabajo </option>
        <option value="de_Familiar"> de un Familiar </option>
      </select>
    </div>
  </div>



  <div class="campitem-cliente2">
    <div class="campb">
      <div>Tipo</div>
      <select name="tipo"  class="hospitalx">
        <option value="Nacional" selected> Nacional</option>
        <option value="Importado" > Importado </option>
        <option value="Americano" > Americano </option>
      </select>
    </div>
    <div class="campb dosporch">
      <div>Debe multas?</div>
      <select name="multas"  class="hospitalx">
        <option value="Si" > Si</option>
        <option value="No" selected> No </option>
      </select>
    </div>
  </div>



  <div class="campitem-cliente2">
    <div class="campb">
      <div>Cuanto?</div><input type="text" name="cuando" id="textfield"/>
    </div>
    <div class="campb dosporch">
      <div>Numero de placa</div><input type="text" name="placa" id="textfield"/>
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <div>Numero de serie</div><input type="text" name="num_serie" id="textfield"/>
    </div>
    <div class="campb dosporch">
      <div>Comentarios</div><input type="text" name="comentarios" id="textfield"/>
    </div>
  </div>


</div>


<div id="copy_ref0" style="display:none">
  
  <div class="campitem-cliente2">
    <div class="campb">
    <div>Tipo</div>
      <select name="ref_tipo"  class="hospitalx" onchange="elfamiliar()">
          <option value="familiar_vive_ud" <?php if($row["tipo"] == 'familiar_vive_ud'){echo 'selected';};?>> Familiar que vive con usted </option>
          <option value="familiar_no_vive_ud" <?php if($row["tipo"] == 'familiar_no_vive_ud'){echo 'selected';};?>> Familiar que no vive con usted </option>
          <option value="comp_trabajo" <?php if($row["tipo"] == 'comp_trabajo'){echo 'selected';};?>> Compañero de Trabajo </option>
          <option value="amigo" <?php if($row["tipo"] == 'amigo'){echo 'selected';};?>> Amigo </option>
      </select> 
    </div>
    <div class="campb dosporch" id="ref_parentesco" style="display:block;">
      <div>Parentesco</div>
      <input type="text" name="ref_familiar_parentesco" id="textfield" />
    </div>
  </div>


  <div class="campitem-cliente2">
    <div class="campb">
      <div>Nombre</div>
      <input type="text" name="ref_familiar" id="textfield" />
    </div>
    <div class="campb dosporch">
      <div>Domicilio</div>
      <input type="text" name="ref_familiar_domicil" id="textfield" />
    </div>
  </div>


  <div class="campitem-cliente2 copy_ref0">
    <div class="campb">
      <div>Celular</div>
      <input type="text" name="ref_familiar_celular" id="textfield"/>
    </div>
    <div class="campb dosporch">
      <div>Telefono</div>
      <input type="text" name="ref_familiar_telefono" id="textfield"/>
    </div>
  </div>

</div>



<div id="copy_ref_c0" style="display:none;">
  
  <div class="campitem-cliente2">
    <div class="tit-carr">Referencia Crediticia</div>
    <div class="campb">
      <div>Numero de tarjeta</div>
      <input type="text" name="num_tarjeta" id="textfield" />
    </div>
    <div class="campb dosporch">
      <div>Institucion</div>
      <input type="text" name="institucion" id="textfield" />
    </div>
  </div>

  <div class="campitem-cliente2 copy_ref0">
    <div class="campb">
      <div>Limite de crédito exacto</div>
      <input type="text" name="limite_credito" id="textfield" />
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
    </div>
  </div>

</div>



<script>
function elfamiliar(num){
   var id = "ref_tipo" + num;
    var CantDom= document.getElementById(id).value;
    var aid = "ref_parentesco" + num;
    if (CantDom == 'familiar_vive_ud'){
      document.getElementById(aid).style.display = "block";
    }else if (CantDom == 'familiar_no_vive_ud'){
      document.getElementById(aid).style.display = "block";
    }else{
      document.getElementById(aid).style.display = "none";      
    };
}

  function otrafinan(){
    var CantDom= document.getElementById("financieras_otras_cliente").value;
    if (CantDom == 'Si'){
      document.getElementById("financieras_otras_ext").style.display = "block";
    }else if (CantDom == 'No'){
      document.getElementById("financieras_otras_ext").style.display = "none";
    };
  }


  function deudas_actualesfn(){
    var CantDom= document.getElementById("deudas_actuales").value;
    if (CantDom == 'Si'){
      document.getElementById("de_act1").style.display = "block";
      document.getElementById("de_act2").style.display = "block";
      document.getElementById("de_act3").style.display = "block";
    }else if (CantDom == 'No'){
      document.getElementById("de_act1").style.display = "none";
      document.getElementById("de_act2").style.display = "none";
      document.getElementById("de_act3").style.display = "none";
    };
  }


  function estado_civilfn(){
    var CantDom= document.getElementById("estado_civil").value;
    if (CantDom == 'Casado' || CantDom == 'Union_Libre'){
      document.getElementById("casado1").style.display = "block";
      document.getElementById("casado2").style.display = "block";
      document.getElementById("casado3").style.display = "block";
      document.getElementById("casado4").style.display = "block";
      document.getElementById("casado5").style.display = "block";
      document.getElementById("casado7").style.display = "block";
      document.getElementById("casado8").style.display = "block";
      document.getElementById("separado1").style.display = "none";
    }else if (CantDom == 'Divorciado'){      
      document.getElementById("casado1").style.display = "none";
      document.getElementById("casado2").style.display = "none";
      document.getElementById("casado3").style.display = "none";
      document.getElementById("casado4").style.display = "none";
      document.getElementById("casado5").style.display = "none";
      document.getElementById("casado7").style.display = "none";
      document.getElementById("casado8").style.display = "none";
      document.getElementById("separado1").style.display = "block";
    }else {      
      document.getElementById("casado1").style.display = "none";
      document.getElementById("casado2").style.display = "none";
      document.getElementById("casado3").style.display = "none";
      document.getElementById("casado4").style.display = "none";
      document.getElementById("casado5").style.display = "none";
      document.getElementById("casado7").style.display = "none";
      document.getElementById("casado8").style.display = "none";
      document.getElementById("separado1").style.display = "none";
    };
  }

  function otrosingresosfn(){
    var CantDom= document.getElementById("otros_ingresos").value;
    if (CantDom == 'Si'){
      document.getElementById("ingext").style.display = "block";
    }else if (CantDom == 'No'){
      document.getElementById("ingext").style.display = "none";
    };
  }

  function tipopagofn(){
    var CantDom= document.getElementById("pago_lugar").value;
    if (CantDom == 'Efectivo'){
      document.getElementById("banco").style.display = "none";
      document.getElementById("efectivo").style.display = "block";
    }else if (CantDom == 'Banco'){
      document.getElementById("banco").style.display = "block";
      document.getElementById("efectivo").style.display = "none";
    };
  }

  function ocupafun(){
    var CantDom= document.getElementById("ocupacion").value;
    if (CantDom == 'Empleado'){
      document.getElementById("trab1").style.display = "block";
      document.getElementById("trab2").style.display = "block";
      document.getElementById("trab3").style.display = "block";
      document.getElementById("trab4").style.display = "block";
      document.getElementById("trab5").style.display = "block";
      document.getElementById("trab7").style.display = "block";
      document.getElementById("trab8").style.display = "block";
    }else if (CantDom == 'Independiente'){
      document.getElementById("trab1").style.display = "block";
      document.getElementById("trab2").style.display = "none";
      document.getElementById("trab3").style.display = "none";
      document.getElementById("trab4").style.display = "block";
      document.getElementById("trab5").style.display = "block";
      document.getElementById("trab7").style.display = "block";
      document.getElementById("trab8").style.display = "block";
    }else if (CantDom == 'Pensionado'){//Pensionado
      document.getElementById("trab1").style.display = "none";
      document.getElementById("trab2").style.display = "none";
      document.getElementById("trab3").style.display = "none";
      document.getElementById("trab4").style.display = "none";
      document.getElementById("trab5").style.display = "none";
      document.getElementById("trab7").style.display = "none";
      document.getElementById("trab8").style.display = "none";
    };
  }

  function fn_salud_problemas(){
    var CantDom= document.getElementById("salud_problemas").value;
    if (CantDom == 'Si'){
      document.getElementById("salud_comentario").style.display = "block";
    }else{
      document.getElementById("salud_comentario").style.display = "none";      
    };

  }

  function select_tipo_c(){
    var CantDom= document.getElementById("tipo_casa").value;
    if (CantDom == 'Rentada'){
      document.getElementById("Rentada").style.display = "block";
      document.getElementById("Familiar").style.display = "none";
      document.getElementById("Familiar2").style.display = "none";
      document.getElementById("Familiar3").style.display = "none";
    }else if (CantDom == 'Familiar'){
      document.getElementById("Rentada").style.display = "none";
      document.getElementById("Familiar").style.display = "block";
      document.getElementById("Familiar2").style.display = "block";
      document.getElementById("Familiar3").style.display = "block";
    }else {
      document.getElementById("Rentada").style.display = "none";
      document.getElementById("Familiar").style.display = "none";
      document.getElementById("Familiar2").style.display = "none";
      document.getElementById("Familiar3").style.display = "none";
    };
  }

  function mas_dep(){
    var CantDom0=document.getElementById('numero_dependientes').options.selectedIndex;//cuenta cant de domicilios hay
    //var CantDom2=document.getElementById('numero_dependientes').elements[CantDom0].value;
    var CantDom= document.getElementById("numero_dependientes").value;
    CantDom2 = parseInt(CantDom);
    var posAnterior = document.getElementById('numero_dependientes0').value;
    if(posAnterior==''){posAnterior='0';};
    posAnterior = parseInt(posAnterior);
    if (CantDom2 > posAnterior){
          var cantAgregar = CantDom2 - posAnterior;
          var valoragregado = posAnterior + 1;
          for (var i = posAnterior; i < CantDom2; i++) {
              var nuevaid = "copydep" + valoragregado;
              var clonedDiv = $('#copydep').clone(); // Clono
              clonedDiv.attr("id", nuevaid); // Cambio ID
              var segundo_p2 = document.getElementById('dependientes_extras');// Despues de quien lo quiero meter
              $('#dependientes_extras').append(clonedDiv);

              var padre = document.getElementById(nuevaid).getElementsByTagName("div");              
              padre[1].innerHTML = "Dependiente " + valoragregado;// Cambio valor de texto              
              padre[2].getElementsByTagName("input")[0].name = "edad" + valoragregado;// cambio el name de edad              
              padre[4].getElementsByTagName("select")[0].name = "sexo" + valoragregado;// cambio el name de edad

              var valoragregado = valoragregado + 1;
          };
          document.getElementById('numero_dependientes0').value = CantDom2;
    };
    if (CantDom2 < posAnterior){
        var delDesde = CantDom2 + 1;
        for (var i = delDesde + 1; i < posAnterior + 2; i++) {
          var idDesde = "#copydep" + delDesde;
          $(idDesde).remove();
          delDesde = delDesde + 1;
        };
        document.getElementById('numero_dependientes0').value = CantDom2;
        document.getElementById('numero_dependientes_ant').value = "1";
    };
  }
  


function copy_ref(){  
      
    var CantDom=document.getElementById('copy_ref_cant').value;//cuenta cant de domicilios hay
    CantDom2 = parseInt(CantDom);
    var nuevovalor = CantDom2 + 1;
    var nuevaid = "copy_ref" + nuevovalor;

    var clonedDiv = $('#copy_ref0').clone(); // Clono

    clonedDiv.attr("id", nuevaid); // Cambio ID
    var segundo_p2 = document.getElementById('copy_ref');// Despues de quien lo quiero meter
    //$('#copy_ref').append(clonedDiv);//añade al final
    $('#copy_ref').prepend(clonedDiv);//añade al comienzo
    var padre = document.getElementById(nuevaid).getElementsByTagName("div");

    var padre_b = padre[0].getElementsByTagName("div");
    
    //document.getElementById(nuevaid).getElementsByTagName("div")[1].innerHTML = "Carro " + nuevovalor;// Cambio texto    
    var js = "elfamiliar('"+ nuevovalor +"');";
    document.getElementById(nuevaid).getElementsByTagName("select")[0].setAttribute("onchange", js);

    document.getElementById(nuevaid).getElementsByTagName("div")[3].id = "ref_parentesco" + nuevovalor;

    document.getElementById(nuevaid).getElementsByTagName("select")[0].name = "ref_tipo" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("select")[0].id = "ref_tipo" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[0].name = "ref_familiar_parentesco" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[1].name = "ref_familiar" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[2].name = "ref_familiar_domicil" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[3].name = "ref_familiar_celular" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[4].name = "ref_familiar_telefono" + nuevovalor;

    document.getElementById(nuevaid).style.display = "block";

    document.getElementById('copy_ref_cant').value = nuevovalor;

}


 
  



  


function copy_ref_cred(){  
      
    var CantDom=document.getElementById('copy_refc_cant').value;//cuenta cant de domicilios hay
    CantDom2 = parseInt(CantDom);
    var nuevovalor = CantDom2 + 1;
    var nuevaid = "copy_ref_c" + nuevovalor;

    var clonedDiv = $('#copy_ref_c0').clone(); // Clono

    clonedDiv.attr("id", nuevaid); // Cambio ID
    var segundo_p2 = document.getElementById('copy_ref_c');// Despues de quien lo quiero meter
    $('#copy_ref_c').prepend(clonedDiv);
    var padre = document.getElementById(nuevaid).getElementsByTagName("div");

    var padre_b = padre[0].getElementsByTagName("div");
    document.getElementById(nuevaid).getElementsByTagName("div")[1].innerHTML = "Referencia Crediticia " + nuevovalor;// Cambio texto    
    document.getElementById(nuevaid).getElementsByTagName("div")[3].id = "ref_parentesco" + nuevovalor;

    document.getElementById(nuevaid).getElementsByTagName("input")[0].name = "num_tarjeta" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[1].name = "institucion" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[2].name = "limite_credito" + nuevovalor;

    document.getElementById(nuevaid).style.display = "block";

    document.getElementById('copy_refc_cant').value = nuevovalor;

}


 
  


function mas_carr(){  
      
    var CantDom=document.getElementById('numero_carros').value;//cuenta cant de domicilios hay
    CantDom2 = parseInt(CantDom);
    var nuevovalor = CantDom2 + 1;
    var nuevaid = "copycarr" + nuevovalor;

    var clonedDiv = $('#copycarr0').clone(); // Clono

    clonedDiv.attr("id", nuevaid); // Cambio ID
    var segundo_p2 = document.getElementById('copycarr');// Despues de quien lo quiero meter
    $('#copycarr').append(clonedDiv);
    var padre = document.getElementById(nuevaid).getElementsByTagName("div");

    var padre_b = padre[0].getElementsByTagName("div");
    
    document.getElementById(nuevaid).getElementsByTagName("div")[1].innerHTML = "Carro " + nuevovalor;// Cambio texto    

    document.getElementById(nuevaid).getElementsByTagName("input")[0].name = "marca" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[1].name = "modelo" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[2].name = "year" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[3].name = "cuando" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[4].name = "placa" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[5].name = "num_serie" + nuevovalor;
    document.getElementById(nuevaid).getElementsByTagName("input")[6].name = "comentarios" + nuevovalor;

    document.getElementById(nuevaid).style.display = "block";

    document.getElementById('numero_carros').value = nuevovalor;

}


  function mas_dom(){  
      
    var CantDom=document.getElementById('numero_domicilios').value;//cuenta cant de domicilios hay
    CantDom2 = parseInt(CantDom);
    var nuevovalor = CantDom2 + 1;
    var nuevaid = "copydom" + nuevovalor;

    var clonedDiv = $('#copydom').clone(); // Clono


    clonedDiv.attr("id", nuevaid); // Cambio ID
    var segundo_p2 = document.getElementById('domicilios_extras');// Despues de quien lo quiero meter
    $('#domicilios_extras').append(clonedDiv);
    var padre = document.getElementById(nuevaid).getElementsByTagName("div");
    var padre_b = padre[0].getElementsByTagName("div");
    padre_b[0].innerHTML = "Domicilio " + nuevovalor;// Cambio valor de texto
  

    document.getElementById(nuevaid).getElementsByTagName("input")[0].name = "domicilio" + nuevovalor;// cambio el name de domicilio
    document.getElementById(nuevaid).getElementsByTagName("input")[1].name = "calles" + nuevovalor;// cambio el name de calles
    document.getElementById(nuevaid).getElementsByTagName("input")[2].name = "desde_cuando" + nuevovalor;// cambio el name de desde_cuando

    document.getElementById('numero_domicilios').value = nuevovalor;
  }
</script>
<script type="text/javascript" src="./jquery.js"></script>
</body>
</html>

<?php

		mysql_close($conn1);
	}
else{
	header("location: login.php");
	};
	?>