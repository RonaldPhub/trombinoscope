<?php
$titre = "Ajouts membres";
include '_header.php';
?>
<?php
// var_dump($_POST);
// var_dump($_FILES);


if (!empty($_POST)) { //$ajout = $_POST['ajout'];
    $pseudo = $_POST['pseudo'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $description = $_POST['description'];

    $dsn = 'mysql:host=localhost;dbname=membre_message;charset=UTF8';
    $login = 'root';
    $pass = '';

    if ($_FILES['photo']['error'] != 0) {
        $error = "problème formulaire";
    } elseif ($_FILES['photo']['size'] > 5000000) {
        $error = "La photo ne doit pas dépasser 5Mo";
    } elseif (strrchr($_FILES['photo']['name'], '.') != '.jpg') {
        $error = "Format jpg attendu";
    }

    if (!isset($error)) {
        move_uploaded_file($_FILES['photo']['tmp_name'], 'upload/' . $_FILES['photo']['name']);


        try {

            $dbh = new PDO($dsn, $login, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'INSERT INTO membre(PSEUDO, MAIL, MOT_DE_PASSE, PHOTO, DESCRIPTION) VALUES (:pseudo, :mail, :password, :photo, :description)';
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ':pseudo' => $pseudo,
                ':mail' => $mail,
                ':password' => $password,
                'photo' => $_FILES['photo']['name'],
                ':description' => $description
            ]);
            header('Location:gestion_des_membres.php');
        } catch (PDOException $e) {
            echo 'Erreur PDO : ' . $e->getMessage();
            echo '<br>Code ' . $e->getCode();
        }
    }
}
?>
<a href="gestion_des_membres.php"><--Retour à gestion des membres</a>
<div align="center">
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="pseudo" placeholder="Pseudo" /><br />
        <input type="text" name="mail" placeholder="Mail" /><br />
        <input type="password" name="password" placeholder="Password" /><br />
        <textarea name="description" placeholder="Description"></textarea><br />
        <input type="file" name="photo" placeholder="Photo" /><br />
        <input type="submit" name="ajout" value="Ajout membre!" />
    </form>
</div>

<?php
include '_footer.php';
?>