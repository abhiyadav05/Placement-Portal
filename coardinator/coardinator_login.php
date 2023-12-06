<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Coardinator-Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../student/student_login.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="POST">
    <div class="alert_content">
    <?php
 
 if($_SERVER['REQUEST_METHOD']=="POST"){
   include "../partial/dbconnection.php";
   $coardinator_email=$_POST['coardinator_email'];
   $password=$_POST['password'];

   $sql="select * from coardinator_login where coardinator_email='$coardinator_email';";
   $result=mysqli_query($conn,$sql);
   $num=mysqli_num_rows($result);
   if($num==1){
     while($row=mysqli_fetch_assoc($result))
       {
         if($password==$row['password']){
         session_start();
          $_SESSION['coardinator_login']=true;
          $_SESSION['coardinator_name']=$row['coardinator_name'];
           header("location: coardinator_dashboard.php");
         }
         else{
           echo '<div class=" alert alert-danger alert-dismissible fade show" role="alert">
           <strong>Wrong Password!</strong>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
         }
       }
   }
   else{
     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Email Does Not Exist!</strong>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
   }
 }
 
?>

    </div>
      <img class="mb-2" src="../img/coardinator.png" alt="" width="142" height="122">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
     
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="coardinator_email" required autofocus>
      
      <input type="password" id="inputPassword" class="form-control my-3" placeholder="Password" name="password" required>
     
      <button class="btn btn-lg btn-primary btn-block" type="submit"style="width: 100%;">Sign in</button>
      
      <p class="mt-5 mb-3 text-muted" >Copyright © 2023 Government Polytechnic Bijnor | Design By Abhishek Yadav.</p>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
  </body>
</html>
