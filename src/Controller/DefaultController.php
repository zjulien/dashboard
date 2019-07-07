<?php 

namespace App\Controller;

use App\Application\Controller;
use App\Application\DatabaseConfig;

/* on pourrait écrire :
    use App\Application\Controller as lol;
    puis class DefaultController extends lol 
*/


class DefaultController extends Controller {

    // la fonction __construct est directement héritée de la classe mère


    function index () {
        
        return $this->twig->render('home.html.twig');
    }


}

// session_start();

// require 'db.php';

// $errors = array();
// $username = "";
// $email = "";

// //if user clicks on the sign up button

// if (isset($_POST['signup-btn'])){
// $username = $_POST['username'];
// $email = $_POST['email'];
// $password = $_POST['email'];
// $passwordConf = $_POST['passwordConf'];

// //validation
// if(empty($username)){
//     $errors['username'] = "Username required";
// }
// if(empty(!filer_var($email, FILTER_VALIDATE_EMAIL))){
//     $errors['email'] = "l'Email n'est pas valide";
// }
// if(empty($email)){
//     $errors['email'] = "Email required";
// }
// if(empty($password)){
//     $errors['password'] = "Password required";
// }
// if ($password !== $passwordConf){
//     $errors['password'] = "les deux mot de passe sont différents";
// }

// $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
// $stmt = $conn->prepare($emailQuery);
// $stmt->bind_param('s', $email);
// $stmt->execute();
// $result = $stmt->get_result();
// $userCount = $result->num_rows;
// $stmt->close();


// if($userCount > 0){
//     $errors['email'] = "Email already exists";
// }

// if(count($errors) === 0){
//     $password = password_hash($password, PASSWORD_DEFAULT);
//     $token = bin2hex(random_bytes(50));
//     $verified = false;

//     $sql = "INSERT INTO users (username, email, verified, token, password) VALUES (?, ?, ?, ?,?)";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param('ssbss',$username, $email, $verified, $token, $password);
    
//     if ($stmt->execute()) {
//         //login user
//         $user_id = $conn->insert_id;
//         $_SESSION['id'] = $user_id;
//         $_SESSION['username'] = $username;
//         $_SESSION['email'] = $email;
//         $_SESSION['verified'] = $verified;
//         //flash message
// $_SESSION['message'] = "vous êtes maintenant connecté";
// $_SESSION['alert-class'] = "alert-success";
// header('location: home.html.twig');
// exit();
//     } else {
//         $errors['db_error'] = "erreur base de donnée: fail de l'enregistrement";
//     }

// }






// }
