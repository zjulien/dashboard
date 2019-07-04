<?php 
 // to get values passe from form in login.php file
 $prename = $_POST['prenom'];
 $name = $_POST['nom'];
 $password = $_POST['password'];

 
 
 // to prevent mysql injection
 $prename = stripcslashes($prename);
 $name = stripcslashes($name);
 $password = stripcslashes($password);
 $prename = mysql_real_escape_string($prename);
 $name = mysql_real_escape_string($name);
 $password = mysql_real_escape_string($password);

 //connect to the server select database
 mysql_connect("localhost", "root", "");
 mysql_select_db("login");

 // Query the database for user
 $result = mysql_query("select * from login where prenom = '$prename' and nom = '$name' and password = '$password'")
  or die('Failed to query database'.mysql_error());
 $row = mysql_fetch_array($result);
 if ( $row['prenom'] == $prename && $row['password'] == $password && $row['nom'] == $name) {
  echo "connexion réussie! Bienvenue".$row['username'];
 } else {
     echo "Failed to login!";
}

?>