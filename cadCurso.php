<?php 
    session_start();
    date_default_timezone_set('America/Sao_Paulo');  
    $curso = "";
?>
<!DOCTYPE html>
<html>
    <!doctype html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Cadastrar Cursos</title>
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
                <form role="form" class="form-horizontal" action="cadCurso.php" method="POST">
                    <div class="row-fluid">
                            <div class="col-md-5 col-sm-5 col-xs-12  ">
                            <p class="lead">Cadastro de Cursos</p>
                            
                            <label for="curso">Curso</label>
                            <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="curso" id="curso" class="form-control" required autofocus>
                            </div>
                            </div>
                            <label for="data" style="margin-top:10px;">Data</label>
                            <div class="row">
                            <div class="col-md-12">
                                <input type="date" name="data" id="data" class="form-control">
                            </div>
                            </div>
                            <br>
                            <div class="row-fluid">
                                <button class="btn btn-primary enviar" >Cadastrar</button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>     
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script> 
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php
    
    include 'connection.php';
    
    //$pagina ="./cadUser.html";

    $curso = $_POST['curso'];

    $conn = getConnection();
    $vUser = 'select * from tb_curso where curso = ?';
    $conUser = $conn->prepare($vUser);
    $conUser->bindParam(1,$curso);
    $conUser->execute();
    $count = $conUser->rowCount();
    $conn = disconnect();
    if ($count >=1) {
            echo "<p style='margin-left:30px;color:red;'>O curso ". $curso.", já existe em nosso banco de dados!</p>";
            $curso = "";
    } else {
        $conn = getConnection();
        $data = date ("Y-m-d H:i:s");
        $sql = "insert into tb_curso(curso, dt_inclusao) values (?, ?)";
        //prepare statement
        $stmt = $conn->prepare($sql);
        //passando o valor direto
        // $stmt->bindValue(1,"João");

        //necessita passar uma variavel quando se usa bindParam
        $stmt->bindParam(1,$curso);
        $stmt->bindParam(2,$data);


        if($stmt->execute()){
            
                echo "<p style='margin-left:30px;color:red;'>O Curso ".$curso.", foi cadastrado com sucesso!</p>";
                    
            // echo("Cadastrado com sucesso!");
            //header("location:$pagina");
            $conn = disconnect();
            

        }else{
            echo("<br>O curso $curso não foi cadastrado!");
            
        // header("location:$pagina");
        $conn = disconnect();
        }
        
    }
?>