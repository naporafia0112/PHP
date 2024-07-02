<?php
include_once('connection.php'); 
session_start();
$name=$_SESSION['username'];
if(isset($_POST['supprimer'])) {
    $id_candidature = $_POST['id_candidature'];
    $sql = "DELETE FROM informations WHERE username = :name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    if($stmt->rowCount()==0) {
        header("Location: Confirmation_Suppression.html");
    } 
}
?>
