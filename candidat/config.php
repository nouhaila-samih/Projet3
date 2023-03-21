
<?php session_start();

//_SESSION['id_candidat'];
//include "insconfig.php";
// Connexion à la base de données MySQL avec PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recjob";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$id_candidat = $// Récupération de la valeur de la colonne auto-incrémentée

$sql="SELECT MAX(id_candidat) as id_candidat FROM candidat";

$query=$conn->query($sql);

$row = $query->fetch(PDO::FETCH_ASSOC);

$id_candidat = $row['id_candidat'];


//////////////////////////////////////////

 // Récupération des données soumises par la partie experionses
if (isset($_POST["ajoutexpe"])) {
 
    $nom_exp = $_POST["nom_exp"];
    $debut_exp = $_POST["debut_exp"];
    $fin_exp= $_POST["fin_exp"];
    $details_exp = isset($_POST['details_exp']) ? $_POST['details_exp'] : "";
    $nom_entreprise = isset($_POST['nom_entreprise']) ? $_POST['nom_entreprise'] : "";

    // Insertion des données du formulaire dans la table experionse
    
    $insertion1 = "INSERT INTO experience (nom_exp, debut_exp, fin_exp, details_exp, id_candidat, nom_entreprise) VALUES (:nom_exp, :debut_exp, :fin_exp, :details_exp, :id_candidat, :nom_entreprise)";


    $requete1 = $conn->prepare($insertion1);

    $requete1->bindParam(":id_candidat", $id_candidat);
    $requete1->bindParam(":nom_exp", $nom_exp);
    $requete1->bindParam(":debut_exp", $debut_exp);
    
    $requete1->bindParam(":fin_exp", $fin_exp);
    $requete1->bindParam(":details_exp", $details_exp);
    $requete1->bindParam(":nom_entreprise", $nom_entreprise);
    if ($requete1->execute()) {
      //  echo "Les données1 ont été insérées avec succès.";
    } else {
        echo "Erreur : ". $requete1->errorInfo()[2];

    }



} else {
        //echo "Les données n'ont pas été envoyées par le formulaire.";
}








// Récupération des données soumises par la partie diplome

if (isset($_POST["ajoutdip"])) {
  
    $nom_dip =  isset($_POST['nom_dip']) ? $_POST['nom_dip'] : "";
    $nom_institut = isset($_POST['nom_institut']) ? $_POST['nom_institut'] : "";
    $debut_dip= isset($_POST['debut_dip']) ? $_POST['debut_dip'] : "";
    $fin_dip = isset($_POST['fin_dip']) ? $_POST['fin_dip'] : "";
    

    // Insertion des données du formulaire dans la table "diplome"
    
    $insertion2 = "INSERT INTO diplome (nom_dip, nom_institut, debut_dip, fin_dip, id_candidat) VALUES (:nom_dip, :nom_institut, :debut_dip, :fin_dip, :id_candidat)";


    $requete2 = $conn->prepare($insertion2);

    $requete2->bindParam(":nom_dip", $nom_dip);
    $requete2->bindParam(":nom_institut", $nom_institut);
    $requete2->bindParam(":debut_dip", $debut_dip);
    $requete2->bindParam(":fin_dip", $fin_dip);
    $requete2->bindParam(":id_candidat", $id_candidat);

    if ($requete2->execute()) {
       // echo "Les données2 ont été insérées avec succès.";
    } else {
        echo "Erreur : ". $requete2->errorInfo()[2];

    }

} else {
    //echo "Les données n'ont pas été envoyées par le formulaire.";
}












// Récupération des données soumises par la partie competence

if (isset($_POST["ajoutcomp"])) {
    
 
    $nom_comp =  isset($_POST['nom_comp']) ? $_POST['nom_comp'] : "";
    $details_comp = isset($_POST['details_comp']) ? $_POST['details_comp'] : "";

    

    // Insertion des données du formulaire dans la table competence
    
    $insertion3 = "INSERT INTO competence (nom_comp, details_comp, id_candidat) VALUES (:nom_comp, :details_comp, :id_candidat)";

    $requete3 = $conn->prepare($insertion3);

    $requete3->bindParam(":nom_comp", $nom_comp);
    $requete3->bindParam(":details_comp", $details_comp);
    $requete3->bindParam(":id_candidat", $id_candidat);

    if ($requete3->execute()) {
       // echo "Les données3 ont été insérées avec succès.";
    } else {
        echo "Erreur : ". $requete3->errorInfo()[2];

    }

} else {
    //echo "Les données n'ont pas été envoyées par le formulaire.";
}


?>