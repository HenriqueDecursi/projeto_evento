<?php

    include './connection.php';

    $conn = getConnection();

    $sql = 'delete from tb_usuario where idUsuario = ?';
    $id = 2;
   
    //prepare statement
    $stmt = $conn->prepare($sql);
   //passando o valor direto
   // $stmt->bindValue(1,"João");

   //necessita passar uma variavel quando se usa bindParam
    $stmt->bindParam(1,$id);


    if($stmt->execute()){
        echo("Usuario deletado com sucesso!");
    }else{
        echo("Não foi possível deletar o usuario!");
    }
?>