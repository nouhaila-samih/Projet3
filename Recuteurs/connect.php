<?php session_start();
                try
                {
                    $conn = new PDO('mysql:host=localhost;dbname=recjob;charset=utf8', 'root', '');
                }
                catch (PDOException $e)
                {
                        die('Erreur : ' . $e->getMessage());
                }
                
               
if(isset($_POST["login"])){
    if($_POST["email_recrut"]=="" or $_POST["pswd_recrut"]==""){
       echo "<p><span style='color:red; font-weight: bold;'>Email or password can't be empty !</span></p>";
 
    }else{
       
        $email_recrut=$_POST["email_recrut"];
        $pswd_recrut=$_POST["pswd_recrut"];
        $sql="SELECT * FROM recruteur WHERE email_recrut='$email_recrut' AND pswd_recrut='$pswd_recrut'";
        $query=$conn->query($sql);

        $id="SELECT id_recruteur as id_recruteur FROM recruteur WHERE email_recrut='$email_recrut'";
        $test=$conn->query($id);
        $row = $test->fetch(PDO::FETCH_ASSOC);
        $id_recruteur = $row['id_recruteur'];

        if($query->rowCount()>0){
        if($country = $query->fetch()) { 
        
            $_SESSION['id']=$id_recruteur ;}
            header("Location: acc.html");
            
            
        }else {
          echo "<p><span style='color:red; font-weight: bold;'>Incorrect Email or Password !</span></p>";
        }
    }
        
        
    }
//echo $_SESSION['']
 
?>