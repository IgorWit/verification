<?php
session_start();
require_once 'dbconfig.php';

if(isset($_POST['btn-login']))
{
$user_name1 = $_POST['user_name'];
$user_password = trim($_POST['password']);
$password = ($user_password);
$atmp = 0;

try
{	
$stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_name=:user_name");
$stmt->execute(array(":user_name"=>$user_name1));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();


if($atmp<=3){
    if($row['user_password']==$password){
        echo "ok"; // log in
            $_SESSION['user_session'] = $row['user_id'];
        }
        else{
            $atmp++;
            echo "Username or password does not exist."; // wrong details
        }
    }
    else echo "You possible attempt times exceed ".$atmp." try it later";
}
catch(PDOException $e){
    echo $e->getMessage();
}
}

?>