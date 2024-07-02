<?php
include_once("connection.php");
if (isset($_POST['mod'])) {
    $sql = "SELECT * From informations where  id_candidature = :id
            ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $_POST['id_mod']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header('location:consulter.php');
}
if (isset($_POST['btnok'])) {
    $sql = 'UPDATE informations SET nom = :nom,prenom= :prenom,
    date_de_naissance=:datenais, 
    sexe=:sexe,
    nationalite=:nationalite,
    annee_bac=:annee_bac,
    serie_bac=:serie_bac,
    where id_candidature =  :id';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $_POST['nom']);
    $stmt->bindParam(':prenom', $_POST['prenom']);
    $stmt->bindParam(':datenais', $_POST['date_de_naissance']);
    $stmt->bindParam(':sexe', $_POST['sexe']);
    $stmt->bindParam(':nationalite', $_POST['nationalite']);
    $stmt->bindParam(':annee_bac', $_POST['annee_bac']);
    $stmt->bindParam(':serie_bac', $_POST['serie_bac']);
    $stmt->bindParam(':id', $_POST['id_mod']);
    $stmt->execute();
    
    header('location:consulter.php?msg=Modification validé');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Candidature.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="exercice1.js"></script>
</head>
<body class="corp">
    <!-- Barre de navigation -->
    <div class="entete">
        <a href="bienvenu.html"><img src="logoiai.jpg" alt="Logo de l'école" class="school-logo"></a>
        <p class="titre">IAI-TOGO</p>
        <div class="header-buttons">
            <a class="boutton" href="acceuil2.php">Retour &agrave; l'accueil</a>
        </div>
    </div>
<center>
<div class="conteneur">
<form action="Modifier.php" method="POST" enctype="multipart/form-data">
        <table >
            <tr>
                <td class="td1">
                    <center><p class="p1">Modifier le formulaire pour soumettre votre candidature</p></center>
                    <hr color="#3f5954">
                </td>
            </tr>
            <tr>
                <td>
                    <div class="contient">
                        <div><p><i>Informations personnelles</i></p></div>
                        <div class="mb-4">
                            <label for="nom" class="form-label">Nom:</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $row['nom']; ?>">
                            <input type="hidden" name="id_mod" id="id_mod" value="<?php echo $_POST['id_mod'] ?>">
                        </div>
                        <div class="mb-4">
                            <label for="prenom" class="form-label">Prenoms:</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $row['prenom']; ?>">
                            <input type="hidden" name="id_mod" id="id_mod" value="<?php echo $_POST['id_mod'] ?>">
                        </div>
                        <div class="mb-4">
                            <label for="datenais" class="form-label">Date de naissance:</label><br>
                            <span id="date_n" ></span>
                            <input type="date" class="form-control" id="date" name="datenais"  value="<?php echo $row['date_de_naissance']; ?>">
                            <input type="hidden" name="id_mod" id="id_mod" value="<?php echo $_POST['id_mod'] ?>">

                        </div>
                        <div class="mb-4">
                            <label for="sex" class="form-label">Sexe:</label>
                            <select class="form-control" id="sex" name="sex" value="">
                                <option selected disabled><?php echo $row['sexe']; ?></option>
                                <option value="M" name="sex">M</option>
                                <option value="F"name="sex">F</option>
                            </select>
                            <input type="hidden" name="id_mod" id="id_mod" value="<?php echo $_POST['id_mod'] ?>">
                        </div>
                        <div class="mb-4">
                            <label for="nation" class="form-label">Nationalité:</label>
                            <input type="text" class="form-control" id="nation" name="nation" value="<?php echo $row['nationalite']; ?>">
                            <input type="hidden" name="id_mod" id="id_mod" value="<?php echo $_POST['id_mod'] ?>">

                        </div>
                        <div class="mb-4">
                            <label for="anneebac" class="form-label">Année d'obtention du BAC:</label><br>
                            <span id="verif_an"></span>
                            <input type="text" class="form-control" id="anneebac" name="anneebac" value="<?php echo $row['annee_bac']; ?>">
                            <input type="hidden" name="id_mod" id="id_mod" value="<?php echo $_POST['id_mod'] ?>">

                        </div>
                        <div class="mb-4">
                            <label for="serie" class="form-label">Série du BAC:</label>
                            <select class="form-control" id="serie" name="serie" >
                                <option selected disabled><?php echo $row['serie_bac']; ?></option>
                                <option value="C" name="serie">C</option>
                                <option value="D" name="serie">D</option>
                                <option value="E" name="serie">E</option>
                                <option value="F1" name="serie">F1</option>
                                <option value="F2" name="serie">F2</option>
                            </select>
                            <input type="hidden" name="id_mod" id="id_mod" value="<?php echo $_POST['id_mod'] ?>">
                        </div>
                    </div>
                    
                <tr>
                <td>
                   <center>
                    <button type="submit" class="btn btn-primary" name="btnok" id="btnok">Soumettre</button>
                    </center> 
                </td>
            </tr>
            </tr>
            
        </table>
            </div><br>
    </form>
    </div>
</center>
    <footer>
        <div class="footer">
            <div class="div4">
                <center>
                <img src="logoiai.jpg" alt="" class="school-logo">
                <p>La r&eacute;f&eacute;rence en mati&egrave;re d'informatique</p>
            </center>
            </div>
            <div class="div5">
                <p>Contactez-nous:</p>
                <div class="contact-icons">
                    <ul><li><a class="boutton2" href="tel:+22822212706"><i class="fa fa-phone"> (00228) 22212706</i></a></li>
                        <li><a class="boutton2"href="tel:+22822204700"><i class="fa fa-phone"> (00228) 22204700</i></a></li>
                        <li><a class="boutton2" href="mailto:iaitogo@yahoo.fr"><i class="fa fa-envelope"> iaitogo@yahoo.fr</i></a></li>
                        <li><a class="boutton2" href="mailto:iaitogo@iai-togo.tg"><i class="fa fa-envelope"> iaitogo@iai-togo.tg</i></a></li>
                    </ul>
                </div> 
            </div>
            <div class="div5">
                <p>Suivez nous:</p>
                <div class="contact-icons">
                    <ul>
                        <li><a class="boutton2" href="https://www.instagram.com/iaitogo_officiel" target="_blank"><i class="fa fa-instagram"> iaitogo_officiel</i></a></li>
                    </ul>
                </div> 
                <p>Localisation</p>
                <div class="contact-icons">
                    <ul>
                        <li> <a class="boutton2" href="https://maps.app.goo.gl/qT9jruKGCFFQPzWG9" target="_blank"><i class="fa fa-map-marker">59 rue de la Kozah Nyékonakpoè</i></a></li>
                    </ul>
                </div> 
            </div>
            <div class="div5">
                <p>Liens rapides:</p>
                <div class="contact-icons">
                    <ul>
                        <li><a class="boutton2" href="acceuil2.php">Retour &agrave; l'accueil</a></li>


                        
                    </ul>
                </div> 
            </div>
        </div>
    </footer>
</body>

</html>