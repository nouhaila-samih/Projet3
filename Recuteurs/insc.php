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
if (isset($_POST["ajouter"])) {
    $nom_recrut = $_POST["nom_recrut"];
    $prenom_recrut = $_POST["prenom_recrut"];
    $telephone_recrut = $_POST["telephone_recrut"];
    $email_recrut = $_POST["email_recrut"];
    $pswd_recrut = $_POST["pswd_recrut"];

    // Insertion des données du formulaire dans la table "contacts"
    $insertion = "INSERT INTO recruteur (nom_recrut, prenom_recrut, telephone_recrut, email_recrut, pswd_recrut) VALUES (:nom_recrut, :prenom_recrut, :telephone_recrut, :email_recrut, :pswd_recrut)";
    $requete = $conn->prepare($insertion);

    $requete->bindParam(":nom_recrut", $nom_recrut);
    $requete->bindParam(":prenom_recrut", $prenom_recrut);
    $requete->bindParam(":telephone_recrut", $telephone_recrut);
    $requete->bindParam(":email_recrut", $email_recrut);
    $requete->bindParam(":pswd_recrut", $pswd_recrut);

    
    if ($requete->execute()) {

        $sql="SELECT MAX(id_recruteur) as id_recruteur FROM recruteur";
        $query=$conn->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $id_recruteur = $row['id_recruteur'];
        $ins="INSERT INTO score(sc_exp,sc_dip,sc_comp,id_recruteur) VALUES(1,1,1,'$id_recruteur') ";
        $requete = $conn->prepare($ins);
        $requete->execute();
                            
        $_SESSION['id']=$id_recruteur;
         header("Location: acc.html");


    } else {
        echo "Erreur : ". $requete->errorInfo()[2];
    }

}


?>