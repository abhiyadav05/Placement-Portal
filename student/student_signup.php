<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){

        include "../partial/dbconnection.php";
        $student_name=$_POST['student_name'];
        $father_name=$_POST['father_name'];
        $student_email=$_POST['student_email'];
        $branch=$_POST['branch'];
        $enrollment=$_POST['enrollment_no'];
        $year=$_POST['year'];
        $percentage=$_POST['percentage'];
        $filename=$_FILES['resume']['name'];
        $tempname=$_FILES['resume']['tmp_name'];
        $folder="../resume/".$filename;
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];

        $checkDetail="select * from student where student_email='$student_email' or enrollment_no='$enrollment';";
        $result=mysqli_query($conn,$checkDetail);
        $row=mysqli_num_rows($result);
        if($row>0){
            echo '<div class=" alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Email or Enrollment Already Exist!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
            if($password==$cpassword){
                $hash=password_hash($password,PASSWORD_DEFAULT);
                $insert="
                INSERT INTO `student` (`student_name`, `father_name`, `student_email`, `branch`, `enrollment_no`, `year`, `percentage`,`resume`, `password`, `login_time`) VALUES ( '$student_name', '$father_name', '$student_email', '$branch', '$enrollment', '$year','$percentage','$folder', '$hash', current_timestamp());";
               $result1= mysqli_query($conn,$insert);
               if($result1){
                move_uploaded_file($tempname,$folder);
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Submitted !</strong> You can login now.
            <a href="student_login.php"><p>Login Now</p></a>
            <a href="student_login.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
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
    <title>Student-SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
   <div class="container ">
    <h2 class="text-center"style="margin-top: 37px;">Sign Up Form!</h2>
   <form class="row g-3 my-3" action="" method="post" enctype="multipart/form-data">
    <!-- Name -->
  <div class="col-md-6">
    <label for="validationDefault01" class="form-label">Name</label>
    <input type="text" class="form-control" id="validationDefault01" name="student_name"required>
  </div>
  <!-- father name -->
  <div class="col-md-6">
    <label for="validationDefault02" class="form-label">Father Name</label>
    <input type="text" class="form-control" id="validationDefault02" name="father_name"required>
  </div>
  <!-- student email -->
  <div class="col-md-6">
  <label for="validationDefault02" class="form-label">Email</label>
    <input type="email" class="form-control" id="validationDefault02" name="student_email" required>
  </div>
  <!-- branch -->
  <div class="col-md-6">
    <label for="validationDefault04" class="form-label">Branch</label>
    <select class="form-select" id="validationDefault04" name="branch" required>
      <option selected disabled value="">Choose...</option>
      <option>Computer Science & Engineering </option>
      <option>Civil Engineering</option>
      <option>Mechanincal Engineering</option>
      <option>Electronics Engineering</option>
    </select>
  </div>
  <!-- Enrollemt number -->
  <div class="col-md-6">
  <label for="validationDefault02" class="form-label">Enrollment No.</label>
    <input type="text" class="form-control" id="validationDefault02" name="enrollment_no" required>
  </div>
  <!-- year -->
  <div class="col-md-6">
    <label for="validationDefault04" class="form-label">Year</label>
    <select class="form-select" id="validationDefault04" name="year" required>
      <option selected disabled value="">Choose...</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
    </select>
  </div>
  <!-- percentage -->
  <div class="col-md-6">
    <label for="validationDefault05" class="form-label">Percentage</label>
    <input type="number" class="form-control" id="validationDefault05" name="percentage" required>
  </div>
  <div class="col-md-6">
  <label for="validationTextarea" class="form-label">Upload Resume</label>
    <input type="file" class="form-control" aria-label="file example" name="resume" required>
    <div class="invalid-feedback">upload resume in pdf</div>
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