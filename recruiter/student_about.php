<?php
    include "../partial/dbconnection.php";
    $student_id=$_GET['st'];
    $recruiter_id=$_GET['rc'];
    $sql="select * from apply where student_id='$student_id' and recruiter_id='$recruiter_id';";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        while($row=mysqli_fetch_assoc($result)){
            echo $row['student_about'];
        }
    }
?>