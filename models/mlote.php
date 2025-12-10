<?php
class Mlote {
    // Atributos
    private $idlote;
    private $idprod;
    private $codlot; // Changed from codlote to match view/standard
    private $fecing;
    private $fecven;
    private $cstuni;
    private $cantini;
    private $cantact;
    
    // Getters
    function getIdlote(){ return $this->idlote; }
    function getIdprod(){ return $this->idprod; }
    function getCodlot(){ return $this->codlot; }
    function getFecing(){ return $this->fecing; }
    function getFecven(){ return $this->fecven; }
    function getCstuni(){ return $this->cstuni; }
    function getCantini(){ return $this->cantini; }
    function getCantact(){ return $this->cantact; }
   

    // Setters
    function setIdlote($idlote){ return $this->idlote = $idlote; }
    function setIdprod($idprod){ return $this->idprod = $idprod; }
    function setCodlot($codlot){ return $this->codlot = $codlot; }
    function setFecing($fecing){ return $this->fecing = $fecing; }
    function setFecven($fecven){ return $this->fecven = $fecven; }
    function setCstuni($cstuni){ return $this->cstuni = $cstuni; }
    function setCantini($cantini){ return $this->cantini = $cantini; }
    function setCantact($cantact){ return $this->cantact = $cantact; }
   
    // Helper to set data
    public function setData($data){
        if(isset($data['idlote'])) $this->setIdlote($data['idlote']);
        if(isset($data['idprod'])) $this->setIdprod($data['idprod']);
        if(isset($data['codlot'])) $this->setCodlot($data['codlot']);
        if(isset($data['fecing'])) $this->setFecing($data['fecing']);
        if(isset($data['fecven'])) $this->setFecven($data['fecven']);
        if(isset($data['cstuni'])) $this->setCstuni($data['cstuni']);
        if(isset($data['cantini'])) $this->setCantini($data['cantini']);
        if(isset($data['cantact'])) $this->setCantact($data['cantact']);
        
    }

    // Obtener todos
    public function getAll(){
        try{
            $sql = "SELECT l.*, p.nomprod 
                    FROM lote l 
                    LEFT JOIN producto p ON l.idprod = p.idprod 
                    ORDER BY l.idlote DESC";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);
            $res->execute();
            return $res->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e){
            // men($e); // Assuming 'men' is a custom error handler function available globally or undefined
            // For safety, let's just return empty array or handle gracefully if 'men' is not certain
            return [];
        }
    }

    // Obtener uno
    public function getOne(){
        try{
            $sql = "SELECT * FROM lote WHERE idlote=:idlote";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);
            $idlote = $this->getIdlote();
            $res->bindParam(":idlote", $idlote);
            $res->execute();
            // Fetch single row for editing
            return $res->fetch(PDO::FETCH_ASSOC); 
        } catch(Exception $e){
            return null;
        }
    }

    // Guardar
    public function save(){
        try{
            $sql = "INSERT INTO lote(idprod, codlot, fecing, fecven, cantini, cantact, cstuni)
                    VALUES(:idprod, :codlot, :fecing, :fecven, :cantini, :cantact, :cstuni)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);

            $idprod = $this->getIdprod();
            $res->bindParam(":idprod", $idprod);
            $codlot = $this->getCodlot();
            $res->bindParam(":codlot", $codlot);
            $fecing = $this->getFecing();
            $res->bindParam(":fecing", $fecing);
            $fecven = $this->getFecven();
            $res->bindParam(":fecven", $fecven);
            $cantini = $this->getCantini();
            $res->bindParam(":cantini", $cantini);
            $cantact = $this->getCantact();
            $res->bindParam(":cantact", $cantact);
            $cstuni = $this->getCstuni();
            $res->bindParam(":cstuni", $cstuni);

            $res->execute();
            return true;
        } catch(Exception $e){
            return false;
        }
    }

    // Actualizar (Edit)
    public function edit(){
        try{
            $sql = "UPDATE lote SET 
                    idprod=:idprod, 
                    codlot=:codlot, 
                    fecing=:fecing,
                    fecven=:fecven, 
                    cantini=:cantini,
                    cantact=:cantact,
                    cstuni=:cstuni
                    WHERE idlote=:idlote";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);

            $idlote = $this->getIdlote();
            $res->bindParam(":idlote", $idlote);
            $idprod = $this->getIdprod();
            $res->bindParam(":idprod", $idprod);
            $codlot = $this->getCodlot();
            $res->bindParam(":codlot", $codlot);
            $fecing = $this->getFecing();
            $res->bindParam(":fecing", $fecing);
            $fecven = $this->getFecven();
            $res->bindParam(":fecven", $fecven);
            $cantini = $this->getCantini();
            $res->bindParam(":cantini", $cantini);
            $cantact = $this->getCantact();
            $res->bindParam(":cantact", $cantact);
            $cstuni = $this->getCstuni();
            $res->bindParam(":cstuni", $cstuni);

            $res->execute();
            return true;
        } catch(Exception $e){
            return false;
        }
    }

    // Eliminar
    public function del(){
        try{
            $sql = "DELETE FROM lote WHERE idlote=:idlote";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);
            $idlote = $this->getIdlote();
            $res->bindParam(":idlote", $idlote);
            $res->execute();
            return true;
        } catch(Exception $e){
            return false;
        }
    }

}



?>
