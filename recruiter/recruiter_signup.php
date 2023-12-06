<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){

        include "../partial/dbconnection.php";
        $recruiter_name=$_POST['recruiter_name'];
        $recruiter_email=$_POST['recruiter_email'];
        $location=$_POST['location'];
        $salary=$_POST['salary'];
        $job_domain=$_POST['domain'];
        $company_name=$_POST['company_name'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];

        $checkDetail="select * from recruiter where recruiter_email='$recruiter_email';";
        $result=mysqli_query($conn,$checkDetail);
        $row=mysqli_num_rows($result);
        if($row>0){
            echo '<div class=" alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Email Already Exist!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
            if($password==$cpassword){
                $hash=password_hash($password,PASSWORD_DEFAULT);
                $insert="INSERT INTO `recruiter` (`recruiter_name`, `company_name`, `recruiter_email`, `domain`, `location`, `salary`, `password`, `post_date`) VALUES ('$recruiter_name', '$company_name', '$recruiter_email', '$job_domain', '$location', '$salary', '$hash', current_timestamp());
                ";
               $result1= mysqli_query($conn,$insert);
               if($result1){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Submitted !</strong> You can login now.
            <a href="recruiter_login.php"><p>Login Now</p></a>
            <a href="recruiter_login.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
          </div>';
               }
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Password Not Match!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
    <title>Recruiter-SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
   <div class="container ">
    <h2 class="text-center"style="margin-top: 37px;">Sign Up Form!</h2>
   <form class="row g-3 my-3" action="" method="post">
    <!-- Hr Name -->
  <div class="col-md-6">
    <label for="validationDefault01" class="form-label">HR Name</label>
    <input type="text" class="form-control" id="validationDefault01" name="recruiter_name"required>
  </div>
  <!-- Company name -->
  <div class="col-md-6">
    <label for="validationDefault02" class="form-label">Company Name</label>
    <input type="text" class="form-control" id="validationDefault02" name="company_name"required>
  </div>
  <!-- recruiter email -->
  <div class="col-md-6">
  <label for="validationDefault02" class="form-label">Email</label>
    <input type="email" class="form-control" id="validationDefault02" name="recruiter_email" required>
  </div>
  
  <!-- job domain-->
  <div class="col-md-6">
  <label for="validationDefault02" class="form-label">Job Domain</label>
    <input type="text" class="form-control" id="validationDefault02" name="domain" required>
  </div>
  <!-- Location -->
  <div class="col-md-6">
  <label for="validationDefault02" class="form-label">Location</label>
    <input type="text" class="form-control" id="validationDefault02" name="location" required>
  </div>
  <!-- salary -->
  <div class="col-md-6">
    <label for="validationDefault05" class="form-label">Salary</label>
    <input type="number" class="form-control" id="validationDefault05" name="salary" required>
  </div>
  <div class="col-md-6">
    <label for="validationDefault05" class="form-label">Password</label>
    <input type="password" class="form-control" id="validationDefault05" name="password" required>
  </div>
  <div class="col-md-6">
    <label for="validationDefault05" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="validationDefault05" name="cpassword" required>
  </div>

  <div class="col-12">
    <button class="btn btn-primary" type="submit">Submit</button>
  </div>
</form>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>