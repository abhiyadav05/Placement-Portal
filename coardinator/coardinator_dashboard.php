<?php
    session_start();
    if(!isset($_SESSION['coardinator_login']) && $_SESSION['coardinator_login']!=true){
        header("location: coardinator_login.php");
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coardinator-Dashboard</title>
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
        echo $_SESSION['coardinator_name'];
    ?></span>
    <a href="recruiter_logout.php"><button class="btn btn-outline-success mx-4" type="submit">Log Out</button></a>
  </div>
</nav>

<div class="container" style="margin-top: 38px;">
<div class="alert alert-success my-10" role="alert">
  <h4 class="alert-heading">Welcome!
  
  </h4>
  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
  <hr>
  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
</div>
</div>


<!-- Student Login -->

<div class="container" style="margin-top: 37px;">
  <h2 class="text-center" style="margin-bottom: 20px;">Login Students !</h2>
<table id="applicant" class="table table-striped" style="width:100%">
        <thead>
            <tr>
              <th>Sn.</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>Branch</th>
                <th>Enrollment No.</th>
                <th>Year</th>
                <th>Response</th>
            </tr>
        </thead>
        <tbody>

        <?php
            // Access the data of application in apply database where student and recruiter id are match
            include "../partial/dbconnection.php";
            $sql="select * from student;";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            $sn=1;
              while($row=mysqli_fetch_assoc($result)){
                $student_id=$row['student_id'];
                    $student_name=$row['student_name'];
                    $father_name=$row['father_name'];
                    $branch=$row['branch'];
                    $year=$row['year'];
                    $percentage=$row['percentage'];
                    $enrollment=$row['enrollment_no'];
                    echo '<tr>
                    <td>'.$sn.'</td>
                    <td>'.$student_name.'</td>
                    <td>'.$father_name.'</td>
                    <td>'.$branch.'</td>
                    <td>'.$enrollment.'</td>
                    <td>'.$year.'</td>
                    <td>
                    <a href="student_delete.php?st='.$student_id.'" <button class="btn btn-danger" type="submit">Delete</button></a>
                    </td>
                </tr>';
                $sn=$sn+1;
                  }
        
          ?>
        
            </tbody>
            </table>
</div>
    
<!--Recruiter Login  -->

<div class="container" style="margin-top: 37px;">
  <h2 class="text-center" style="margin-bottom: 20px;">Login Recruiters !</h2>
<table id="recruiter" class="table table-striped" style="width:100%">
        <thead>
            <tr>
              <th>Sn.</th>
                <th>HR. Name</th>
                <th>Company Name</th>
                <th>Recruiter Email</th>
                <th>Job Domain</th>
                <th>Location</th>
                <th>Response</th>
            </tr>
        </thead>
        <tbody>

        <?php
            // Access the data of application in apply database where student and recruiter id are match
            include "../partial/dbconnection.php";
            $sql="select * from recruiter;";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            $sn=1;
              while($row=mysqli_fetch_assoc($result)){
                $recruiter_id=$row['recruiter_id'];
                    $recruiter_name=$row['recruiter_name'];
                    $recruiter_email=$row['recruiter_email'];
                    $company_name=$row['company_name'];
                    $domain=$row['domain'];
                    $location=$row['location'];
                    
                    echo '<tr>
                    <td>'.$sn.'</td>
                    <td>'.$recruiter_name.'</td>
                    <td>'.$company_name.'</td>
                    <td>'.$recruiter_email.'</td>
                    <td>'.$domain.'</td>
                    <td>'.$location.'</td>
                    <td>
                    <a href="recruiter_delete.php?rc='.$recruiter_id.'" <button class="btn btn-danger" type="submit">Delete</button></a>
                    </td>
                </tr>';
                $sn=$sn+1;
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
      new DataTable('#recruiter');
    </script>
  </body>
</html>