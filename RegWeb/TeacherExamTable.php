<?php include 'connect.php'; ?>
<?php
session_start();
$username = $_SESSION['username_teacher'];
if(!isset($_SESSION['username_teacher'])){
    header( "location: http://127.0.0.1/RegWeb/Login.php");
}
$teacher_info = "SELECT * FROM teacher,department,faculty where t_email = '$username' AND teacher.dt_ID = department.dept_ID AND department.fac_ID = faculty.fac_ID";
$rlt = mysqli_query($connect,$teacher_info);
?>

<html>
<title>Registration System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<head></head>
<div class="container-fluid" style = "background-color: #eee; height:67px;">
    <div class="row">
        <div class="col-sm">
            <img src = "picture/logo.png" width = "64" height = "64" style = "float: left;">
            <div style = "margin:"><h5>ระบบจัดตารางสอนตารางสอบหลักสูตรปริญญาตรี มหาวิทยาลัยเชียงใหม่</h5>
            <h5>Registration System</h5></div>
        </div>
        <div class="col-sm" style = "text-align: right; margin: 13px">
            <a style ="background-color:grey; border-color:grey;" href="http://127.0.0.1/RegWeb/Logout.php" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">ออกจากระบบ/Logout</a>
        </div>
    </div>
</div>
<body>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

tr:nth-child(even) {
  background-color: #EBF5FF;
}
</style>
<div class="container-fluid">
    <div class="row" style = "top: 15%; position: absolute;">
        <div class="col-md-auto" style =  " text-align: center;">
            <h3><span class="badge bg-secondary"><img src="picture/user_icon.png" width = "30" height = "30" style = "margin: 5px; ">ข้อมูลอาจารย์</span><h3>
            <img src=<?="picture/",$username,'.jpg'?> width = "140" height = "180">
             <table style = "text-align: left; margin: 20; font-size:20px;">
                <?php foreach($rlt as $data){ ?>
                    <tr>
                        <td><strong>ชื่อ-สกุล: </strong></td>
                        <td><?=$data['t_fname'],' ',$data['t_lname']?></td>
                    </tr>
                    <tr>
                        <td><strong>คณะ: </strong></td>
                        <td><?=$data['fac_name']?></td>
                    </tr>
                    <tr>
                        <td><strong>สาขา: </strong></td>
                        <td><?=$data['dept_name']?></td>
                    </tr>
                <?php } ?>
             </table>
        </div>
        <div class="col-md-auto" style =  "text-align: center;">
            <ul class="nav nav-tabs" style="font-size:22px; font-weight:bold;">
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/EnrollTeach.php">ลงทะเบียนสอน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/TeacherInfo.php">ตารางเรียนนักศึกษาในการดูเเล</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/ModifyExamTeacher.php">เเก้ไขวันสอบ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/TeacherTeachTable.php">ตารางสอน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="http://127.0.0.1/RegWeb/TeacherExamTable.php">ตารางคุมสอบ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptTeachTeacher.php">ตารางสอนภาควิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptExamTeacher.php">ตารางสอบภาควิชา</a>
                </li>
            </ul>
            <style>
                .mix, .mix td {
                    border: 1px solid #999;
                }
                .mix td {
                    height: 90px;
                    width: 250px;
                }
            </style>
            <table class = "mix" style = "margin-top: 30; text-align: center; margin-bottom: 100">
                <tr>
                    <td>Day/Period</td>
                    <td>8:00-11:00 AM</td>
                    <td>12:00-15:00 PM</td>
                    <td>15:30-18:30 PM</td>
                </tr>
                <?php $exam_day = "SELECT * FROM `exam_time` WHERE exam_start = '8:00'";
                      $exam_day = mysqli_query($connect,$exam_day);
                ?>
                <?php foreach($exam_day as $exam_day){ ?>
                <tr>
                    <td><?=$exam_day['ex_date']?></td>
                    <td colspan = "3">
                        <?php
                            $ex_day = $exam_day['ex_date'];
                            $monitor = "SELECT * FROM schduling_exam
                            INNER JOIN exam_time
                            ON schduling_exam.ex_date = exam_time.comp_exam
                            INNER JOIN teacher
                            ON schduling_exam.t_ID1 = concat(teacher.t_fname,' ',teacher.t_lname) OR schduling_exam.t_ID2 = concat(teacher.t_fname,' ',teacher.t_lname)
                            INNER JOIN schduling_lec
                            ON schduling_exam.comp_examschdule = schduling_lec.comp_schduling
                            WHERE teacher.t_email = '$username' AND exam_time.ex_date = '$ex_day'
                            ORDER BY schduling_exam.ex_date ASC";
                            $t_monitor = mysqli_query($connect,$monitor);
                        ?>
                        <div class="row row-cols-3" style = "margin-left: -1;">
                            <?php 
                            $pixel = 0;
                            foreach($t_monitor as $t_monitor){
                            $ex_start = $t_monitor['exam_start'];
                            if($ex_start == '8:00'){
                                $pixel += 320;
                            }
                            else if($ex_start == '12:00'){
                                if($pixel == 0){
                                    echo "<div class='col' style = 'width: 365px; height: 120px; text-align: center; padding:30;'></div>";
                                    $pixel += 500;
                                }
                            }
                            else{
                                if($pixel == 0){
                                    echo "<div class='col' style = 'width: 500px; height: 120px; text-align: center; padding:30;'></div>";
                                }
                                else if($pixel == 320){
                                    echo "<div class='col' style = 'width: 320px; height: 120px; text-align: center; padding:30;'></div>";
                                }
                            }
                            ?>
                            <div class="col" style = "border: 1px solid #999; width: 345px; height: 120px; text-align: center; padding:15; background-color: #F08080"><?=$t_monitor['course_ID']?><br><?='(',$t_monitor['section'],')'?><br><?=$t_monitor['ex_room']?></div>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>