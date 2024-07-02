<?php
include_once('connection.php');
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirige l'utilisateur vers la page de connexion s'il n'est pas connecté
    exit();
}

$name = $_SESSION['username'];
$sql = "SELECT * FROM informations i 
        INNER JOIN inscriptions a ON i.username = a.username 
        WHERE i.username = :name";

try {
    $statement = $conn->prepare($sql);
    $statement->bindParam(':name', $name);
    $statement->execute();
    $resultat = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de requête : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations sur la candidature</title>
    <link rel="stylesheet" type="text/css" href="inscription.css">
    <link rel="stylesheet" href="Consulter.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body class="corp">
    <!-- Barre de navigation -->
    <div class="entete">
        <a href="bienvenu.html"><img src="logoiai.jpg" alt="Logo de l'école" class="school-logo"></a>
        <p class="titre">IAI-TOGO</p>
        <div class="header-buttons">
            <button class="boutton" href="acceuil3.php">Retour &agrave; l'accueil</button>
        </div>


    </div>
    <br><br><br><br><br>
    <center>
        <div class="contain">
            <table class="table">
                <tr>
                    <center>
                        <th colspan="2" class="p1">Bonjour <a href="" class="docum"><?php echo "$name"?></a>! Voici les informations sur votre candidature</th>
                    </center>
                    <hr>
                </tr>
                <?php foreach ($resultat as $element) : ?>
                    <tr>
                        <th>Nom</th>
                        <td><?php echo $element['nom'] ?></td>
                    </tr>
                    <tr>
                        <th>Prenom</th>
                        <td><?php echo $element['prenom'] ?></td>
                    </tr>
                    <tr>
                        <th>Date de naissance</th>
                        <td><?php echo $element['date_de_naissance'] ?></td>
                    </tr>
                    <tr>
                        <th>Sexe</th>
                        <td><?php echo $element['sexe'] ?></td>
                    </tr>
                    <tr>
                        <th>Nationalité</th>
                        <td><?php echo $element['nationalite'] ?></td>
                    </tr>
                    <tr>
                        <th>Année d'obtention du BAC</th>
                        <td><?php echo $element['annee_bac'] ?></td>
                    </tr>
                    <tr>
                        <th>Serie</th>
                        <td><?php echo $element['serie_bac'] ?></td>
                    </tr>
                    <tr>
                        <th>Photo</th>
                        <td><a class="docu" href="fichiers/photos/<?php echo $element['photo_d_identite']?>"><?php echo $element['photo_d_identite']?></a></td>
                    </tr>
                    <tr>
                        <th>Acte de naissance:</th>
                        <td><a class="docu" href="fichiers/naissances/<?php echo $element['naissance_pdf']?>"><?php echo $element['naissance_pdf']?></a></td>
                    </tr>
                    <tr>
                        <th>Certificat de la nationalité:</th>
                        <td><a class="docu" href="fichiers/nationalite/<?php echo $element['nationalite_pdf']?>"><?php echo $element['nationalite_pdf']?></a></td>
                    </tr>
                    <tr>
                        <th>Attestation du BAC II:</th>
                        <td><a class="docu" href="fichiers/attestations/<?php echo $element['attestation_pdf']?>"><?php echo $element['attestation_pdf']?></a></td>
                    </tr>
                    <tr>
                        <th>
                        </th>
                        <th><div class="derder">
                            <td>
                            <form action="Modifier.php" method="POST">
                    <button type="submit" name="mod" id="mod" class="btn btn-primary">Modifier</button>
                    <input type="hidden" name="id_mod" id="id_mod" value="<?php echo $element['id_candidature'] ?>">
                </form>
                            </td>
                            <td>
                            <form action="supprimer.php" method="post" id="formSuppression">
                                <button class="btn btn-danger" type="button" onclick="confirmerSuppression()" name="supprimer">SUPPRIMER</button>
                            </form>
                            </td>
                            
                            </div>
                        </th>
                    </tr>

                <?php endforeach; ?>
            </table>
<script>
    function confirmerSuppression() {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet votre candidature ?")) {
            document.getElementById("formSuppression").submit(); 
            } else {
        }
    }
</script>

        </div>