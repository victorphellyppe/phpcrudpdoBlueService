<?php
require_once 'conexao.php';
if (isset($_POST['insert'])) {
  $primeiroNome = $_POST['firstname'];
  $ultimoNome = $_POST['lastname'];
  $email = $_POST['emailid'];
  $contato = $_POST['contactno'];
  $endereco = $_POST['address'];

  $sql = "INSERT INTO tblusers(FirstName,LastName,EmailId,ContactNumber,Address) VALUES(:fn,:ln,:eml,:cno,:adrss)";
  $query = $dbh->prepare($sql);
  // ligando parametros a variavel recebida no post
  $query->bindParam(':fn', $primeiroNome, PDO::PARAM_STR);
  $query->bindParam(':ln', $ultimoNome, PDO::PARAM_STR);
  $query->bindParam(':eml', $email, PDO::PARAM_STR);
  $query->bindParam(':cno', $contato, PDO::PARAM_STR);
  $query->bindParam(':adrss', $endereco, PDO::PARAM_STR);
  $query->execute();
  // Verificando foi inserido algo no banco de dados.
  $lastInsertId = $dbh->lastInsertId();
  if ($lastInsertId) {
    echo "<script>alert('Registro inserido com sucesso.');</script>";
    echo "<script>window.location.href='index.php'</script>";
  } else {
    echo "<script>alert('Algo deu errado. Por favor, tente novamente');</script>";
    echo "<script>window.location.href='index.php'</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>PHP CRUD - blueservice exercicio</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Inserir Registro </h3>
        <hr />
      </div>
    </div>
    <form name="insertrecord" method="post">
      <div class="row">
        <div class="col-md-4">
          <b>Primeiro nome</b>
          <input type="text" name="firstname" class="form-control" required>
        </div>

        <div class="col-md-4">
          <b>Último nome</b>
          <input type="text" name="lastname" class="form-control" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <b>Email</b>
          <input type="email" name="emailid" class="form-control" required>
        </div>

        <div class="col-md-4">
          <b>Contato</b>
          <input type="text" name="contactno" class="form-control" maxlength="11" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8">
          <b>Endereço</b>
          <textarea class="form-control" name="address" required></textarea>
        </div>
      </div>

      <div class="row" style="margin-top:1%">
        <div class="col-md-8">
          <input type="submit" name="insert" value="Salvar">
        </div>
      </div>
    </form>
  </div>
  </div>
</body>

</html>