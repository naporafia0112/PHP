<?php
include_once("connection.php");
session_start();
if (isset($_POST['soumettre']) || ($_FILES["soumettre"])) {
    $username = $_SESSION['username'];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $naiss = $_POST["datenais"];
    $sex = $_POST["sex"];
    $nationalite = $_POST["nation"];
    $anBac = $_POST["anneebac"];
    $serie = $_POST["serie"];
    $photo = $_FILES["photo"]["name"];
    $naissance = $_FILES["actnaissans"]["name"];
    $nationalite_f = $_FILES["nationalite"]["name"];
    $attestation = $_FILES["attestation"]["name"];
    $images = "fichiers/photos/";
    $pdf_attestation = "fichiers/attestations/";
    $pdf_naissance = "fichiers/naissances/";
    $pdf_nationalite = "fichiers/nationalite/";
    $photo_temp = $_FILES["photo"]["tmp_name"];
    $naissance_temp = $_FILES["actnaissans"]["tmp_name"];
    $nationalite_temp = $_FILES["nationalite"]["tmp_name"];
    $attestation_temp = $_FILES["attestation"]["tmp_name"];
    move_uploaded_file($photo_temp, $images . $photo);
    move_uploaded_file($attestation_temp, $pdf_attestation . $attestation);
    move_uploaded_file($nationalite_temp, $pdf_naissance . $naissance);
    move_uploaded_file($attestation_temp, $pdf_nationalite . $nationaite_f);
    $sql = "INSERT INTO informations(username,nom,prenom,date_de_naissance,sexe,nationalite,annee_bac,serie_bac,photo_d_identite,naissance_pdf,nationalite_pdf,attestation_pdf) 
            VALUES (:username,:nom , :prenom,:datenais,:sex,:nation,:anneebac,:serie,:photo,:actnaissans,:nationalite,:attestation)";
    $stmt = $conn->prepare($sql);
    $params = array(
        ":username"=>$username,
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":datenais" => $naiss,
        ":sex" => $sex,
        ":nation" => $nationalite,
        ":anneebac" => $anBac,
        ":serie" => $serie,
        ":photo" => $photo,
        ":actnaissans" => $naissance,
        ":nationalite" => $nationalite_f,
        ":attestation" => $attestation
    );
    $stmt->execute($params);
    if ($stmt->rowCount() > 0) {
        header("Location:acceuil3.php");
    }
};
