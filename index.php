<?php
require_once 'conexao.php';

    if (isset($_REQUEST['del'])) {
        $uid = intval($_GET['del']);
        $sql = "delete from tblusers WHERE  id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $uid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>
            alert('Registro atualizado com sucesso.');
        </script>";
        echo "<script>
                window.location.href='index.php'
            </script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>PHP CRUD - blueservice exercicio</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Exercicio CRUD</h3>
                <hr />
                <a href="insert.php"><button class="btn btn-primary"> Inserir Registro</button></a>
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>id</th>
                            <th>Primeiro nome</th>
                            <th>Último nome</th>
                            <th>Email</th>
                            <th>Contato</th>
                            <th>Endereço</th>
                            <th>Data de postagem</th>
                            <th>Editar</th>
                            <th>Apagar</th>
                        </thead>
                        <tbody>

                            <?php
                            $sql = "SELECT FirstName,LastName,EmailId,ContactNumber,Address,PostingDate,id from tblusers";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                            ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($result->FirstName); ?></td>
                                        <td><?php echo htmlentities($result->LastName); ?></td>
                                        <td><?php echo htmlentities($result->EmailId); ?></td>
                                        <td><?php echo htmlentities($result->ContactNumber); ?></td>
                                        <td><?php echo htmlentities($result->Address); ?></td>
                                        <td><?php echo htmlentities($result->PostingDate); ?></td>

                                        <td>
                                            <a href="update.php?id=<?php echo htmlentities($result->id); ?>">
                                                <button class="btn btn-primary btn-xs">
                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                </button>
                                            </a>
                                        </td>

                                        <td>
                                            <a href="index.php?del=<?php echo htmlentities($result->id); ?>">
                                                <button class="btn btn-danger btn-xs" onClick="return confirm('Você realmente deseja excluir?');">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>


                            <?php
                                    $cnt++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>