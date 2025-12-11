<?php
// Habilitar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir modelos con rutas absolutas desde la raíz del proyecto
require_once __DIR__ . "/../models/msosal.php"; 
require_once __DIR__ . "/../models/mdetsal.php";
require_once __DIR__ . "/../models/mubi.php";
require_once __DIR__ . "/../models/musu.php";
require_once __DIR__ . "/../models/memp.php";
require_once __DIR__ . "/../models/mprod.php";

// Instanciar modelos
$msosal  = new Msosal();
$mdetsal = new Mdetsal();
$mubi    = new Mubi();
$musu    = new Musu();
$memp    = new Memp();
$mprod   = new Mprod();

// Capturar parámetros
$idsal  = isset($_REQUEST['idsal'])  ? $_REQUEST['idsal']  : NULL;
$fecsal = isset($_POST['fecsal'])    ? $_POST['fecsal']    : date('Y-m-d');
$tpsal  = isset($_POST['tpsal'])     ? $_POST['tpsal']     : NULL;
$idemp  = isset($_POST['idemp'])     ? $_POST['idemp']     : NULL;
$idusu  = isset($_POST['idusu'])     ? $_POST['idusu']     : NULL;
$idubi  = isset($_POST['idubi'])     ? $_POST['idubi']     : NULL;
$refdoc = isset($_POST['refdoc'])    ? $_POST['refdoc']    : NULL;
$estsal = isset($_POST['estsal'])    ? $_POST['estsal']    : 'Pendiente';
$ope    = isset($_REQUEST['ope'])    ? $_REQUEST['ope']    : NULL;

// Variables para detalle
$iddet   = isset($_REQUEST['iddet'])   ? $_REQUEST['iddet']   : NULL;
$idprod  = isset($_POST['idprod'])     ? $_POST['idprod']     : NULL;
$cantdet = isset($_POST['cantdet'])    ? $_POST['cantdet']    : NULL;
$vundet  = isset($_POST['vundet'])     ? $_POST['vundet']     : NULL;
$idlote  = isset($_POST['idlote'])     ? $_POST['idlote']     : NULL;
$delete  = isset($_REQUEST['delete'])  ? $_REQUEST['delete']  : NULL;

$dtOne = NULL;
$detalles = [];
$cab = [];

// ===============================================================
//  CARGAR DATOS BÁSICOS
// ===============================================================
$ubi  = $mubi->getAll();      // Ubicaciones (almacenes)
$emp  = $memp->getAll();      // Empresas
$usu  = $musu->getAll();      // Usuarios
$productos = $mprod->getAll(); // Productos (sin stock por ahora)
$almacenes = $mubi->getAll(); // Almacenes (usando ubicaciones)

// ===============================================================
//  OPERACIONES SOBRE SALIDA (CABECERA)
// ===============================================================

if ($ope == "SaVe" && $idsal) {
    // Edición de salida
    $msosal->setIdsal($idsal);
    $msosal->setFecsal($fecsal);
    $msosal->setTpsal($tpsal);
    $msosal->setIdemp($idemp);
    $msosal->setIdusu($idusu);
    $msosal->setIdubi($idubi);
    $msosal->setRefdoc($refdoc);
    $msosal->setEstsal($estsal);
    
    if($msosal->edit()){
        $_SESSION['mensaje'] = "Salida actualizada correctamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la salida";
        $_SESSION['tipo_mensaje'] = "danger";
    }

} elseif ($ope == "SaVe" && !$idsal) {
    // Nueva salida
    $msosal->setFecsal($fecsal);
    $msosal->setTpsal($tpsal);
    $msosal->setIdemp($idemp);
    $msosal->setIdusu($idusu);
    $msosal->setIdubi($idubi);
    $msosal->setRefdoc($refdoc);
    $msosal->setEstsal($estsal);
    
    $newId = $msosal->save();
    if($newId){
        $idsal = $newId;
        $_SESSION['mensaje'] = "Salida creada correctamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al crear la salida";
        $_SESSION['tipo_mensaje'] = "danger";
    }
}

// ===============================================================
//  ELIMINAR SALIDA
// ===============================================================

if ($ope == "eLi" && $idsal) {
    $msosal->setIdsal($idsal);
    if($msosal->del()){
        $_SESSION['mensaje'] = "Salida eliminada correctamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar la salida";
        $_SESSION['tipo_mensaje'] = "danger";
    }
}

// ===============================================================
//  EDITAR → cargar un registro de salida
// ===============================================================

if ($ope == "eDi" && $idsal) {
    $msosal->setIdsal($idsal);
    $dtOne = $msosal->getOne();
}

// ===============================================================
//  OPERACIONES SOBRE DETALLE DE SALIDA
// ===============================================================

// GUARDAR DETALLE
if ($ope == "save" && $idsal && $idprod && $cantdet) {
    // Calcular total
    $totdet = $cantdet * ($vundet ?? 0);
    
    $mdetsal->setIdemp($idemp ?? 1);
    $mdetsal->setIdsal($idsal);
    $mdetsal->setIdprod($idprod);
    $mdetsal->setCantdet($cantdet);
    $mdetsal->setVundet($vundet ?? 0);
    $mdetsal->setTotdet($totdet);
    $mdetsal->setIdlote($idlote ?? NULL);
    $mdetsal->setIdmov(NULL);
    
    if($mdetsal->save()){
        $_SESSION['mensaje'] = "Producto agregado a la salida";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al agregar el producto";
        $_SESSION['tipo_mensaje'] = "danger";
    }
}

// ELIMINAR DETALLE
if ($delete && $idsal) {
    $mdetsal->setIddet($delete);
    if($mdetsal->del()){
        $_SESSION['mensaje'] = "Producto eliminado de la salida";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el producto";
        $_SESSION['tipo_mensaje'] = "danger";
    }
}

// ===============================================================
//  FINALIZAR SALIDA
// ===============================================================
if ($ope == "Fin" && $idsal) {
    $msosal->setIdsal($idsal);
    $msosal->setEstsal('Procesada');
    
    // Solo actualizar el estado
    $sql = "UPDATE solsalida SET estsal = 'Procesada' WHERE idsal = :idsal";
    $modelo = new conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(':idsal', $idsal);
    
    if($result->execute()){
        $_SESSION['mensaje'] = "Salida finalizada correctamente";
        $_SESSION['tipo_mensaje'] = "success";
        // Limpiar idsal para que redirija al listado
        $idsal = null;
    } else {
        $_SESSION['mensaje'] = "Error al finalizar la salida";
        $_SESSION['tipo_mensaje'] = "danger";
    }
}

// ===============================================================
//  CARGAR DATOS PARA LA VISTA
// ===============================================================

// Si hay idsal, cargar cabecera y detalles
if ($idsal) {
    $msosal->setIdsal($idsal);
    $cab = $msosal->getOne();
    $detalles = $msosal->getDetalles();
}

// LISTA GENERAL DE SALIDAS
$dtAll = $msosal->getAll();

// Variable para compatibilidad con vsosal
$idsol = $idsal;

?>
