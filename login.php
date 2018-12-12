
<!DOCTYPE html>
<html>
    <!doctype html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Cadatro de usuário</title>
        <meta name="description" content="curso de bootstrap 3">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="form.css">

       
    </head>
    <body>
        <div id="container">
        <div id="panel" >
            <div class="panel-body ">
                <form role="form" class="form-horizontal" action="" method="POST">
                    <div class="row-fluid">
                            <div class="col-md-5 col-sm-5 col-xs-12  ">
                            <p class="lead">Login </p>
                            
                            <label for="nome">Email</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="email" id="email" class="form-control" required autofocus>
                                </div>
                            </div>
                            <label for="">Senha</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="password" name="senha"  id="senha" class="form-control" required >
                                </div>
                            </div>
                            <br>
                            <div class="row-fluid">
                                <button class="btn btn-primary enviar" >Logar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script> 
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php
    session_start();

    include "./connection.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $se = md5($senha);

    //$sql = "select * from tb_usuario where idUsuario = ?";
        $conn = getConnection();

        $sql = "select nome, email, senha from tb_usuario where email = ?";
    
        $stmt = $conn->prepare($sql); 
        $stmt->bindParam(1,$se);
        $stmt->execute();

       // $result = $stmt->fetchAll();

        $resultado_usuario = mysqli_query($conn, $stmt);

        echo("<script>alert'opa $resultado_usuario';</script>");

		if($resultado_usuario){
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			if(password_verify($senha, $row_usuario['senha'])){
				$_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['email'] = $row_usuario['email'];
                echo("<script>alert'opa';</script>");
				header("Location: main.php");
			}else{
				$_SESSION['msg'] = "Dados incorretos!";
				header("Location: login.php");
			}

    } else {
        $_SESSION['msg'] = "Dados incorretos!";
        header("Location: login.php");
    }
    $_SESSION['msg'] = "Dados incorretos!";
    header("Location: login.php");


    
?>