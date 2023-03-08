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
    <title>Notas</title>
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
                        <h4>Nota das receitas</h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped table table-hover">
                            <thead style="background-color: #4d0028; color: #ffb3da;">
                                <tr>
                                    <th scope="row">ID</th>
                                    <th scope="row">ID receita</th>
                                    <th scope="row">Nota</th>
                                    <th scope="row">Comentário</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: #ffb3da; color: #4d0028;">
                                <?php 
                                    $id_user = htmlspecialchars($_SESSION["id"]);
                                    //$query = "SELECT * FROM scores WHERE id_user='$id_user' ";
                                    $query = "SELECT recipe.id, recipe.title, scores.score, scores.coment FROM recipe INNER JOIN scores ON recipe.id_user='$id_user' AND scores.id_user='$id_user' ";
                                    //$query = "SELECT recipe.id, recipe.title, scores.score, scores.coment FROM recipe INNER JOIN scores ON recipe.id_user=scores.id_user ";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $scores)
                                        {
                                            ?>
                                            <tr style="color: #4d0028">
                                                <td><?= $scores['id']; ?></td>
                                                <td><?= $scores['title']; ?></td>
                                                <td><?= $scores['score']; ?></td>
                                                <td><?= $scores['coment']; ?></td>
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