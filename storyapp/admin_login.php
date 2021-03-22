<<?php 
session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Administrator Login Page</h1></br>
      

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
            <form action="admin_login.php" method="post">
               <?php if(isset($_SESSION['message'])){
                   echo $_SESSION['message'];
                   unset($_SESSION['message']);
               }
               else{
                   echo "";
               }
               ?>
                <p>Username <br> 
                <input type="text" placeholder= "Enter Username" name="username" id= "user" required></p>
                <p>Password <br> <input type="password" placeholder="Password" name="password" id="password" required></p>
                <button type="submit" name="submit">Login</button>
            </form>

</div>
</body>
</html>
<?php
    if(isset($_POST['submit'])){
        require_once('connection.php');
        $username =$_POST['username'];
        $password = $_POST['password'];

        $sql="Select * from admin where username = '$username' AND password='$password'";
        $query = mysqli_query($link, $sql);
        if(mysqli_num_rows($query)==0){
            $_SESSION['message'] = "Wrong username or password";
            echo $_SESSION['message'];
        }else{
           $row = mysqli_fetch_array($query);
           $_SESSION['user'] = $row['username'];
           header('location: admin.php');
    }
}

