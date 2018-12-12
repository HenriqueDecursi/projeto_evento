<?php

    include './connection.php';

    $conn = getConnection();

    $sql = 'insert into tb_usuario(nome, email, senha) values (?,?,?)';

    $nome = "Henrique md5";
    $email = "henrique.sw@gmail.com";
    $senha =md5 ("123");

    //prepare statement
    $stmt = $conn->prepare($sql);
   //passando o valor direto
   // $stmt->bindValue(1,"João");

   //necessita passar uma variavel quando se usa bindParam
    $stmt->bindParam(1,$nome);
    $stmt->bindParam(2,$email);
    $stmt->bindParam(3,$senha);

    if($stmt->execute()){
        echo("Usuario cadastrado com sucesso!");
    }else{
        echo("Usuario não cadastrado!");
    }
?>