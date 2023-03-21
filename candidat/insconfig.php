
<?php //session_start(); 

// Connexion à la base de données MySQL avec PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recjob";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}

if (isset($_POST["inscrire"])) {
    // Récupération des données soumises par la partie informations personnelles


$nom_cand = $_POST["nom_cand"];
$prenom_cand = $_POST["prenom_cand"];
$ville_cand = $_POST["ville_cand"];
$email_cand = $_POST["email_cand"];
$telephone_cand = $_POST["telephone_cand"];
$psswd_cand = $_POST["psswd_cand"];
$date_cand = $_POST["date_cand"];

// Insertion des données du formulaire dans la table "candidat"
$insertion = "INSERT INTO candidat (nom_cand, prenom_cand, ville_cand, email_cand, telephone_cand, psswd_cand, date_cand) VALUES (:nom_cand, :prenom_cand, :ville_cand, :email_cand, :telephone_cand, :psswd_cand , :date_cand)";
$requete = $conn->prepare($insertion);

$requete->bindParam(":nom_cand", $nom_cand);
$requete->bindParam(":prenom_cand", $prenom_cand);
$requete->bindParam(":ville_cand", $ville_cand);
$requete->bindParam(":telephone_cand", $telephone_cand);
$requete->bindParam(":email_cand", $email_cand);
$requete->bindParam(":psswd_cand", $psswd_cand);
$requete->bindParam(":date_cand", $date_cand);



if ($requete->execute()) {
   $id="SELECT id_candidat  FROM candidat WHERE email_cand='$email_cand'";
        $test=$conn->query($id);
        $row = $test->fetch(PDO::FETCH_ASSOC);
        $id_candidat = $row["id_candidat"];

        if($requete->rowCount()>0){
        if($country = $requete->fetch()) { 

        $_SESSION['candidat']=$id_candidat;}
        header("Location: formul.php");

    
} else {
    echo "Erreur : " . $requete->errorInfo()[2];
}


}
}
?>

