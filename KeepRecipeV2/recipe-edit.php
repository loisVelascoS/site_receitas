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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Editar receita</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar receita 
                            <a href="welcome.php" class="btn btn-danger float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $recipe_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM recipe WHERE id='$recipe_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                <form action="crud.php" method="POST">
                                    <input type="hidden" name="recipe_id" value="<?= $recipe['id']; ?>">

                                    <div class="mb-3">
                                        <label>Titilo</label>
                                        <input type="text" name="title" value="<?=$recipe['title'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Modo de preparo</label>
                                        <input type="text" name="modo_preparo" value="<?=$recipe['modo_preparo'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Ingredientes</label>
                                        <input type="text" name="ingredient" value="<?=$recipe['ingredient'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_student" class="btn btn-primary">
                                            Atualizar receita
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>Nenhum ID encontrado</h4>";
                            }
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