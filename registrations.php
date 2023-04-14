<?php

include 'database_connect.php';

if(isset($_POST['submit'])){

    $names = mysqli_real_escape_string($db, $_POST['names']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, $_POST['password']);
    $cpass = mysqli_real_escape_string($db, $_POST['cpassword']);
    $user_type = $_POST['user_type'];
 
    $select_users = mysqli_query($db, "SELECT * FROM `registration` WHERE email = '$email' AND password = '$pass'") or die('query failed');
 
    if(mysqli_num_rows($select_users) > 0){
       $message[] = 'Sorry, user email already exist!';
    }else{
       if($pass != $cpass){
          $message[] = 'Confirm password not matched!';
       }else{
          mysqli_query($db, "INSERT INTO `registration`(names, email, password, user_type) VALUES('$names', '$email', '$cpass', '$user_type')") or die('query failed');
          $message[] = 'Your registration was successful!';
       }
    }
 
 }

if(isset($_POST['login'])){

   $email = mysqli_real_escape_string($db, $_POST['email']);
   $pass = mysqli_real_escape_string($db, $_POST['password']);

   $select_users = mysqli_query($db, "SELECT * FROM `registration` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'Admin'){

         $_SESSION['email'] = $row['email'];
         $_SESSION['names'] = $row['names'];
         $_SESSION['user_type'] = $row['user_type'];
         $_SESSION['contacts'] = $row['contacts'];
         $_SESSION['country'] = $row['country'];
         $_SESSION['address'] = $row['address'];
         $_SESSION['password'] = $row['password'];
         $_SESSION['datecreated'] = $row['datecreated'];
         header('location:admin-home.php');

      }elseif($row['user_type'] == 'Member'){

         $_SESSION['email'] = $row['email'];
         $_SESSION['names'] = $row['names'];
         $_SESSION['user_type'] = $row['user_type'];
         $_SESSION['contacts'] = $row['contacts'];
         $_SESSION['country'] = $row['country'];
         $_SESSION['address'] = $row['address'];
         $_SESSION['password'] = $row['password'];
         $_SESSION['datecreated'] = $row['datecreated'];
         header('location:home.php');

      }

   }else{
      $message[] = 'Incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<!-- === Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="tyle.css">
         
    <!--<title>Login & Registration Form</title>-->
</head>
<body>
    
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>

                <form action="" method="post">
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        
                        <a href="#" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="login" value="login now" class="btn">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="#" class="text signup-link">Signup Now</a>
                    </span>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="form signup">
                <span class="title">Registration</span>

                <form action="" method="post">
                    <div class="input-field">
                        <select name="user_type"  class="input-field" style="border-radius: 3px; border: 1px solid powderblue;">
                            <option name="Admin">Admin</option>
                            <option name="Member">Member</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <input type="text" name="names" placeholder="Enter your name" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Create a password" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="cpassword" class="password" placeholder="Confirm a password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="termCon">
                            <label for="termCon" class="text">I accepted all terms and conditions</label>
                        </div>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" value="register now" class="btn">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Already a member?
                        <a href="#" class="text login-link">Login Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    
    
    

</body>


</html>
