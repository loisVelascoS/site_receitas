<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_recipe']))
{
    $recipe_id = mysqli_real_escape_string($con, $_POST['delete_recipe']);

    $query = "DELETE FROM recipe WHERE id='$recipe_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Receita excluida com sucesso";
        header("Location: welcome.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Não foi possivel excluir esta receita";
        header("Location: welcome.php");
        exit(0);
    }
}

if(isset($_POST['update_recipe']))
{
    $recipe_id = mysqli_real_escape_string($con, $_POST['recipe_id']);

    $title = mysqli_real_escape_string($con, $_POST['title']);
    $modo_preparo = mysqli_real_escape_string($con, $_POST['modo_preparo']);
    $ingredientes = mysqli_real_escape_string($con, $_POST['ingredientes']);

    $query = "UPDATE recipe SET title='$title', modo_preparo='$modo_preparo', id_user='' WHERE id='$recipe_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Receita atualizada com sucesso!";
        header("Location: welcome.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Receita não atualizada!";
        header("Location: welcome.php");
        exit(0);
    }

}


if(isset($_POST['save_recipe']))
{
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $modo_preparo = mysqli_real_escape_string($con, $_POST['modo_preparo']);

    $query = "INSERT INTO recipe (title,modo_preparo,id_user) VALUES ('$title','$modo_preparo','')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Receita cadastrada com sucesso!";
        header("Location: recipe-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "receita não cadastrada!";
        header("Location: recipe-create.php");
        exit(0);
    }
}

?>