<!DOCTYPE html>
<html lang="pt">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <?php
       include '../Persistencia/PersistenciaPandemia.php';
       $pPandemia = new PersistenciaPandemia();
       if (isset($_POST['txtCodigo'])){
           $iCod = $_POST['txtCodigo'];
       }
       if (isset($_POST['txtData1'])){
           $sDat1 = $_POST['txtData1'];
       }
       if (isset($_POST['txtData2'])){
           $sDat2 = $_POST['txtData2'];
       }
       if (isset($_POST['txtNumeroDeContagios'])){
           $sNdeCont = $_POST['txtNumeroDeContagios'];
       }
       if (isset($_POST['txtNumeroDeCurados'])){
           $sNdeCur = $_POST['txtNumeroDeCurados'];
       }
       if (isset($_POST['txtNumeroDeObitos'])){
           $sNdeOb = $_POST['txtNumeroDeObitos'];
       }       
       if(isset($_POST['action'])){
            if($_POST['action']=='Buscar'){
                if(isset($iCod)||isset($sDat1)||isset($sDat2)||isset($sNdeCont)||isset($sNdeCur)||isset($sNdeOb)){
                    $jPandemias = $pPandemia->listagem($iCod,$sDat1, $sDat2, $sNdeCont, $sNdeCur, $sNdeOb);
                }
            }
            if($_POST['action']=='Inserir'){
                if($sDat1!='' && $sNdeCont!='' && $sNdeCur!='' && $sNdeOb!=''){
                    $bRes = $pPandemia->insercao($sDat1, $sNdeCont, $sNdeCur, $sNdeOb);
                    if($bRes){
                        echo "<script> alert('Inserção realizada com sucesso!'); </script>";
                    }else{
                        echo "<script> alert('Falha na inserção dos dados!'); </script>";
                    }
                }else{
                   echo "<script> alert('Informe todos valores para inserir!'); </script>";
                }
            }
            if($_POST['action']!='Buscar'){
                $jPandemias = $pPandemia->listagem(null, null, null, null, null, null);
            }
       }
  ?>
<head
    <meta charset="utf-8">
</head>
<body style="margin: 20px">
    <form method="post" action="ViewPandemia.php">
            <p><h2 style="text-align:center"> Sistema de Pandemia </h2></p>
            
        <div class="row">
		
            <div id="codigo" class="col-lg-2">

		<legend> Código </legend>
		
                <input for="txtCodigo" name="txtCodigo" type="text" id="txtCodigo"  placeholder="CODIGO...">
		
            </div>
            
            <div id="data1" class="col-lg-2">

                <legend>Data Análise</legend>

                <input for="txtData1" name="txtData1" type="date" id="txtData1">
                <small>Data inicial usada para consulta!</small>
            </div>
            
            <div id="data2" class="col-lg-2">

                <legend>Data Final</legend>
                
                <input for="txtData2" name="txtData2" type="date" id="txtData2">
                <small>Data usada apenas para consulta!</small>
            </div>
            
	    <div id="numeroDeContagios" class="col-lg-2">

                <legend> Nº de Contagios</legend>

                <input for="txtNumeroDeContagios" name="txtNumeroDeContagios" type="text" id="txtNumeroDeContagios" placeholder="NÚMERO CONT...">
                <small>Na consulta nº maior igual á</small>
            </div>
            
            <div id="numeroDeCurados" class="col-lg-2">

                <legend>Nº de Curados</legend>

                <input for="txtNumeroDeCurados" name="txtNumeroDeCurados" type="text" id="txtNumeroDeCurados" placeholder="NÚMERO CURAD...">
                <small>Na consulta nº maior igual á</small>
            </div>
                    
            <div id="numeroDeObitos" class="col-lg-2">

                <legend>Nº de Óbitos</legend>

                <input for="txtNumeroDeObitos" name="txtNumeroDeObitos" type="text" id="txtNumeroDeObitos" placeholder="NÚMERO ÓBITOS...">
                <small>Na consulta nº maior igual á</small>
            </div>
            
        </div>
		<br>
                <input type="submit" value= "Buscar" id ="action" name = "action" style="background-color:background"></input>
                <input type="submit" value= "Inserir" id ="action" name = "action" style="background-color:green"></input>
		<input type="reset"></input>
                <button type="button" onclick="location.href='../index.php'" style="background-color:yellow">Voltar</button>
	</form>
        <br>
</body>
<br>
<table class="table table-bordered">
	<tbody>
		<tr>
			<th id="th1">Código</th>
                        <th id="th2">Data Análise</th>
                        <th id="th3">Numero de Contágios</th>
                        <th id="th4">Numero de Curados</th>
                        <th id="th5">Número de Óbitos</th>
		</tr>
            <?php
               $arquivo = array();
               if(isset($jPandemias)){
                    $arquivo = json_decode($jPandemias);
               }
	    ?>
	     	<?php if($arquivo!=null){ foreach ($arquivo as $json){ ?>
	     	<tr id=linha<?php $json->codigo; ?>>
                                <td id="td1"><?php echo $json->codigo ?></td>
				<td id="td2"><?php echo date_format(new DateTime($json->dataAnalise), 'd/m/Y') ?></td>
                                <td id="td3"><?php echo $json->numeroDeContagios ?></td>
				<td id="td4"><?php echo $json->numerosDeCurados ?></td>
                                <td id="td5"><?php echo $json->numeroDeObitos ?></td>
                </tr>
                <?php }} ?>  
	</tbody>
</table>

</html>