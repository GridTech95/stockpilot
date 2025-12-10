<?php
require_once('models/mlote.php');
require_once('models/mprod.php');

$mlote = new Mlote();
$mprod = new Mprod();

// ===== Variables =====
$idlote   = isset($_REQUEST['idlote']) ? $_REQUEST['idlote'] : NULL;
$idprod   = isset($_POST['idprod']) ? $_POST['idprod'] : NULL;
$codlot   = isset($_POST['codlot']) ? $_POST['codlot'] : NULL; 
$fecing   = isset($_POST['fecing']) ? $_POST['fecing'] : NULL;
$fecven   = isset($_POST['fecven']) ? $_POST['fecven'] : NULL;
$cantini  = isset($_POST['cantini']) ? $_POST['cantini'] : NULL;
$cantact  = isset($_POST['cantact']) ? $_POST['cantact'] : NULL;
$cstuni   = isset($_POST['cstuni']) ? $_POST['cstuni'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$dtOne = NULL;

// Página destino
$pg = isset($_GET['pg']) ? $_GET['pg'] : 'lote';

// Set ID
$mlote->setIdlote($idlote);

if ($ope == "save") {

    $mlote->setIdprod($idprod);
    $mlote->setCodlot($codlot);
    $mlote->setFecing($fecing);
    $mlote->setFecven($fecven);
    $mlote->setCantini($cantini);
    $mlote->setCantact($cantact);
    $mlote->setCstuni($cstuni);
    
    if (!$idlote) {
        $mlote->save();
        echo "<script>window.location.href='home.php?pg=$pg&msg=saved';</script>";
        exit;
    } else {
        $mlote->edit();
        echo "<script>window.location.href='home.php?pg=$pg&msg=updated';</script>";
        exit;
    }
}

if ($ope == "eli" && $idlote) {
    $mlote->del();
    echo "<script>window.location.href='home.php?pg=$pg&msg=deleted';</script>";
    exit;
}

if ($ope == "edi" && $idlote) {
    $dtOne = $mlote->getOne();
}

// Listados
$dtAll  = $mlote->getAll();
$productos = $mprod->getAll(); // Para desplegar productos en dropdown

?>
