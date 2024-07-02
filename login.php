<?php
include("connection.php");

if (isset($_POST['nom']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['nom']);
    $pass = validate($_POST['password']);

    if (empty($name) || empty($pass)) {
        header("location: inscription.php?error= Nom d'utilisateur et mot de passe requis");
        exit();
    }

    // Utilisation de déclarations préparées pour l'insertion
    $script = "INSERT INTO inscriptions (username, mot_de_passe) VALUES (:name, :pass)";

    try {
        $statement = $conn->prepare($script);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':pass', $pass);
        $statement->execute();

        echo "Enregistrement réussi.";
    } catch (PDOException $e) {
        echo "Erreur d'insertion : " . $e->getMessage();
    }

    // Démarrer la session
    session_start();

    // Stocker le nom d'utilisateur dans la session
    $_SESSION['username'] = $name;
    $_SESSION['message'] = "Bienvenue, $name ! Vous venez de créer votre compte. Connectez-vous pour accéder à votre page.";
    header("Location: connect.php");
} else {
    header("location: inscription.php");
    exit();
}
?>
