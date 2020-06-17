<!DOCTYPE html>
<html lang="pt">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <?php
       include '../Persistencia/PersistenciaAluno.php';
       $pAluno = new PersistenciaAluno();
       if (isset($_POST['txtCodigo'])){
           $iCod = $_POST['txtCodigo'];
       }
       if (isset($_POST['txtNome'])){
           $sNom = $_POST['txtNome'];
       }
       if (isset($_POST['txtEmail'])){
           $sEma = $_POST['txtEmail'];
       }
       if (isset($_POST['txtData1'])){
           $sDat1 = $_POST['txtData1'];
       }
       if (isset($_POST['txtData2'])){
           $sDat2 = $_POST['txtData2'];
       }
       if (isset($_POST['txtNota'])){
           $sNot = $_POST['txtNota'];
       }               
       if(isset($_POST['action'])){
            if($_POST['action']=='Buscar'){
                if(isset($iCod)||isset($sNom)||isset($sEma)||isset($sDat1)||isset($sDat2)||isset($sNot)){
                    $jAlunos = $pAluno->listagem($iCod, $sNom, $sEma, $sDat1, $sDat2, $sNot);
                }
            }
            if($_POST['action']=='Inserir'){
                if($sNom!=''&&$sEma!=''&&$sDat1!=''&&$sNot!=''){
                    $bRes = $pAluno->insercao($sNom,$sEma,$sDat1,$sNot);
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
                $jAlunos = $pAluno->listagem(null, null, null, null, null, null);
            }
       }  
  ?>
<head
    <meta charset="utf-8">
</head>
<body style="margin: 20px">
    <form method="post" action="ViewAluno.php">
            <p><h2 style="text-align:center"> Sistema de Alunos </h2></p>
            
        <div class="row">
		
            <div id="codigo" class="col-lg-2">

		<legend> Código </legend>
		
                <input for="txtCodigo" name="txtCodigo" type="text" id="txtCodigo"  placeholder="CODIGO...">
		
            </div>
            
	    <div id="nome" class="col-lg-2">

                <legend> Nome</legend>

                <input for="txtNome" name="txtNome" type="text" id="txtNome" placeholder="NOME...">
            
            </div>
            
            <div id="email" class="col-lg-2">

                <legend>Email</legend>

                <input for="txtEmail" name="txtEmail" type="text" id="txtEmail" placeholder="EMAIL...">
            
            </div>
            
            <div id="data1" class="col-lg-2">

                <legend>Data Nascimento</legend>

                <input for="txtData1" name="txtData1" type="date" id="txtData1"><br>
                <small>Data inicial usada para consulta!</small>
            </div>
            
            <div id="data2" class="col-lg-2">

                <legend>Data Final</legend>

                <input for="txtData2" name="txtData2" type="date" id="txtData2"><br>
                <small>Data usada apenas para consulta!</small>
            </div>
            
            
            
            <div id="nota" class="col-lg-2">

                <legend>Nota</legend>

                <input for="txtNota" name="txtNota" type="text" id="txtNota" placeholder="NOTA..."><br>
                <small>Na consulta nota maior igual á</small>
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
                        <th id="th2">Nome</th>
                        <th id="th3">Email</th>
                        <th id="th4">Data Nascimento</th>
                        <th id="th5">Nota Final</th>
		</tr>
            <?php
               $arquivo = array();
               if(isset($jAlunos)){
                    $arquivo = json_decode($jAlunos);
               }
	    ?>
	     	<?php if($arquivo!=null){ foreach ($arquivo as $json){ ?>
	     	<tr id=linha<?php $json->codigo; ?>>
                                <td id="td1"><?php echo $json->codigo ?></td>
				<td id="td2"><?php echo $json->nome ?></td>
                                <td id="td3"><?php echo $json->email ?></td>
				<td id="td4"><?php echo date_format(new DateTime($json->dataDeNascimento), 'd/m/Y') ?></td>
                                <td id="td5"><?php echo $json->notaFinal ?></td>
                </tr>
                <?php }} ?>  
	</tbody>
</table>

</html>