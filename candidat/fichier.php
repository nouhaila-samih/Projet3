<?php 
//session_start();
// Connexion à la base de données MySQL avec PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recjob";


// Connexion à la base de données MySQL avec PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recjob";
try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}


if (isset($_POST["ajouter"])) {

    $domaine = $_POST['domaine'];
    $localisation = $_POST['localisation'];
    $poste = $_POST['poste'];

    // Requête SQL pour récupérer les offres correspondantes
    $sql = "SELECT * FROM offre_emploi WHERE domaine='$domaine' AND localisation ='$localisation' AND poste ='$poste'";
    $stmt = $bdd->query($sql);

    // Vérification du résultat

    if ($stmt->rowCount() > 0) {
                     

        while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {

           
            echo "<div style=\" margin:1em; padding:1em; display:flex; border-radius: 10px; background-color: rgba(255,255,255,0.5);\">";
            echo"<div style=\" margin-top:2em;\">";
            if ($ligne["type_contrat"] == 'emp') {
                echo "<img width=200 src=\"emploi.jpeg\">";
            } elseif ($ligne["type_contrat"] == 'st-pre') {
                echo "<img width=200 src=\"pre.png\">";
            }
            echo"</div>";
            echo "<div style=\"margin:2em;\"><h4>" . htmlspecialchars($ligne["poste"]) . " -- ". htmlspecialchars($ligne["nom_entreprise"]) ."</h4>";
            echo "<span style=\"font-weight:bold; text-decoration:underline;\"> " . htmlspecialchars($ligne["localisation"])."</span>";
            echo "<br><br><span style=\"border:1px solid black; padding:2px;border-radius:7px; 
            margin-top:5px;margin-bottom:5px;\" >" . htmlspecialchars($ligne["salaire"]) . " Dhs</span>";
            echo "<br>" . htmlspecialchars($ligne["duree"]). " mois";
            echo "<br>" . htmlspecialchars($ligne["descr"]) . "</div>";
            echo "<div>";
           // echo "<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">";
            echo "<button style=\"border: none; outline: none;height: 50px;float:right; ;width:100%;background-color: rgb(47, 47, 170);color: white;border-radius: 4px;font-weight: bold;\"  type=\"submit\" id=\"postuler\"  name=\"postuler\"  \">Postuler</button>";
           // echo "</form>";
            echo "</div>";
            echo "</div>";
                
            $_SESSION['id_recruteur'] = $ligne["id_recruteur"];
            $_SESSION['id_offre']= $ligne["id_offre"];
            //echo  $_SESSION['id_recruteur'];
            //echo $_SESSION['id_offre'];
        
        }

    } else {

        echo "Aucun offre d'emploi à afficher.";

    }
    

}


// Boucle "while" pour exécuter le code à chaque fois que le bouton "postuler" est cliqué
while(isset($_POST['postuler'])) {
    // Récupération des valeurs de id_candidat et id_recruteur depuis $_SESSION et $ligne
    $id_candidat = $_SESSION['candidat'];
    $id_recruteur = $_SESSION['id_recruteur'];
    $id_offre = $_SESSION['id_offre'];

    // Vérifier si l'enregistrement existe déjà dans la base de données
    $query = "SELECT * FROM postulation WHERE id_candidat=:id_candidat AND id_recruteur=:id_recruteur AND id_offre=:id_offre";
    $result = $bdd->prepare($query);
    $result->bindParam(':id_candidat', $id_candidat);
    $result->bindParam(':id_recruteur', $id_recruteur);
    $result->bindParam(':id_offre', $id_offre);
    $result->execute();
    
    // Si l'enregistrement n'existe pas, insérez-le dans la base de données
    if ($result->rowCount() == 0) {
        $insert = $bdd->prepare("INSERT INTO postulation (id_candidat, id_recruteur, id_offre) VALUES(:id_candidat, :id_recruteur, :id_offre)");
        $insert->bindParam(':id_candidat', $id_candidat);
        $insert->bindParam(':id_recruteur', $id_recruteur);
        $insert->bindParam(':id_offre', $id_offre);
        $insert->execute();
        echo '<p style="color:green;">Votre candidature a été envoyée avec succès!</p>';
    } else {
        // Si l'enregistrement existe déjà, afficher un message d'erreur
        echo '<p style="color:red;">Vous avez déjà postulé pour cette offre!</p>';
    }
    
    // Mettre en pause le script pendant une courte période pour éviter une surcharge du serveur
   break;
}





//else {
    // Afficher le message par défaut à côté du bouton
   // echo '<p style="color:red;">Pas encore postulé!</p>';
//} 


?>

