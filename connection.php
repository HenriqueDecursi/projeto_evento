<?php

function getConnection(){
    $dsn = 'mysql:host=localhost;dbname=db_ocorrencias;charset=utf8';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO($dsn, $user. $pass);
        return $pdo;
    } catch (PDOException $e) {
        echo('Erro: '.$e->getMessage());
    }
}
function disconnect() {

    $pdo = NULL;
}
?>