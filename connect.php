<?php
defined ('BASEPATH') OR exit ('No direct script access allowed');

$host = '127.0.0.1';
$user = 'root';
$password = '';
$dbname = 'registration';
$dsn = '';

try {

    $dsn = 'mysql:host='.$host. ';dbname='.$dbname;
    
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e){
    echo 'connection failed: '.$e->getMessage();
}
 ?>