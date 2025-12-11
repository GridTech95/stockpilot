<?php
class Mdetsal {

    private $iddet;
    private $idemp;
    private $idsal;
    private $idprod;
    private $cantdet;
    private $vundet;
    private $totdet;
    private $idlote;
    private $idmov;

    // GETTERS
    function getIddet(){ return $this->iddet; }
    function getIdemp(){ return $this->idemp; }
    function getIdsal(){ return $this->idsal; }
    function getIdprod(){ return $this->idprod; }
    function getCantdet(){ return $this->cantdet; }
    function getVundet(){ return $this->vundet; }
    function getTotdet(){ return $this->totdet; }
    function getIdlote(){ return $this->idlote; }
    function getIdmov(){ return $this->idmov; }

    // SETTERS
    function setIddet($v){ $this->iddet = $v; }
    function setIdemp($v){ $this->idemp = $v; }
    function setIdsal($v){ $this->idsal = $v; }
    function setIdprod($v){ $this->idprod = $v; }
    function setCantdet($v){ $this->cantdet = $v; }
    function setVundet($v){ $this->vundet = $v; }
    function setTotdet($v){ $this->totdet = $v; }
    function setIdlote($v){ $this->idlote = $v; }
    function setIdmov($v){ $this->idmov = $v; }

    // CARGA MASIVA
    public function setData($d){
        if(isset($d['iddet']))   $this->setIddet($d['iddet']);
        if(isset($d['idemp']))   $this->setIdemp($d['idemp']);
        if(isset($d['idsal']))   $this->setIdsal($d['idsal']);
        if(isset($d['idprod']))  $this->setIdprod($d['idprod']);
        if(isset($d['cantdet'])) $this->setCantdet($d['cantdet']);
        if(isset($d['vundet']))  $this->setVundet($d['vundet']);
        if(isset($d['totdet']))  $this->setTotdet($d['totdet']);
        if(isset($d['idlote']))  $this->setIdlote($d['idlote']);
        if(isset($d['idmov']))   $this->setIdmov($d['idmov']);
    }

    // LISTAR TODOS
    public function getAll(){
        try{
            $sql = "SELECT d.*, p.nomprod, l.codlot 
                    FROM detsalida d
                    LEFT JOIN producto p ON d.idprod = p.idprod
                    LEFT JOIN lote l ON d.idlote = l.idlote
                    ORDER BY d.iddet DESC";

            $cn = (new conexion())->get_conexion();
            $st = $cn->prepare($sql);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_ASSOC);

        } catch(Exception $e){
            return [];
        }
    }

    // OBTENER UNO
    public function getOne(){
        try{
            $sql = "SELECT d.*, p.nomprod, l.codlot 
                    FROM detsalida d
                    LEFT JOIN producto p ON d.idprod = p.idprod
                    LEFT JOIN lote l ON d.idlote = l.idlote
                    WHERE d.iddet=:iddet";

            $cn = (new conexion())->get_conexion();
            $st = $cn->prepare($sql);
            $st->bindParam(":iddet", $this->iddet);
            $st->execute();
            return $st->fetch(PDO::FETCH_ASSOC);

        } catch(Exception $e){
            return null;
        }
    }

    // GUARDAR
    public function save(){
        try{
            $sql = "INSERT INTO detsalida(idemp, idsal, idprod, cantdet, vundet, totdet, idlote, idmov)
                    VALUES(:idemp, :idsal, :idprod, :cantdet, :vundet, :totdet, :idlote, :idmov)";

            $cn = (new conexion())->get_conexion();
            $st = $cn->prepare($sql);

            $st->bindParam(":idemp",   $this->idemp);
            $st->bindParam(":idsal",   $this->idsal);
            $st->bindParam(":idprod",  $this->idprod);
            $st->bindParam(":cantdet", $this->cantdet);
            $st->bindParam(":vundet",  $this->vundet);
            $st->bindParam(":totdet",  $this->totdet);
            $st->bindParam(":idlote",  $this->idlote);
            $st->bindParam(":idmov",   $this->idmov);

            $st->execute();
            return true;

        } catch(Exception $e){
            error_log("Error en save detalle: " . $e->getMessage());
            return false;
        }
    }

    // EDITAR
    public function edit(){
        try{
            $sql = "UPDATE detsalida SET
                        idemp=:idemp,
                        idsal=:idsal,
                        idprod=:idprod,
                        cantdet=:cantdet,
                        vundet=:vundet,
                        idlote=:idlote,
                        idmov=:idmov
                    WHERE iddet=:iddet";

            $cn = (new conexion())->get_conexion();
            $st = $cn->prepare($sql);

            $st->bindParam(":iddet",   $this->iddet);
            $st->bindParam(":idemp",   $this->idemp);
            $st->bindParam(":idsal",   $this->idsal);
            $st->bindParam(":idprod",  $this->idprod);
            $st->bindParam(":cantdet", $this->cantdet);
            $st->bindParam(":vundet",  $this->vundet);
            $st->bindParam(":idlote",  $this->idlote);
            $st->bindParam(":idmov",   $this->idmov);

            $st->execute();
            return true;

        } catch(Exception $e){
            return false;
        }
    }

    // ELIMINAR
    public function del(){
        try{
            $sql = "DELETE FROM detsalida WHERE iddet=:iddet";

            $cn = (new conexion())->get_conexion();
            $st = $cn->prepare($sql);
            $st->bindParam(":iddet", $this->iddet);
            $st->execute();
            return true;

        } catch(Exception $e){
            return false;
        }
    }
}
?>
