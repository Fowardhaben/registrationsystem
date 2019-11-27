<?php
include "config.php";
include "header.php";

$name = $price = $description =$image ='';

//    code for uploading image goes here
$target_dir = "images/";
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["uploadbtn"])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $target_file;

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
     && $imageFileType != "gif"){
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    $sql = "INSERT INTO `product`(`id`, `name`, `price`, `image`, `description`) VALUES (NULL,'$name','$price','$description','$image')";

    if (mysqli_query($conn,$sql)){
        echo"adding your file";
    }


    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<div class="container">
    <div class="row">
    <div class="col col-sm-12 col-md-3 col-lg-3 col-xl-3"></div>
    <div class="col col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <?php
                     if (isset($_GET['name_err'])) {
                         $error = $_GET['name_err'];
                         echo '<div class= "alert alert-danger">';
                         echo "<p>$error</p>";
                         echo '</div>';
                     }
                     ?>

                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter name" class="form-control">
            </div>

            <div class="form-group">
                <?php
                if (isset($_GET['price_err']))
                {
                    $error = $_GET['price_err'];
                    echo '<div class= "alert alert-danger">';
                    echo "<p>$error</p>";;
                    echo '</div>';
                }
                ?>
                <label for="price">Price</label>
                <input type="text" name="price" placeholder="Enter price" class="form-control">
            </div>

            <div class="form-group">
                <?php
                if (isset($_GET['description_err']))
                {
                    $error = $_GET['description_err'];
                    echo '<div class= "alert alert-danger">';
                    echo "<p>$error</p>";
                    echo '</div>';
                }
                ?>
                <label  for="description">Description</label>
                <textarea name="description" id="description" cols="60" rows="10" class="form-control"></textarea>
<!--                <input type="text" name="description" placeholder="Enter description" class="form-control">-->
            </div>
            <div class="form-group">
                <?php
                if (isset($_GET['image_err']))
                {
                    $error = $_GET['image_err'];
                    echo '<div class= "alert alert-danger">';
                    echo "<p>$error</p>";
                    echo '</div>';
                }
                ?>

<!--                <input type="file" name="image" value="Upload">-->
                <input type="file" name="fileToUpload" value="Upload">
            </div>
            <div class="form-group">
                <input type="submit" name="uploadbtn" class="btn btn-info btn-block" value="Upload product">
            </div>
        </form>
    </div>
    <div class="col col-sm-12 col-md-3 col-lg-3 col-xl-3"></div>
    </div>
</div>

<?php include "footer.php"?>
