<?php 
include '../Config/Conexao.php';

class PersistenciaProduto{
    
    function PersistenciaProduto(){
    }
    
    public function listagem($iCod, $sDes, $sVal, $sDat1, $sDat2, $sDat3, $sDat4) {
        $aData = array();
        $Conx = new Conexao();
        $Link = $Conx->Conecta();
        $sSql = "Select * from Produto where descricao like '%".$sDes."%' ";
        if($iCod!=null){
            $sSql.=" and codigo =".$iCod;
        }
        if($sVal!=null){
            $sSql.=" and valor >= ".$sVal." ";
        }
        if($sDat1!=null && $sDat2!=null){
            $sSql.=" and dataDaCompra between '".$sDat1."' and '".$sDat2."'";
        }
        if($sDat3!=null && $sDat4!=null){
            $sSql.=" and dataValidade between '".$sDat3."' and '".$sDat4."'";
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
    
    public function insercao($sDes, $sDat1, $sDat2, $sVal){

        $Conx = new Conexao();
        $Link = $Conx->Conecta();
        $sSql = "insert into Produto (descricao, dataDaCompra, dataValidade, valor) 
                 values ('".$sDes."', '".$sDat1."', '".$sDat2."', '".$sVal."')";
        
        $bResultado = $Link->query($sSql);
        return $bResultado;
    }
}




?>