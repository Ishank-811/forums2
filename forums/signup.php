<?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST'){

// include "conn.php";
$showAlert=false; 
$showError=false; 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $userna = $_POST['username'];
  $passwor= $_POST['password'];
  $cpassword = $_POST['cpassword']; 
  
  $userna= str_replace("<", "&lt;" ,  $userna);
  $userna= str_replace(">", "&gt;" ,  $userna);
  
// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "photos";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{ 
  $existsql = "Select * from forums where username='$userna'";
  $result = mysqli_query($conn , $existsql);
  $num1= mysqli_num_rows($result); 
  if($num1>0){
    $showError = " username already exist";
  }
  else{
  // Submit these to a database
  // Sql query to be executed 
  if($cpassword==$passwor){
 
   $sql = "INSERT INTO `forums` (`sno`, `username`, `password`, `dt`) VALUES (NULL, '$userna', '$passwor', current_timestamp());";
   $result = mysqli_query($conn, $sql);
 
   if ($result){
       $showAlert = true;
      header("location:login.php");
   }
}
else{
   $showError = "Passwords do not match";
}
}
}
}



?>

<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<style>
    body{
        background: linear-gradient(to right, #dd4271, #b4b4ae80);
        display: flex;
        align-items: center;
        justify-content: center;
        margin:auto;
        height:100vh;
    }
    .forms{
        display:flex; 
        flex-direction:column; 
    }
    form{
        display: flex;
        flex-direction: column;
        width:100%; 
 
      
    }
    form input{
        
        color:white; 
        background-color: #2e2e2e;
        height:40px;
        width:90%; 
        text-align:center;
    }
    form i {
        color:white;
        position: relative;
        left:20px;
        
    }
    .submit{
        margin-top:40px!important;
        width:170px;
        margin:auto;
        background-color:  #2e2e2e; 
        border-radius:20px;
        border-color:hsl(342, 70%, 56%); 
        color:#dd4271 ; 
        font-size: 20px;
        height:30px; 
        cursor: pointer;
    }
    
    .forms{
       
        height: 60vh;
        width:25%; 
        background-color:#000000ba;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    form h1{
        font-size:20px;
        color:azure;
        font-family:Arial, Helvetica, sans-serif;
        margin:auto;
        margin-bottom:20px;
    }
   
</style>
<body>

 <div class="forms">
 <?php
if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>'.$showError.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
   </button>
   </div>';
   }
?>
<form action="/forums/signup.php" method="post">
    <h1>Sign-up to your account</h1>
    <div>
    <i class="fa fa-user"></i>
    <input type="text" name="username" id="username" placeholder="Username"></input></div>
    <div>
        <i class="fa fa-lock"></i>
    <input type="password" name="password" id="username" placeholder="password"></input>
    </div>
    <div>
        <i class="fa fa-lock"></i>
    <input type="password" name="cpassword" id="username" placeholder="confirm password*"></input>
    </div>
    <button  class="submit">signup</button>
    
</form>
</div>
 

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>