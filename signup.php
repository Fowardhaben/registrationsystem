<?php
include 'header.php';
include 'config.php';
//declare variable that will store the form data
$username =$email = $password ='';//empty variables
//username $_POST variable to grab the data
if (isset($_POST ['submitBtn'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if (empty ($username)){
        $error = "username can not be empty";
        header( 'location:signup.php?username_err='.$error);
        exit();
    }
    if (empty ($email)){
        $error = "email can not be empty";
        header( 'location:signup.php?email_err='.$error);
        exit();
    }
    if (empty ($password1)){
        $error = "password can not be empty";
        header( 'location:signup.php?password_err='.$error);
        exit();
    }
    if (empty ($password2)){
        $error = " confirm password can not be empty";
        header( 'location:signup.php?password_err='.$error);
        exit();
    }


    if ($password1 ==$password2){
        $password1 = md5($password2);

    }
//    check user exist in the  system, if true send user to login page
//    to check if user exist we need email and password

      $sql = "SELECT `email`, `password` FROM `users` WHERE email = '$email' AND password ='$password1'";
     $result =mysqli_query($conn,$sql);

     if(mysqli_num_rows($result)> 0){
         $messsage ="user already exist";
         header('location:login.php?success_$msg='.$messsage);
         exit();
     } else{

         $sql="INSERT INTO `users`(`id`,`username`, `email`, `password`) VALUES (NULL,'$username','$email','$password1')";
         if (mysqli_query($conn, $sql)) {
             $message ="signup succefull";
             header("location:login.php?success_msg=".$message);
             exit();

         } else {
             echo "Error:".$sql . "<br>".mysqli_error($conn);
         }

     }



}
//save  data in to data base

?>
<div class="container">
    <div class="col col-sm-12 col-md-3 col-lg-3 col-xl-3"></div>
    <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <div class="form-group">
                <?php
                     if (isset($_GET['username_err']))
                     {
                         $error = $_GET['username_err'];
                         echo '<div class= "alert alert-danger">';
                         echo "<p>$error</p>";
                         echo '</div>';
                     }
                     ?>

                <label for="username">username</label>
                <input type="text" name="username" placeholder="Enter username" class="form-control">
            </div>

            <div class="form-group">
                <?php
                if (isset($_GET['email_err']))
                {
                    $error = $_GET['email_err'];
                    echo '<div class= "alert alert-danger">';
                    echo "<p>$error</p>";;
                    echo '</div>';
                }
                ?>
                <label for="Email">email</label>
                <input type="email" name="email" placeholder="Enter email" class="form-control">
            </div>

            <div class="form-group">
                <?php
                if (isset($_GET['password_err']))
                {
                    $error = $_GET['password_err'];
                    echo '<div class= "alert alert-danger">';
                    echo "<p>$error</p>";
                    echo '</div>';
                }
                ?>
                <label  for="password">password</label>
                <input type="password" name="password1" placeholder="Enter password" class="form-control">
            </div>
            <div class="form-group">
                <?php
                if (isset($_GET['password_err']))
                {
                    $error = $_GET['password_err'];
                    echo '<div class= "alert alert-danger">';
                    echo "<p>$error</p>";
                    echo '</div>';
                }
                ?>
                <label  for="password"> confirm password</label>
                <input type="password" name="password2" placeholder="confirm password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submitBtn" class="btn btn-info btn-block" value="Register">
            </div>
        </form>
    </div>
    <div class="col col-sm-12 col-md-3 col-lg-3 col-xl-3"></div>
</div>

<?php include "footer.php"?>





