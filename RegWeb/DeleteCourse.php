<?php include 'connect.php'; ?>

<?php
    session_start();
    $course_ID =  $_POST['courseID'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];


    $comp_schdule = $course_ID;
    $comp_schdule .= $semester;
    $comp_schdule .= $year;
    
    #echo $comp_schdule;
    $query = "DELETE FROM schduling_lec WHERE comp_schduling = '$comp_schdule'";
    $query_run = mysqli_query($connect,$query);
    #if($query_run){
    #    echo '<script type ="text/javascript"> alert("Data Updated") </script>';
    #}
    #else{
    #  echo '<script type ="text/javascript"> alert("Fuck you") </script>';
    #}
    header("location: http://127.0.0.1/RegWeb/DeleteCourseAdmin.php" );
?>  


