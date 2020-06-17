<?php 
include '../Config/Conexao.php';

class PersistenciaAluno{
    
    function PersistenciaAluno(){
    }
    
    public function listagem($iCod, $sNom, $sEma, $sDat1, $sDat2, $sNot) {
        $aData = array();
        $Conx = new Conexao();
        $Link = $Conx->Conecta();
        $sSql = "Select * from Aluno where nome like '%".$sNom."%' ";
        if($iCod!=null){
            $sSql.=" and codigo =".$iCod;
        }
        if($sEma!=null){
            $sSql.=" and email like '%".$sEma."%' ";
        }
        if($sDat1!=null && $sDat2!=null){
            $sSql.=" and dataDeNascimento between '".$sDat1."' and '".$sDat2."'";
        }
        if($sNot!=null){
            $sSql.=" and notaFinal >= ".$sNot." ";
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

    public function insercao($sNom, $sEma, $sDat, $sNot){

        $Conx = new Conexao();
        $Link = $Conx->Conecta();
        $sSql = "insert into Aluno (nome, email, dataDeNascimento, notaFinal) 
                 values ('".$sNom."', '".$sEma."', '".$sDat."', '".$sNot."')";
        
        $bResultado = $Link->query($sSql);
        return $bResultado;
    }
    
}

?>