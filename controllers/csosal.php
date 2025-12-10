<?php
include("models/msosal.php"); 
include("models/mubi.php");        // si manejas ubicaciones (almacén)
include("models/musu.php");    // si usas usuario
include("models/memp.php");    // empresa

$msalida = new Msalida();
$mubi    = new Mubi();
$musu    = new Musuario();
$memp    = new Mempresa();

$idsal  = isset($_REQUEST['idsal'])  ? $_REQUEST['idsal']  : NULL;
$fecsal = isset($_POST['fecsal'])    ? $_POST['fecsal']    : NULL;
$tpsal  = isset($_POST['tpsal'])     ? $_POST['tpsal']     : NULL;
$idemp  = isset($_POST['idemp'])     ? $_POST['idemp']     : NULL;
$idusu  = isset($_POST['idusu'])     ? $_POST['idusu']     : NULL;
$idubi  = isset($_POST['idubi'])     ? $_POST['idubi']     : NULL;
$refdoc = isset($_POST['refdoc'])    ? $_POST['refdoc']    : NULL;
$estado = isset($_POST['estado'])    ? $_POST['estado']    : NULL;
$ope    = isset($_REQUEST['ope'])    ? $_REQUEST['ope']    : NULL;

$dtOne = NULL;

// ===============================================================
//  CARGAR DATOS PARA SELECTS
// ===============================================================
$ubi  = $mubi->getAll();      // Ubicaciones (almacenes)
$emp  = $memp->getAll();      // Empresas
$usu  = $musu->getAll();      // Usuarios

$msalida->setIdsal($idsal);

// ===============================================================
//  GUARDAR O EDITAR
// ===============================================================

if ($ope == "SaVe" && $idsal) {
    // Edición
    $msalida->setFecsal($fecsal);
    $msalida->setTpsal($tpsal);
    $msalida->setIdemp($idemp);
    $msalida->setIdusu($idusu);
    $msalida->setIdubi($idubi);
    $msalida->setRefdoc($refdoc);
    $msalida->setEstado($estado);
    $msalida->edit();

} elseif ($ope == "SaVe" && !$idsal) {
    // Nuevo registro
    $msalida->setFecsal($fecsal);
    $msalida->setTpsal($tpsal);
    $msalida->setIdemp($idemp);
    $msalida->setIdusu($idusu);
    $msalida->setIdubi($idubi);
    $msalida->setRefdoc($refdoc);
    $msalida->setEstado($estado ?? "Creada");
    $msalida->save();
}

// ===============================================================
//  ELIMINAR
// ===============================================================

if ($ope == "eLi" && $idsal) {
    $msalida->del();
}

// ===============================================================
//  EDITAR → cargar un registro
// ===============================================================

if ($ope == "eDi" && $idsal) {
    $dtOne = $msalida->getOne();
}

// ===============================================================
//  LISTA GENERAL
// ===============================================================

$dtAll = $msalida->getAll();

?>
