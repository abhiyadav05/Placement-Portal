<?php
    session_start();
    if(!isset($_SESSION['coardinator_login']) && $_SESSION['coardinator_login']!=true){
        header("location: coardinator_login.php");
    }
?>

<?php
    include "../partial/dbconnection.php";
    $recruiter_id=$_GET['rc'];
    $sql1="delete from recruiter where recruiter_id='$recruiter_id';";
    $sql2="delete from apply where recruiter_id='$recruiter_id';";
    $result1=mysqli_query($conn,$sql1);
    $result2=mysqli_query($conn,$sql2);
    if($result1 && $result2){
        header("location: coardinator_dashboard.php");
    }
    else{
        echo "some technical issue";
    }
?>