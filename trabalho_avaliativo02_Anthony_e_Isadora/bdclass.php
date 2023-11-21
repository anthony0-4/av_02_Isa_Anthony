<?php

class DB{
public function conn(){
$host = "localhost";
$dbname = "trabalhoavaliativo02";
$user = "root";
$password = "";

try {
  $conn = new PDO(
    "mysql:host=$host;dbname=$dbname", 
    $user, 
    $password,
    [
      PDO::ATTR_ERRMODE,
      PDO::ERRMODE_EXCEPTION,
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET names utf8"
    ]
  );


 // echo "Connected successfully";

  return $conn;

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
}

  public function select($nome_tabela){
    
    $conn = $this->conn();
    $sql = "SELECT * FROM $nome_tabela";


    $st = $conn -> prepare($sql);
    $st->execute();

    return $st->fetchAll(PDO:: FETCH_CLASS);
  }

  public function insert($nome_tabela, $dados){
        
    $conn = $this->conn();
    $sql = "INSERT INTO $nome_tabela ("; 

    $flag = 0;
    $vetorDados = [];
                
    foreach($dados as $campo => $valor){
      if($flag == 0){  
        $sql .= "$campo";
      }
      else{
        $sql .= ", $campo";
      }
      $flag = 1;
    }
    $sql .=") values (";
    foreach($dados as $campo => $valor){
      if($flag == 0){  
        $sql .= "?";
      }
      else{
        $sql .= ", ?";
      }
      $flag = 1;
      $vetorDados[] = $valor;
    }

    $sql .=")";

    $st = $conn->prepare($sql);

    $st->execute([
        $dados['nome'],
        $dados['cpf'],
        $dados['telefone'],
    ]);
}

public function destroy($nome_tabela, $id){
    
    $conn = $this->conn();
    $sql = "DELETE FROM $nome_tabela where id = ?";

    $st = $conn->prepare($sql);
    $st->execute([$id]);

}

public function search($nome_tabela, $dados){
    
    //var_dump($dados);
    //exit;
    $campo = $dados['tipo'];
    $valor = $dados['valor'];

    $conn = $this->conn();
    $sql = "SELECT * FROM $nome_tabela where $campo LIKE ?";

    $st = $conn->prepare($sql);
    $st->execute(["%$valor%"]);

    return $st->fetchAll(PDO::FETCH_CLASS);
}

//
public function find($nome_tabela, $id){
    
  $conn = $this->conn();
  $sql = "SELECT * FROM $nome_tabela WHERE id = ?"; //o ? serbe para pegar a informação, então id= ?(é o id do objeto selecionado)


  $st = $conn -> prepare($sql);
  $st->execute(['$id']);

  return $st->fetchAll(PDO:: FETCH_CLASS);
}

public function update($nome_tabela, $dados){
        
  $conn = $this->conn();
  $sql = "UPDATE $nome_tabela SET (nome=?, cpf=?, telefone=?)
  WHERE id=?";

  $st = $conn->prepare($sql);

  $st->execute([
      $dados['nome'],
      $dados['cpf'],
      $dados['telefone'],
      $dados['id'],
  ]);
}

}

?>
