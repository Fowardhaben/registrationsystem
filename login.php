<?php
include 'header.php';
include 'config.php';
//declare variable that will store the form data
$email =$password ='';//empty variables
//username $_POST variable to grab the data
if (isset($_POST ['loginBtn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty ($email)){
        $error = "email can not be empty";
        header( 'location:login.php?email_err='.$error);
        exit();
    }
    if (empty ($password)){
        $error = "password can not be empty";
        header( 'location:login.php?password_err='.$error);
        exit();
    }
    $password =md5($password);

//    check user exist in the  system, if true send user to index page
//    to check if user exist we need email and password

    $sql = "SELECT `email`, `password` FROM `users` WHERE email = '$email' AND password ='$password'";
    $result =mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)> 0){
        $messsage ="welcome to my website";
        header('location:index.php?success_$msg='.$messsage);
        exit();
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
                if (isset($_GET['email_err'])) {
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
                <input type="password" name="password" placeholder="Enter password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="loginBtn" class="btn btn-info btn-block" value="login">
            </div>
        </form>
    </div>
    <div class="col col-sm-12 col-md-3 col-lg-3 col-xl-3"></div>
</div>

<?php include "footer.php"?>





