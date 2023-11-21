<?php
 include './header.php';
 include '../bdclass.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $db = new DB();
        $db->conn();

        if(!empty($_GET['id'])){
            $db->destroy("livro",$_GET['id']);
          
            header('location: AlunoList.php');
        }

        if(!empty($_POST)){
           // var_dump($_POST);
           // exit;
           $dados = $db->search("livro",$_POST);
        } else {
           $dados = $db->select("livro");
           
        }

    ?>

    <div>
        <h3>Listagem de Livros</h3>

        <form action="LivroList.php" method="post">
            <select name="tipo">
                <option value="titulo">Titulo</option>
                <option value="paginas">Paginas</option>
                <option value="preco">Preço</option>
                <option value="genero">Genero</option>
            </select>
            <input type="text" name="valor" />
            <button type="submit">Pesquisar</button>
            <a href="LivroForm.php"> Cadastrar </a>
        </form>
    </div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">Titulo</th>
      <th scope="col">Paginas</th>
      <th scope="col">Preço</th>
      <th scope="col">Genero</th>
      <th scope="col">Editar</th>
      <th scope="col">Excluir</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach($dados as $item){
            echo "<tr>";
            echo "<th scope='row'>$item->id</th>";
            echo "<td>$item->titulo</td>";
            echo "<td>$item->paginas</td>";
            echo "<td>$item->preco</td>";
            echo "<td>$item->genero</td>";
            echo "<td><a href='LivroForm.php?id=$item->id'>Editar</a></td>";
            echo "<td><a onclick='return confirm(\"Deseja Excluir?\")'
                    href='AlunoList.php?id=$item->id'>Deletar</a>
                  </td>";
            echo "</tr>";   
        }
    ?>
  </tbody>
</table>

<?php include "./footer.php" ?>
<?php include "rodape.php" ?>