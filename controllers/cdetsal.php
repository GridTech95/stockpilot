<?php
require_once "models/mdetsal.php";

// Capturar parámetros
$iddet   = isset($_REQUEST['iddet'])   ? $_REQUEST['iddet']   : NULL;
$idemp   = isset($_POST['idemp'])      ? $_POST['idemp']      : NULL;
$idsal   = isset($_POST['idsal'])      ? $_POST['idsal']      : NULL;
$idprod  = isset($_POST['idprod'])     ? $_POST['idprod']     : NULL;
$cantdet = isset($_POST['cantdet'])    ? $_POST['cantdet']    : NULL;
$vundet  = isset($_POST['vundet'])     ? $_POST['vundet']     : NULL;
$idlote  = isset($_POST['idlote'])     ? $_POST['idlote']     : NULL;
$idmov   = isset($_POST['idmov'])      ? $_POST['idmov']      : NULL;
$ope     = isset($_REQUEST['ope'])     ? $_REQUEST['ope']     : NULL;
$delete  = isset($_REQUEST['delete'])  ? $_REQUEST['delete']  : NULL;

// Instanciar modelo
$mdetsal = new Mdetsal();

$dtOne = NULL;

// ===============================================================
//  GUARDAR NUEVO DETALLE
// ===============================================================

if ($ope == "save" && !$iddet) {
    $mdetsal->setIdemp($idemp);
    $mdetsal->setIdsal($idsal);
    $mdetsal->setIdprod($idprod);
    $mdetsal->setCantdet($cantdet);
    $mdetsal->setVundet($vundet);
    $mdetsal->setIdlote($idlote);
    $mdetsal->setIdmov($idmov);
    
    if($mdetsal->save()){
        $_SESSION['mensaje'] = "Detalle guardado correctamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al guardar el detalle";
        $_SESSION['tipo_mensaje'] = "danger";
    }
}

// ===============================================================
//  EDITAR DETALLE EXISTENTE
// ===============================================================

if ($ope == "save" && $iddet) {
    $mdetsal->setIddet($iddet);
    $mdetsal->setIdemp($idemp);
    $mdetsal->setIdsal($idsal);
    $mdetsal->setIdprod($idprod);
    $mdetsal->setCantdet($cantdet);
    $mdetsal->setVundet($vundet);
    $mdetsal->setIdlote($idlote);
    $mdetsal->setIdmov($idmov);
    
    if($mdetsal->edit()){
        $_SESSION['mensaje'] = "Detalle actualizado correctamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el detalle";
        $_SESSION['tipo_mensaje'] = "danger";
    }
}

// ===============================================================
//  ELIMINAR DETALLE
// ===============================================================

if ($delete) {
    $mdetsal->setIddet($delete);
    if($mdetsal->del()){
        $_SESSION['mensaje'] = "Detalle eliminado correctamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el detalle";
        $_SESSION['tipo_mensaje'] = "danger";
    }
}

// ===============================================================
//  CARGAR UN DETALLE PARA EDITAR
// ===============================================================

if ($ope == "eDi" && $iddet) {
    $mdetsal->setIddet($iddet);
    $dtOne = $mdetsal->getOne();
}

// ===============================================================
//  LISTA GENERAL DE DETALLES
// ===============================================================

$dtAll = $mdetsal->getAll();

?>
