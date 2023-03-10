<?php
// Inicialize a sessão
session_start();
require 'dbcon.php';
 
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}



?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem vindo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #4d0028;">
    <a href="./index.html" class="navbar-brand"><img src="./img/logoLateralEscuro.png" style="width: 150px; height: 37.5px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#" style="color: #ffffff;"> <?php echo htmlspecialchars($_SESSION["username"]); ?> <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="welcome.php" style="color: #ffffff;"> Minhas receitas <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="recipe-create.php"  style="color: #ffffff;">Add receita</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="recipe-score-view.php"  style="color: #ffffff;">Ver notas</a>
                </li>
                <li>
                    <a class="nav-link" href="reset-password.php" style="color: #ffffff;">Redefina sua senha</a>
                </li>
                <li>
                    <a class="nav-link"href="logout.php" style="color: #ffffff;">Sair da conta</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container mt-4">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Suas receitas</h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped table table-hover">
                            <thead style="background-color: #4d0028; color: #ffb3da;">
                                <tr>
                                    <th scope="row">ID</th>
                                    <th scope="row">Titulo</th>
                                    <th scope="row">Ação</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: #ffb3da; color: #4d0028;">
                                <?php 
                                    $id_user = htmlspecialchars($_SESSION["id"]);
                                    $query = "SELECT * FROM recipe WHERE id_user='$id_user' ";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $recipe)
                                        {
                                            ?>
                                            <tr style="color: #4d0028">
                                                <td><?= $recipe['id']; ?></td>
                                                <td><?= $recipe['title']; ?></td>
                                                <td>
                                                    <a href="recipe-view.php?id=<?= $recipe['id']; ?>" class="btn btn-info btn-sm">Visualizar</a>
                                                    <a href="recipe-edit.php?id=<?= $recipe['id']; ?>" class="btn btn-success btn-sm">Editar</a>
                                                    <a href="recipe-score.php?id=<?= $recipe['id']; ?>" class="btn btn-warning btn-sm">Dar nota</a>
                                                    <form action="crud.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_recipe" value="<?=$recipe['id'];?>" class="btn btn-danger btn-sm">Deletar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> Nenhuma receita cadastrada </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>