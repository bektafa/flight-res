<?php
define('BASEPATH', true);
require 'connect.php';

if(isset($_POST['submit'])) {
    try{
        $dsn = new PDO("mysql:host=$host;dbname=$dbname",$user, $password);
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $pass = password_hash($pass,PASSWORD_BCRYPT, array("cost"=>12));
        
        $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email',$email);
        $stmt->execute();


        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if($row['num']>0) {
            echo '<script>alert("Email already exists");</script>';
        } else {
            $stmt = $dsn->prepare("INSERT INTO users (first_name, last_name, email, password) 
            VALUES (
                :first_name,:last_name,:email,:password

            )");
            $stmt->bindParam(':first_name',$f_name);
            $stmt->bindParam(':last_name',$l_name);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':password',$pass);

            if($stmt->execute()){

                echo '<script>alert("Registration successful");</script>';
            }else {
                $error = "Error: " .$e->getMessage();
                echo '<script>alert("'.$error.'");</script>';
            }
        }
    }catch(PDOException $e) {
        $error = "Error: " .$e->getMessage();
        echo '<script>alert("'.$error.'");</script>';
    }
}
?>