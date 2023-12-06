<?php
    session_start();
    if(!isset($_SESSION['student_login']) && $_SESSION['student_login']!=true){
        header("location: student_login.php");
        exit();
    }
?>

<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
     include "../partial/dbconnection.php";
        $student_id=$_GET['st'];
        $recruiter_id=$_GET['rc'];
        $student_about=$_POST['student_about'];

        $sql="select * from apply where student_id='$student_id' and recruiter_id='$recruiter_id';";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);
        if($num>0){
            echo '<div class=" alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Application Already Apply!</strong>
            <a href="student_dashboard.php?st='.$student_id.'"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
          </div>';
        }
       else{
        $insert="INSERT INTO `apply` (`student_about`, `student_id`, `recruiter_id`, `apply_date`) VALUES ( '$student_about', '$student_id', '$recruiter_id', current_timestamp());";
        $result2=mysqli_query($conn,$insert);
        if($result2){
            echo '<div class=" alert alert-success alert-dismissible fade show" role="alert">
            <strong>Application Submitted!</strong>
            <a href="student_dashboard.php?st='.$student_id.'"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
          </div>';
        }
        else{
            echo '<div class=" alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Some Technical Error!</strong>
            <a href="student_dashboard.php?st='.$student_id.'"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
          </div>';
        }
       }

}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apply-Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        #validationTextarea{
            height:220px;
        }
        .container form{
            margin-top: 39px;
            
        }
    </style>
  </head>
  <body>
    <div class="container">
    <form class="was-validated" action="" method="POST" enctype="multipart/form-data">
        <h2 class="text-center mb-4">Apply Form!</h2>
  <div class="mb-3">
    <label for="validationTextarea" class="form-label">Tell Me About Youself</label>
    <textarea class="form-control" id="validationTextarea" placeholder="Required example textarea" name="student_about" required></textarea>
    <div class="invalid-feedback">
      Please enter something.
    </div>
  </div>

  <div class="mb-3">
    <button class="btn btn-outline-success" type="submit">Submit form</button>
  </div>

</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>