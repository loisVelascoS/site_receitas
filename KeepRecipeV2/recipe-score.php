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

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/css.css">
    <title>Nota</title>
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
                    <a class="nav-link" href="#" style="color: #ffffff;"> <?php echo htmlspecialchars($_SESSION["username"]); ?> </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="welcome.php" style="color: #ffffff;"> Minhas receitas </a>
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
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Nota para a receita</h4>
                    </div>
                    <div class="card-body">
                    <?php
                        if(isset($_GET['id']))
                        {
                            $recipe_id = mysqli_real_escape_string($con, $_GET['id']);
                        ?>
                        <form action="crud.php" method="POST">
                            <input type="hidden" name="id_recipe" value="<?= $recipe_id ?>">
                            <div class="mb-3">
                                <label>Pontuação</label>
                                <input type="number" name="score" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Comentátio</label>
                                <input type="text" name="coment" class="form-control">
                                <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($_SESSION["id"]); ?>">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="score_recipe" class="btn btn-primary">
                                    Salvar nota
                                </button>
                            </div>
                        </form>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>