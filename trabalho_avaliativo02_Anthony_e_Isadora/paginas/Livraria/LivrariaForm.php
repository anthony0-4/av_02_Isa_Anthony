<?php
 include './header.php';
 include '../db.class.php';
?>

<?php
  $db = new DB();
  $db->conn();

  if(!empty($_POST['id'])){
    $db->update("aluno",$_POST);
    header("location: AlunoList.php");

  } else if($_POST){
    $db->insert("aluno",$_POST);
    header("location: AlunoList.php");
  }

  if(!empty($_GET['id'])){
    $aluno = $db->find("aluno", $_GET['id']);
    //var_dump($aluno);
  }
?>

    <h3>Formulário Aluno</h3>

    <form action="AlunoForm.php" method="post">
        <input type="hidden" name="id" value="<?php echo !empty($aluno->id) ? $aluno->id :"" ?>">
        
        <label for="nome">Nome</label><br>
        <input type="text" name="nome" value="<?php echo !empty($aluno->nome) ? $aluno->nome :"" ?>"><br>

        <label for="cpf">CPF</label><br>
        <input type="text" name="cpf" value="<?php echo !empty($aluno->cpf) ? $aluno->cpf :"" ?>"><br>

        <label for="telefone">Telefone</label><br>
        <input type="text" name="telefone"  value="<?php echo !empty($aluno->telefone) ? $aluno->telefone :"" ?>"><br>

        <button type="submit"><?php echo !empty($_GET['id']) ? "Editar" : "Salvar" ?></button>
        <a href="AlunoList.php"> Voltar </a>

    </form>
<?php include "./footer.php" ?>
<?php include "rodape.php" ?>