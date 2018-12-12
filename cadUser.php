<?php 
    session_start();
    $cAlert = 0;
?>
<!DOCTYPE html>
<html>
    <!doctype html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Cadastro de usuário</title>
        <meta name="description" content="curso de bootstrap 3">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="form.css">
    </head>
    <body>     
            <?php
                include 'menu.php';
            ?>
           
        <div id="panel" >
            <div class="panel-body ">
                <form role="form" class="form-horizontal" action="cadUser.php" method="POST">
                    <div class="row-fluid">
                            <div class="col-md-5 col-sm-5 col-xs-12  ">
                            <p class="lead">Cadastro Usuário</p>
                            
                            <label for="nome">Nome</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="nome" id="nome" class="form-control" required autofocus>
                                </div>
                            </div>
                            <label>Email</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                            </div>
                            <label label-default="" for="">Senha</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="password" name="senha"  id="senha" class="form-control" required >
                                </div>
                            </div>
                            <br>
                            <div class="row-fluid">
                                <button class="btn btn-primary enviar" >Enviar</button>
                                <button class="btn btn-default limpar" onclick="limpar()">Limpar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function limpar(){
                document.getElementById('nome').value = "";
                document.getElementById('email').value = "";
                document.getElementById('senha').value = "";
                
            }
        </script>

        
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script> 
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php
    
    include './connection.php';
    
    //$pagina ="./cadUser.html";

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $se = $_POST['senha'];
    $senha = md5($se);

    /* Delete all rows from the FRUIT table */
   
// $del = $dbh->prepare('DELETE FROM fruit');
// $del->execute();

/* Return number of rows that were deleted */
// print("Return number of rows that were deleted:\n");
// $count = $del->rowCount();
// print("Deleted $count rows.\n");

    $conn = getConnection();
    $vUser = 'select * from tb_usuario where email = ?';
    $conUser = $conn->prepare($vUser);
    $conUser->bindParam(1,$email);
    $conUser->execute();
    $count = $conUser->rowCount();
    $conn = disconnect();
    if ($count >=1) {
            echo "<script>alert('Email ". $email.", já existe em nosso banco de dados!');</script> ";
    } else {
        $conn = getConnection();
    
    
        $sql = 'insert into tb_usuario(nome, email, senha) values (?,?,?)';
        //prepare statement
        $stmt = $conn->prepare($sql);
        //passando o valor direto
        // $stmt->bindValue(1,"João");

        //necessita passar uma variavel quando se usa bindParam
        $stmt->bindParam(1,$nome);
        $stmt->bindParam(2,$email);
        $stmt->bindParam(3,$senha);

        $cAlert = 1;

        if($stmt->execute()){
            
                echo "<script>alert('Usuário ". $email.", Cadastrado com sucesso!');</script> ";
                    
            // echo("Cadastrado com sucesso!");
            //header("location:$pagina");
            $conn = disconnect();
            

        }else{
            echo("Usuário $email não foi cadastrado!");
            
        // header("location:$pagina");
        $conn = disconnect();
        }
        
    }
?>