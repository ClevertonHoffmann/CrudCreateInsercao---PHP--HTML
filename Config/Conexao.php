<?php
    class Conexao{
        function Conecta(){
        $servidor = 'localhost';
        $banco = 'crudcreate';
        $usuario = 'root';
        $senha = '';
        $link = new mysqli($servidor, $usuario, $senha, $banco, '3306');
        if(!$link)
        {
            echo "erro ao conectar ao banco de dados!";
            return false;
        }else{
            return $link;
        }
        }
    }

?>