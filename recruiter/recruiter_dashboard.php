<?php
    session_start();
    if(!isset($_SESSION['recruiter_login']) && $_SESSION['recruiter_login']!=true){
        header("location: recruiter_login.php");
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recruiter-Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
     <style>
       .footer {
        height: 40px;
        margin-top: 15px;
        margin-bottom: 10px;
    }
     </style>
  </head>
  <body>
  <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1 mx-4"><?php
        echo $_SESSION['company_name'];
    ?></span>
    <a href="recruiter_logout.php"><button class="btn btn-outline-success mx-4" type="submit">Log Out</button></a>
  </div>
</nav>

<div class="container" style="margin-top: 38px;">
<div class="alert alert-success my-10" role="alert">
  <h4 class="alert-heading">Welcome!
  <?php
        echo $_SESSION['recruiter_name'];
    ?>
  </h4>
  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
  <hr>
  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
</div>
</div>

<!-- Applicants -->

<div class="container" style="margin-top: 37px;">
  <h2 class="text-center" style="margin-bottom: 20px;">Applicants !</h2>
<table id="applicant" class="table table-striped" style="width:100%">
        <thead>
            <tr>
              <th>Sn.</th>
                <th>Name</th>
                <th>Branch</th>
                <th>Year</th>
                <th>Percentage</th>
                <th>About</th>
                <th>Resume</th>
                <th>Response</th>
            </tr>
        </thead>
        <tbody>

        <?php
            // Access the data of application in apply database where student and recruiter id are match
            include "../partial/dbconnection.php";
            $recruiter_id=$_GET['rc'];
            $sql="select * from apply where recruiter_id='$recruiter_id';";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            
              while($row=mysqli_fetch_assoc($result)){
                $student_id=$row['student_id'];
                $student_about=$row['student_about'];
                $resume=$row['resume'];
                $sn=1;
                // now access the detail of student in student database 
                $sql1="select * from student where student_id='$student_id';";
                $result1=mysqli_query($conn,$sql1);
                $num1=mysqli_num_rows($result1);
                if($num1==1){
                  while($row1=mysqli_fetch_assoc($result1)){
                    $student_name=$row1['student_name'];
                    $branch=$row1['branch'];
                    $year=$row1['year'];
                    $percentage=$row1['percentage'];

                    echo '<tr>
                    <td>'.$sn.'</td>
                    <td>'.$student_name.'</td>
                    <td>'.$branch.'</td>
                    <td>'.$year.'</td>
                    <td>'.$percentage.'</td>
                    <td><a href="student_about.php?rc='.$recruiter_id.'&st='.$student_id.'" target="_blank"<button class="btn btn-primary" type="submit">See</button></a>
                </td>
                    <td><a href="'.$resume.'" target="_blank"<button class="btn btn-primary" type="submit">View</button></a>
                </td>
                    <td><a href=""<button class="btn btn-success" type="submit">Accept</button></a>
                    <a href="" <button class="btn btn-danger" type="submit">Reject</button></a>
                    </td>
                </tr>';
                  }
                  $sn=$sn+1;
                }
              }
            
          ?>
        
            </tbody>
            </table>
</div>
    
  <!-- Footer Content -->
  <div class="footer text-center">
        <p>
            Copyright © 2023 Government Polytechnic Bijnor | Design By Abhishek Yadav.
        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
      new DataTable('#applicant');
    </script>
  </body>
</html>