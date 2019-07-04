<?php
$firstname = "";
$lastname = "";
$email = "";
$errors = array();




// connect to the database
$db = mysqli_connect('localhost', 'root', 'online@2017', 'club_foot');

//if the register button is clicked
if (isset($_POST['register'])) {
$firstname  = mysql_real_escape_string($_POST['firstname']);
$lastname  = mysql_real_escape_string($_POST['lastname']);
$email  = mysql_real_escape_string($_POST['email']);
$password_1 = mysql_real_escape_string($_POST['password_1']);
$password_2 = mysql_real_escape_string($_POST['password_2']);


if (empty($firstname)) {
    array_push($errors, "prenom necessaire"); //add error to errors array

}
if (empty($lastname)) {
    array_push($errors, "Nom necessaire"); //add error to errors array

}
if (empty($email)) {
    array_push($errors, "email necessaire"); //add error to errors array

}
if (empty($password_1)) {
    array_push($errors, "Mot de passe necessaire"); //add error to errors array

}
if (empty($password_1 != $password_2)) {
    array_push($errors, "les 2 mot de passe sont différents"); //add error to errors array

}

//if there are no errors, save user to database

if (count($errors) == 0){
    $password = md5($password_1); //encrypt password before storing in  database (security)
    $sql = "INSERT INTO users (firstname, lastname, email, password)
     VALUES ('$firstname', '$lastname','$email', '$password')";
     mysqli_query($db, $sql);
     $_SESSION['firstname'] = $firstname;
     $_SERVER['success'] = "vous êtes maintenant connecté" ;
     header('location : home.php'); //redirection vers Home page(page principal)
}
}
?>