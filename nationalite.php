<?php include_once("connection.php");
$sql = "SELECT*FROM informations";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql4="SELECT count(*) as Nb from informations";
$stmt4=$conn->prepare($sql4);
$stmt4->execute();
$resultat4 = $stmt4->fetch(PDO::FETCH_ASSOC);
$sql2="SELECT count(*) as Femme from informations where sexe='F'";
$sql3="SELECT count(*) as Homme from informations where sexe='M'";
$stmt2=$conn->prepare($sql2);
$stmt3=$conn->prepare($sql3);
$stmt2->execute();
$stmt3->execute();
$resultat2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$resultat3 = $stmt3->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page d'accueil</title>
    <script src="menu.js"></script>
    <link rel="stylesheet" href="Dashboard.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-e1lU4ZbF3wZnu8bSRXKGvHKLb9AOnVXwyDQc2FkgzAPxZ9fGEiAMwkEl3A/g9Cc" crossorigin="anonymous">
</head>

<body>
    <!-- Barre de navigation -->
    <div class="entete">
        <a href="bienvenu.html"><img src="../logoiai.jpg" alt="Logo de l'école" class="school-logo"></a>
        <p class="titre">IAI-TOGO</p>
        <div class="header-buttons">
            <a class="boutton" href="connect.php">Voir statistiques</a>
            <div class="menu-icon" onclick="toggleMenu()">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>

            <div class="menu-content" id="menu">
                <a href="dashboard.php">Tous les candidats</a>
                <a href="feminin.php">Les candidats F&eacute;minins</a>
                <a href="masculin.php">Les candidats Masculins</a>
                <a href="nationalite.php">Les candidats par nationalit&eacute</a>
                <a href="deux_fois.php">Les candidats doublements <br>inscrits</a>
                <a href="Manquant.php">Les candidats ayant <br>des dossiers manquants</a>
                <!-- Ajoutez d'autres options de menu ici -->
            </div>
        </div>
    </div>
    <div class="conteneur1">
        <div class="carree">
            <p class="para1"> <center>DATE DU CONCOURS</center> </p>
            <HR color="#f9f990">
            </HR><br>
            <p class="para">02 Septembre 2023</p>
        </div>
        <div class="carree">
            <p class="para1"> <center>LIMITE DU DEPOT DES DOSSIERS</center></p>
            <HR color="#f9f990"><br>
            <p><a href="" class="bout1">Fixer une date</a></p>
        </div>
        <div class="carree">
            <p class="para1"> <center>NOMBRE TOTAL DE CANDIDATS</center> </p>
            <HR color="#f9f990">
            <br><?php echo $resultat4["Nb"]?>
        </div>
        <div class="carree">
            <p class="para1"> <center>NOMBRE DE CANDIDATS PAR SEXE</center> </p>
            <HR color="#f9f990">
            <table>
                <tr>
                    <th>Masculin: <?php echo $resultat3["Homme"] ?></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Feminin: <?php echo $resultat2["Femme"] ?></th>
                    <td></td>
                </tr>
            </table>
        </div>
    </div><br>
    <div class="conteneur2">
        <center><p class="p1">Listes de tous les candidats inscrits</p></center>
        <br>
    <table class="table">
        <tr>
            <th class="th1">Identifiant</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Date de naissance</th>
            <th>Sexe</th>
            <th>Nationalité</th>
            <th>Année du BAC</th>
            <th>Série</th>
            <th>Photo</th>
            <th>Acte de naissance</th>
            <th>Certificat de nationalité</th>
            <th>Attestation du Bac</th>
        </tr>
        <?php foreach ($resultat as $row): ?>
            <tr>
                <td><?php echo $row['id_candidature']?></td>
                <td><?php echo $row['nom']?></td>
                <td><?php echo $row['prenom']?></td>
                <td><?php echo $row['date_de_naissance']?></td>
                <td><?php echo $row['sexe']?></td>
                <td><?php echo $row['nationalite']?></td>
                <td><?php echo $row['annee_bac']?></td>
                <td><?php echo $row['serie_bac']?></td>
                <td><a class="a1" href="fichiers/attestations/<?php echo $row['attestation_pdf']?>"><?php echo $row['attestation_pdf']?></a></td>
                <td><a class="a1" href="fichiers/naissances/<?php echo $row['naissance_pdf']?>"><?php echo $row['naissance_pdf']?></a></td>
                <td><a class="a1" href="fichiers/nationalite/<?php echo $row['nationalite_pdf']?>"><?php echo $row['nationalite_pdf']?></a></td>
                <td><a class="a1" href="fichiers/attestations/<?php echo $row['attestation_pdf']?>"><?php echo $row['attestation_pdf']?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<br>
    <footer>
        <div class="footer">
            <div class="div4">
                <center>
                    <img src="../logoiai.jpg" alt="" class="school-logo">
                    <p>La r&eacute;f&eacute;rence en mati&egrave;re d'informatique</p>
                </center>
            </div>
            <div class="div5">
                <p>Contactez-nous:</p>
                <div class="contact-icons">
                    <ul>
                        <li><a class="boutton2" href="tel:+22822212706"><i class="fa fa-phone"> (00228) 22212706</i></a></li>
                        <li><a class="boutton2" href="tel:+22822204700"><i class="fa fa-phone"> (00228) 22204700</i></a></li>
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
                        <li><a class="boutton2" href="inscription.php">Cr&eacute;er un compte</a></li>
                        <li><a class="boutton2" href="">Se connecter</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>