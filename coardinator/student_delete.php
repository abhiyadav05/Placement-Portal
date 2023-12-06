<?php
    session_start();
    if(!isset($_SESSION['coardinator_login']) && $_SESSION['coardinator_login']!=true){
        header("location: coardinator_login.php");
    }
?>

<?php
    include "../partial/dbconnection.php";
    $student_id=$_GET['st'];
    $sql1="delete from student where student_id='$student_id';";
    $sql2="delete from apply where student_id='$student_id';";
    $result1=mysqli_query($conn,$sql1);
    $result2=mysqli_query($conn,$sql2);
    if($result1 && $result2){
        header("location: coardinator_dashboard.php");
    }
    else{
        echo "some technical issue";
    }
?>