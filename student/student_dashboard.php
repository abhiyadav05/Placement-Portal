<?php
    session_start();
    if(!isset($_SESSION['student_login']) && $_SESSION['student_login']!=true){
        header("location: student_login.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student-Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        
    .card .card-body h2 {
        font-weight: 600;
    }

    .card .card-body h3 {
        font-weight: 500;
    }

    .card_bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card_bottom a {
        width: 120px;
        height: 41px;
        font-size: 1.3rem;
        font-weight: 600;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .footer {
        height: 40px;
        margin-top: 15px;
        margin-bottom: 10px;
    }

    @media screen and (max-width: 370px){
       
       #student_name{
        margin-left:1px !important;
        margin-right:1px !important;
       }
       #student_logout{
        margin-left:1px !important;
        margin-right:1px !important;
       }
    }
    </style>
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <div class="navbar-brand mb-0 h1 mx-4" id="student_name"><?php
        echo $_SESSION['student_name'];
    ?></div>

            <!--This for use to update the resume of the students  -->
            <?php
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    include "../partial/dbconnection.php";
                    $update_resume=$_FILES['update_resume'];
                    $student_id=$_GET['st'];
                    $filename=$_FILES['update_resume']['name'];
                    $tempname=$_FILES['update_resume']['tmp_name'];
                    $folder="../resume/".$filename;

                    $sql_update="UPDATE student
                    SET resume = '$folder'
                    WHERE student_id='$student_id';";
                    $update=mysqli_query($conn,$sql_update);
                    
                }
            ?>
            <div class="student-button">
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">
                    Edit Resume
                </button>

                <!-- Modal -->
                <div class="modal fade justify-content-center" id="staticBackdrop" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload New Resume</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" enctype="multipart/form-data">

                                    <div class="col">
                                        <label for="validationTextarea" class="form-label">Upload Resume</label>
                                        <input type="file" class="form-control" aria-label="file example"
                                            name="update_resume" required>
                                        <div class="invalid-feedback">upload resume in pdf</div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <a href="student_logout.php"><button class="btn btn-success mx-4" type="submit" id="student_logout">Log
                        Out</button></a>
            </div>
        </div>
    </nav>
    <div class="container" style="margin-top: 38px;margin-bottom: 40px;">
        <div class="alert alert-success my-10" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit
                longer so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
        </div>
    </div>

    <!-- Jobs Card -->
    <div class="container " style="text-transform: capitalize;">
        <h2 class="text-center" style="margin-bottom: 19px;">Latest Job!</h2>
        <div class="row">

            <!-- this is loop for show all the jobs -->
            <?php
           include "../partial/dbconnection.php";
            $sql1="select * from recruiter;";
            $result1=mysqli_query($conn,$sql1);
            $num=mysqli_num_rows($result1);
            if($num>0){
              while($row=mysqli_fetch_assoc($result1)){
                $recruiter_id=$row['recruiter_id'];
                $job_domain=$row['domain'];
                $company_name=$row['company_name'];
                $location=$row['location'];
                $salary=$row['salary'];
                $post_date=$row['post_date'];
                echo ' <div class="col-sm-6 my-2">
              <div class="card">
                  <div class="card-body">
                      <h2>'.$job_domain.'</h2>
                      <h3>'.$company_name.'</h3>
                      <p>Location : '.$location.'</p>
                      <p>Salary : '.$salary.'</p>
                      <span>Post Date : '.$post_date.'</span>
                      <div class="card_bottom my-2">
                          <a href="apply.php?st='.$_GET['st'].'&rc='.$recruiter_id.'" class="btn btn-outline-success ">Apply</a> 
                      </div>

                  </div>
              </div>
              </div>';
              }
            }
           ?>


        </div>
    </div>
    <div class="footer text-center">
        <p>
            Copyright © 2023 Government Polytechnic Bijnor | Design By Abhishek Yadav.
        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>