
<?php
 include './header.php';
 include '../db.class.php';
?>

<?php
  $db = new DB();
  $db->conn();

  if(!empty($_POST['id'])){
    $db->update("livro",$_POST);
    header("location: LivroList.php");

  } else if($_POST){
    $db->insert("livro",$_POST);
    header("location: LivroList.php");
  }

  if(!empty($_GET['id'])){
    $livro = $db->find("livro", $_GET['id']);
    //var_dump($livro);
  }
?>

    <h3>Formulário livro</h3>

    <form action="LivroForm.php" method="post">
        <input type="hidden" name="id" value="<?php echo !empty($livro->id) ? $livro->id :"" ?>">
        
        <label for="titulo">Titulo</label><br>
        <input type="text" name="titulo" value="<?php echo !empty($livro->titulo) ? $livro->titulo :"" ?>"><br>

        <label for="paginas">Paginas</label><br>
        <input type="text" name="paginas" value="<?php echo !empty($livro->paginas) ? $livro->paginas :"" ?>"><br>

        <label for="preco">Preço</label><br>
        <input type="text" name="preco"  value="<?php echo !empty($livro->preco) ? $livro->preco :"" ?>"><br>

        <label for="genero">Genero</label><br>
        <input type="text" name="genero" value="<?php echo !empty($livro->genero) ? $livro->genero :"" ?>"><br>

        <button type="submit"><?php echo !empty($_GET['id']) ? "Editar" : "Salvar" ?></button>
        <a href="livroList.php"> Voltar </a>

    </form>
<?php include "./footer.php" ?>
<?php include "rodape.php" ?>