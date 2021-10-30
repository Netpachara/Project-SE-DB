<?php include 'connect.php'; ?>

<?php
    session_start();
    $username = $_SESSION['username_teacher'];
    $course_ID =  $_POST['courseID'];
    $section = $_POST['section'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];

    $t_ID = "SELECT * FROM teacher
    INNER JOIN login 
    ON login.username = teacher.t_email
    WHERE teacher.t_email = '$username'";
    $teacher = mysqli_query($connect,$t_ID);
    $teacher_ID = mysqli_fetch_assoc($teacher);


    $comp_teach = $teacher_ID['t_ID'];
    $comp_teach .= $course_ID;
    $comp_teach .= $section;
    $comp_teach .= $semester;
    $comp_teach .= $year;


    $result = $connect->prepare("insert into teach(t_ID, course_ID, t_sec, t_sem, t_year, comp_teach) values(?,?,?,?,?,?)");
    $result->bind_param("ssssss",$teacher_ID['t_ID'], $course_ID, $section, $semester, $year,  $comp_teach);
    $result->execute();
    #if($result){
    #   echo '<script type ="text/javascript"> alert("Data Updated") </script>';
    #
    #lse{
    #  echo '<script type ="text/javascript"> alert("Fuck you") </script>';
    #}
    header("location: http://127.0.0.1/RegWeb/EnrollTeach.php" );
?>  


