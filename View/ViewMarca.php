<!DOCTYPE html>
<html lang="pt">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <?php
       include '../Persistencia/PersistenciaMarca.php';
       $pMarca = new PersistenciaMarca();
       if (isset($_POST['txtCodigo'])){
           $iCod = $_POST['txtCodigo'];
       }
       if (isset($_POST['txtDescricao'])){
           $sDes = $_POST['txtDescricao'];
       }
       if(isset($_POST['action'])){
            if($_POST['action']=='Buscar'){
                if(isset($iCod)||isset($sDes)){
                     $jMarcas = $pMarca->listagem($iCod, $sDes);
                }
            }
            if($_POST['action']=='Inserir'){
                if($sDes!=''){
                    $bRes = $pMarca->insercao($sDes);
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
                $jMarcas = $pMarca->listagem(null,null);
            }
       } 
       
  ?>
<head
    <meta charset="utf-8">
</head>
<body style="margin: 20px">
    <form method="post" action="ViewMarca.php">
            <p><h2 style="text-align:center"> Sistema de Marcas </h2></p>
            
        <div class="row">
		
            <div id="codigo" class="col-lg-2">

		<legend> Código </legend>
		
                <input for="txtCodigo" name="txtCodigo" type="tel" id="txtCodigo"  placeholder="CODIGO...">
		
            </div>
            
	    <div id="descricao" class="col-lg-3">

                <legend>Pesquisar Descricao</legend>

                <input for="txtDescricao" name="txtDescricao" type="text" id="txtDescricao" placeholder="DESCRICAO...">
            
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
                        <th id="th1">Descrição</th>
		</tr>
            <?php
               $arquivo = array();
               if(isset($jMarcas)){
                    $arquivo = json_decode($jMarcas);
               }
	    ?>
	     	<?php if($arquivo!=null){ foreach ($arquivo as $json){ ?>
	     	<tr id=linha<?php $json->codigo; ?>>
                                <td id="td2"><?php echo $json->codigo ?></td>
				<td id="td3"><?php echo $json->descricao ?></td>
                </tr>
                <?php }} ?>  
	</tbody>
</table>

</html>