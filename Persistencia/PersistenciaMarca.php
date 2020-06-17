<?php 
include '../Config/Conexao.php';

class PersistenciaMarca{
    
    function PersistenciaMarca(){
    }
    
    public function listagem($iCod, $sDes) {
        $aData = array();
        $Conx = new Conexao();
        $Link = $Conx->Conecta();
        $sSql = "Select * from Marca";
        if($iCod!=null && $sDes!=null){
            $sSql.=" where codigo =".$iCod." and descricao like '%".$sDes."%'";
        }else{
        if($iCod!=null){
            $sSql.=" where codigo = ".$iCod;
        }
        if($sDes!=null){
            $sSql.=" where descricao like '%".$sDes."%' ";
        }
        }
        if($sSql!=""){
        $aResultado = $Link->query($sSql);
        if($aResultado!=null){
        while ($row = $aResultado->fetch_assoc()){
            array_push($aData, $row);   
        }
        return json_encode($aData);
        }
        }
        return null;
    }

    public function insercao($sDes){

        $Conx = new Conexao();
        $Link = $Conx->Conecta();
        $sSql = "insert into Marca (descricao) 
                 value ('".$sDes."')";
        
        $bResultado = $Link->query($sSql);
        return $bResultado;
    }

}

?>