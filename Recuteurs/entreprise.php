
<?php session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recjob";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Connexion réussie";
} catch(PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}

// Récupération des données soumises par le formulaire
if (isset($_POST["final"])) {
    $nom_entreprise= $_POST['nom_entreprise'];
    $domaine= $_POST['domaine'];
    $localisation= $_POST['localisation'];

    $sql="SELECT MAX(id_recruteur) as id_recruteur FROM recruteur";
        $query=$conn->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $id_recruteur = $row['id_recruteur'];
 


        $insertion = "INSERT INTO entreprise (nom_entreprise, domaine, localisation, id_recruteur) VALUES (:nom_entreprise, :domaine, :localisation, :id_recruteur)";
        $requete = $conn->prepare($insertion);

        $requete->bindParam(":nom_entreprise", $nom_entreprise);
        $requete->bindParam(":domaine", $domaine);
        $requete->bindParam(":localisation", $localisation);
        $requete->bindParam(":id_recruteur", $id_recruteur);

        

        if ($requete->execute()) {
                header("Location: acc.html");

        } else {
            echo "Erreur : ". $requete->errorInfo()[2];
        }
    

}else {

}

?>