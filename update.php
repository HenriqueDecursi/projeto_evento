<?php

    include './connection.php';

    $conn = getConnection();

    $sql = 'update tb_usuario set nome = ?, email = ?, senha = ? 
    where idUsuario = ?';
    $id = 1;
    $nome = "Henrique Almeida";
    $email = "henrique.sw@gmail.com";
    $senha =md5 ("opa");

    //prepare statement
    $stmt = $conn->prepare($sql);
   //passando o valor direto
   // $stmt->bindValue(1,"João");

   //necessita passar uma variavel quando se usa bindParam
    $stmt->bindParam(1,$nome);
    $stmt->bindParam(2,$email);
    $stmt->bindParam(3,$senha);
    $stmt->bindParam(4,$id);

    if($stmt->execute()){
        echo("Usuario atualizado com sucesso!");
    }else{
        echo("Não foi possível atualizar o cadastro!");
    }
?>