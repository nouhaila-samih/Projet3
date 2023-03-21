<?php session_start();
    // Connexion à la base de données MySQL avec PDO
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
if (isset($_POST["sub"])) {
    $poste = $_POST["poste"];
    $nom_entreprise = $_POST["nom_entreprise"];
    $domaine = $_POST["domaine"];
    $type_contrat = $_POST["type_contrat"];
    $duree = $_POST["duree"];
    $localisation = $_POST["localisation"];
    $salaire = $_POST["salaire"];
    $descr = $_POST["descr"];
    $id_recruteur= $_SESSION['id'];

    // Insertion des données du formulaire dans la table "contacts"
    $insertion = "INSERT INTO offre_emploi (poste, nom_entreprise, domaine, type_contrat, `duree`, localisation, salaire, descr, id_recruteur) VALUES (:poste, :nom_entreprise, :domaine, :type_contrat, :duree, :localisation, :salaire, :descr, :id_recruteur)";
    $requete = $conn->prepare($insertion);

    $requete->bindParam(":poste", $poste);
    $requete->bindParam(":nom_entreprise", $nom_entreprise);
    $requete->bindParam(":domaine", $domaine);
    $requete->bindParam(":type_contrat", $type_contrat);
    $requete->bindParam(":duree", $duree);
    $requete->bindParam(":localisation", $localisation);
    $requete->bindParam(":salaire", $salaire);
    $requete->bindParam(":descr", $descr);
    $requete->bindParam(":id_recruteur", $id_recruteur);


    if ($requete->execute()) {
        
         header("Location: mapage.php");

    } else {
        echo "Erreur : ". $requete->errorInfo()[2];
    }

}


?>