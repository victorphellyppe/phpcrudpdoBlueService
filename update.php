<?php
require_once 'conexao.php';

if (isset($_POST['update'])) {
    // Get the userid
    $userid = intval($_GET['id']);
    // Posted Values  
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $emailid = $_POST['emailid'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];

    // Query for Query for Updation
    $sql = "update tblusers set FirstName=:fn,LastName=:ln,EmailId=:eml,ContactNumber=:cno,Address=:adrss where id=:uid";
    //Prepare Query for Execution
    $query = $dbh->prepare($sql);
    // Bind the parameters
    $query->bindParam(':fn', $fname, PDO::PARAM_STR);
    $query->bindParam(':ln', $lname, PDO::PARAM_STR);
    $query->bindParam(':eml', $emailid, PDO::PARAM_STR);
    $query->bindParam(':cno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':adrss', $address, PDO::PARAM_STR);
    $query->bindParam(':uid', $userid, PDO::PARAM_STR);
    // Query Execution
    $query->execute();
    echo "<script>alert('Registro atualizado com sucesso');</script>";
    echo "<script>window.location.href='index.php'</script>";
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
                <h3>Atualizar registro</h3>
                <hr />
            </div>
        </div>

        <?php
        $userid = intval($_GET['id']);
        $sql = "SELECT FirstName,LastName,EmailId,ContactNumber,Address,PostingDate,id from tblusers where id=:uid";
        $query = $dbh->prepare($sql);
        //Vincula os parametros
        $query->bindParam(':uid', $userid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) {
        ?>
                <form name="insertrecord" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <b>Primeiro nome</b>
                            <input type="text" name="firstname" value="<?php echo htmlentities($result->FirstName); ?>" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <b>Último nome</b>
                            <input type="text" name="lastname" value="<?php echo htmlentities($result->LastName); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <b>Email</b>
                            <input type="email" name="emailid" value="<?php echo htmlentities($result->EmailId); ?>" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <b>Contato</b>
                            <input type="text" name="contactno" value="<?php echo htmlentities($result->ContactNumber); ?>" class="form-control" maxlength="10" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8"><b>Endereço</b>
                            <textarea class="form-control" name="address" required><?php echo htmlentities($result->Address); ?></textarea>
                        </div>
                    </div>
            <?php }
        } ?>

            <div class="row" style="margin-top:1%">
                <div class="col-md-8">
                    <input type="submit" name="update" value="Salvar">
                </div>
            </div>
                </form>
    </div>
    </div>
</body>
</htm