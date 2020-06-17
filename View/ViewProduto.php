<!DOCTYPE html>
<html lang="pt">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <?php
        include '../Persistencia/PersistenciaProduto.php';
        $pProduto = new PersistenciaProduto();
       if (isset($_POST['txtCodigo'])){
           $iCod = $_POST['txtCodigo'];
       }
       if (isset($_POST['txtDescricao'])){
           $sDes = $_POST['txtDescricao'];
       }
       if (isset($_POST['txtValor'])){
           $sVal = $_POST['txtValor'];
       } 
       if (isset($_POST['txtData1'])){
           $sDat1 = $_POST['txtData1'];
       }
       if (isset($_POST['txtData2'])){
           $sDat2 = $_POST['txtData2'];
       }
       if (isset($_POST['txtData3'])){
           $sDat3 = $_POST['txtData3'];
       }
       if (isset($_POST['txtData4'])){
           $sDat4 = $_POST['txtData4'];
       }      
       if(isset($_POST['action'])){
            if($_POST['action']=='Buscar'){
                if(isset($iCod)||isset($sDes)||isset($sVal)||isset($sDat1)||isset($sDat2)||isset($sDat3)||isset($sDat4)){
                    $jProdutos = $pProduto->listagem($iCod, $sDes, $sVal, $sDat1, $sDat2, $sDat3, $sDat4);
                }
            }
            if($_POST['action']=='Inserir'){
                if($sDes!='' && $sVal!='' && $sDat1!='' && $sDat3!=''){
                    $bRes = $pProduto->insercao($sDes, $sDat1, $sDat3, $sVal);
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
                $jProdutos = $pProduto->listagem(null, null, null, null, null, null, null);
            }
       }
  ?>
<head
    <meta charset="utf-8">
</head>
<body style="margin: 20px">
    <form method="post" action="ViewProduto.php">
            <p><h2 style="text-align:center"> Sistema de Pesquisa de Produtos </h2></p>
            
        <div class="row">
		
            <div id="codigo" class="col-lg-3">

		<legend> Código </legend>
		
                <input for="txtCodigo" name="txtCodigo" type="text" id="txtCodigo"  placeholder="CODIGO...">
		
            </div>
            
	    <div id="descricao" class="col-lg-3">

                <legend> Descricao</legend>

                <input for="txtDescricao" name="txtDescricao" type="text" id="txtDescricao" placeholder="DESCRICAO...">
            
            </div>
            
            <div id="valor" class="col-lg-3">

                <legend>Valor</legend>

                <input for="txtValor" name="txtValor" type="text" id="txtValor" placeholder="VALOR..."><br>
                <small>Na consulta valor maior igual á</small>
            </div>
        </div>
    <br>
        <div class="row">    
            <div id="data1" class="col-lg-3">

                <legend>Data da Compra</legend>
                <input for="txtData1" name="txtData1" type="date" id="txtData1"><br>
                <small>Data inicial usada para consulta!</small>
            </div>
            
            <div id="data2" class="col-lg-3">

                <legend>Dt. final Compra</legend>
                <input for="txtData2" name="txtData2" type="date" id="txtData2"><br>
                <small>Data usada apenas para consulta!</small>
            </div>
            
            <div id="data3" class="col-lg-3">

                <legend>Data de Validade</legend>
                <input for="txtData3" name="txtData3" type="date" id="txtData3"><br>
                <small>Data inicial usada para consulta!</small>
            </div>
            
            <div id="data4" class="col-lg-3">

                <legend>Dt. Validade Final</legend>
                <input for="txtData4" name="txtData4" type="date" id="txtData4"><br>
                <small>Data usada apenas para consulta!</small>
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
                        <th id="th2">Descricao</th>
                        <th id="th3">Valor</th>
                        <th id="th4">Data da Compra</th>
                        <th id="th5">Data da Validade</th>
		</tr>
            <?php
               $arquivo = array();
               if(isset($jProdutos)){
                    $arquivo = json_decode($jProdutos);
               }
	    ?>
	     	<?php if($arquivo!=null){ foreach ($arquivo as $json){ ?>
	     	<tr id=linha<?php $json->codigo; ?>>
                                <td id="td1"><?php echo $json->codigo ?></td>
				<td id="td2"><?php echo $json->descricao ?></td>
                                <td id="td3"><?php echo $json->valor ?></td>
                                <td id="td4"><?php echo date_format(new DateTime($json->dataDaCompra), 'd/m/Y') ?></td>
				<td id="td5"><?php echo date_format(new DateTime($json->dataValidade), 'd/m/Y') ?></td>
                </tr>
                <?php }} ?>  
	</tbody>
</table>

</html>