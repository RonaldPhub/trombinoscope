<?php
if (!empty($_POST)) {
    $dsn = 'mysql:host=localhost;dbname=membre_message';
    $login = 'root';
    $pass = '';
    try {
        $dbh = new PDO($dsn, $login , $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'DELETE FROM membre WHERE CODE_MEMBRE = :CODE_MEMBRE';
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':CODE_MEMBRE' => $_POST['CODE_MEMBRE']
        ]);
    } catch (PDOException $e) {
        echo 'Erreur PDO : ' . $e->getMessage();
        echo '<br>code = ' . $e->getCode();
    }
}
header('Location:gestion_des_membres.php');
?>
