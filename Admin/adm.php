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
    if($_POST["email_adm"]=="" or $_POST["pswd_adm"]==""){
       echo "<p><span style='color:red; font-weight: bold;'>Email or password can't be empty !</span></p>";
 
    }else{
       
        $email_adm=$_POST["email_adm"];
        $pswd_adm=$_POST["pswd_adm"];
        $sql="SELECT * FROM admin WHERE email_adm='$email_adm' AND pswd_adm='$pswd_adm'";
        $query=$conn->query($sql);

        $id="SELECT id_admin as id_admin FROM admin WHERE email_adm='$email_adm'";
        $test=$conn->query($id);
        $row = $test->fetch(PDO::FETCH_ASSOC);
        $id_admin = $row['id_admin'];

        if($query->rowCount()>0){
        if($country = $query->fetch()) { 
        
            $_SESSION['id']=$id_admin ;}
            header("Location: accA.php");
            
            
        }else {
          echo "<p><span style='color:red; font-weight: bold;'>Incorrect Email or Password !</span></p>";
        }
    }
        
        
    }
//echo $_SESSION['']
 
?>