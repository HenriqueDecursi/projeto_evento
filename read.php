<?php

    include './connection.php';

    $conn = getConnection();
    $email = 'asd@asd.com';
    //$sql = "select * from tb_usuario where idUsuario = ?";
    $sql = "select * from tb_usuario where email ='$email'";
    
    $stmt = $conn->prepare($sql);
    
    // usando o where
    //$id = 3;
    // $stmt->bindParam(1, $id);
    
    $stmt->execute();

    $result = $stmt->fetchAll();

    foreach ($result as $value) {
        echo('Nome: '.$value['nome'].'<br>Email: '.$value['email'].'<br>Senha: '.$value['senha'].'<br><br>');
    }

?>