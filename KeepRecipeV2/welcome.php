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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #800040;">
        <a class="navbar-brand" href="#"  style="color: #ffffff;">KeepRecipe</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#" style="color: #ffffff;"> Minhas receitas <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#"  style="color: #ffffff;">Add receita</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: #ffffff;">
                        <?php echo htmlspecialchars($_SESSION["username"]); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="reset-password.php"  style="color: #ffffff;">Redefina sua senha</a>
                        <a class="dropdown-item" href="logout.php"  style="color: #ffffff;">Sair da conta</a>
                    </div>
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
                        <h4>Suas Receitas
                            <a href="recipe-create.php" class="btn btn-primary float-end">Nova Receita</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM recipe";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $recipe)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $recipe['id']; ?></td>
                                                <td><?= $recipe['title']; ?></td>
                                                <td>
                                                    <a href="recipe-view.php?id=<?= $recipe['id']; ?>" class="btn btn-info btn-sm">Visualizar</a>
                                                    <a href="recipe-edit.php?id=<?= $recipe['id']; ?>" class="btn btn-success btn-sm">Editar</a>
                                                    <form action="crud.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_recipe" value="<?=$student['id'];?>" class="btn btn-danger btn-sm">Deletar</button>
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