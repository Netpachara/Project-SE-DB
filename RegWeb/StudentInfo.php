<?php
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
?>

<?php 
include 'connect.php';

session_start();
$username = $_SESSION['username_student'];
if(!isset($_SESSION['username_student'])){
    header( "location: http://127.0.0.1/RegWeb/Login.php");
}
#$username = $_GET['username'];
#if($username == ''){
#    header( "location: http://127.0.0.1/RegWeb/Login.php" );
#}
$course_enroll = "SELECT * FROM `enroll`
INNER JOIN course
ON enroll.c_ID = course.course_ID
INNER JOIN student 
ON enroll.s_ID = student.std_ID
INNER JOIN schduling_lec
ON enroll.c_ID = schduling_lec.course_lecID
INNER JOIN slot_time
ON schduling_lec.date = slot_time.comp_slot
INNER JOIN teach
ON enroll.c_ID = teach.course_ID
INNER JOIN teacher
ON teach.t_ID = teacher.t_ID
WHERE student.email = '$username' AND enroll.en_sec = teach.t_sec AND enroll.en_sec = schduling_lec.section";


$student_info = "SELECT * FROM student,department,faculty where email = '$username' AND student.d_ID = department.dept_ID AND department.fac_ID = faculty.fac_ID";
$dataMTh = "SELECT * FROM `enroll`
INNER JOIN course
ON enroll.c_ID = course.course_ID
INNER JOIN student 
ON enroll.s_ID = student.std_ID
INNER JOIN schduling_lec
ON enroll.c_ID = schduling_lec.course_lecID
INNER JOIN slot_time
ON schduling_lec.date = slot_time.comp_slot
INNER JOIN teach
ON enroll.c_ID = teach.course_ID
INNER JOIN teacher
ON teach.t_ID = teacher.t_ID
WHERE student.email = '$username' AND enroll.en_sec = teach.t_sec AND enroll.en_sec = schduling_lec.section AND slot_time.study_day = 'MTh'
ORDER BY slot_time.comp_slot ASC";

$dataTuF = "SELECT * FROM `enroll`
INNER JOIN course
ON enroll.c_ID = course.course_ID
INNER JOIN student 
ON enroll.s_ID = student.std_ID
INNER JOIN schduling_lec
ON enroll.c_ID = schduling_lec.course_lecID
INNER JOIN slot_time
ON schduling_lec.date = slot_time.comp_slot
INNER JOIN teach
ON enroll.c_ID = teach.course_ID
INNER JOIN teacher
ON teach.t_ID = teacher.t_ID
WHERE student.email = '$username' AND enroll.en_sec = teach.t_sec AND enroll.en_sec = schduling_lec.section AND slot_time.study_day = 'TuF'
ORDER BY slot_time.comp_slot ASC";

$data_Th = $dataMTh;
$Th = mysqli_query($connect,$data_Th);
$data_F = $dataTuF;
$F = mysqli_query($connect,$data_F);
$rlt = mysqli_query($connect,$student_info);
$MTh = mysqli_query($connect,$dataMTh);
$TuF = mysqli_query($connect,$dataTuF);
$enroll = mysqli_query($connect,$course_enroll);
?>


<html>
<title>Registration System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
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
            <h3><span class="badge bg-secondary"><img src="picture/user_icon.png" width = "30" height = "30" style = "margin: 5px; ">ข้อมูลนักศึกษา</span><h3>
            <img src=<?="picture/",$username,'.jpg'?> width = "160" height = "180">
             <table style = "text-align: left; margin: 20; font-size:20px;">
             <?php foreach($rlt as $data){ ?>
                <tr>
                    <td><strong>ชื่อ-สกุล: </strong></td>
                    <td><?=$data['std_fname'],' ',$data['std_lname']?></td>
                </tr>
                <tr>
                    <td><strong>รหัสนักศึกษา: </strong></td>
                    <td><?=$data['std_ID']?></td>
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
        <div class="col-md-auto" style =  "text-align: center; margin-left: 15;">
            <ul class="nav nav-tabs" style="font-size:22px; font-weight:bold;">
                <li class="nav-item">
                        <a class="nav-link active" href="http://127.0.0.1/RegWeb/StudentInfo.php">ตารางเรียนนักศึกษา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/StudentExamTable.php">ตารางสอบนักศึกษา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptTeachStudent.php">ตารางสอนภาควิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptExamStudent.php">ตารางสอบภาควิชา</a>
                </li>
            </ul>
            <h1 style = "text-align: left; font-size:25px; margin-top: 15;">วิชาที่ลงทะเบียน</h1>
            <style>
                .mix, .mix td {
                    border: 3px solid #999;
                }
                .mix td {
                    height: 120px;
                    width: 124px;
                }
            </style>
            <table class = "mix" style = "margin-top: 15; text-align: center; margin-bottom: 100;">
                <tr>
                    <td>รหัสวิชา</td>
                    <td>ชื่อวิชา</td>
                    <td>หน่วยกิตlecture</td>
                    <td>หน่วยกิตlab</td>
                    <td>ตอนเรียน</td>
                    <td>วันเรียน</td>
                    <td>เวลาเรียน</td>
                    <td>ผู้สอน</td>
                    <td>จำนวนรับ</td>
                </tr>
                <?php foreach($enroll as $en){ ?>
                    <tr>
                        <td><?=$en['c_ID']?></td>
                        <td><?=$en['coursename']?></td>
                        <td><?=$en['lec_credit']?></td>
                        <td><?=$en['lab_credit']?></td>
                        <td><?=$en['en_sec']?></td>
                        <td><?=$en['study_day']?></td>
                        <td><?=$en['study_start'],'-',$en['study_finish']?></td>
                        <td><?=$en['t_fname'],' ',$en['t_lname']?></td>
                        <td><?=$en['capacity']?></td>
                    </tr>
                <?php } ?>
            </table>
            <table class = "mix" style = "margin-top: 15; text-align: center; margin-bottom: 150;">
                <tr>
                    <td>Day/Period</td>
                    <td>8:00</td>
                    <td>9:00</td>
                    <td>10:00</td>
                    <td>11:00</td>
                    <td>12:00</td>
                    <td>13:00</td>
                    <td>14:00</td>
                    <td>15:00</td>
                    <td>16:00</td>
                    <td>17:00</td>
                    <td>18:00</td>
                </tr>
                <tr>
                    <td>Monday</td>
                    <td colspan = "12">
                        <div class="row row-cols-6" style = "margin-left: 0;">
                            <?php $pixel = 868; $subject_MTh = array(); //เริ่มต้นที่ 7 โมง 868/7 = 124px
                                foreach($MTh as $MTh){
                                array_push($subject_MTh, $MTh); 
                                $pi_sub = 0;
                                $C1 = strval($MTh['study_start']); //แปลงเวลาเริ่มเรียนเป็น str
                                $Part1 = substr($C1, 0, 1); //อักษรเวลาตัวเเรก สมมุติ 8:00 ก็คือ เลข 8
                                $Part2 = substr($C1, 1, 1); //ตัว :
                                $Part3 = substr($C1, 2, 1); //เลข 0
                                $Part4 = substr($C1, 3, 1); //เลข 0
                                if ($Part1 == 1){ //จุดคำนวณ pixel //ถ้าเวลาเริ่มเรียนเป็น 10 โมงขึ้นไป
                                    $pi_sub = (((int)($Part1)) * 1240) + (((int)($Part2)) * 124) + ((((int)($Part4))/3) * 62);
                                }
                                else{ //เวลาเรียน 7-9 โมง ที่ต้องเเยกเพราะว่า 10 โมงขึ้นไปจะมีตัวเลขตัวเลข 1 เข้ามาเพิ่ม
                                    $pi_sub = (((int)($Part1)) * 124) + ((((int)($Part3))/3) * 62);
                                }
                                $Remain = $pi_sub - $pixel; //คำนวณหาช่องว่างที่ต้องมีก่อน ถ้า remain เป็น 0 ก็ไม่มีช่องว่างคั่น
                                $pixel += $Remain;
                                while($Remain != 0){
                                    if($Remain >= 124){
                                        echo "<div class='col' style = 'width: 124px; height: 120px; text-align: center; padding:30;'></div>";
                                        $Remain -= 124;
                                    }
                                    else if ($Remain >= 62){
                                        echo "<div class='col' style = 'width: 62px; height: 120px; text-align: center; padding:30;'></div>";
                                        $Remain -= 62;
                                    }
                                }
                                $C2 = strval($MTh['study_finish']);  //เหมือนกับข้างบน เเต่เป็นเวลาที่เรียนเสร็จ
                                $Part1_stop = substr($C2, 0, 1);
                                $Part2_stop = substr($C2, 1, 1); 
                                $Part3_stop = substr($C2, 2, 1);
                                $Part4_stop = substr($C2, 3, 1);
                                $Study_time = 0;  //เวลาเรียน
                                $stop = 0; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                if ($Part1_stop == 1){
                                    $stop = (((int)($Part1_stop)) * 1240) + (((int)($Part2_stop)) * 124) + ((((int)($Part4_stop))/3) * 62);
                                }
                                else{
                                    $stop = (((int)($Part1_stop)) * 124) + ((((int)($Part3_stop))/3) * 62);
                                }
                                $Study_time = $stop - $pi_sub; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                $pixel += $Study_time;
                                ?>
                                <div class="col" style = "border-left: 1px solid #999; border-right: 1px solid #999; width: <?=$Study_time ?>px; height: 120px; text-align: center; padding:15; background-color: yellow"><?=$MTh['coursename']?><br><?=$MTh['course_ID'],' (',$MTh['section'],')'?><br><?=$MTh['lec_room'],', '?><?=$MTh['study_start'],'-',$MTh['study_finish']?><br></div>
                                <?php } ?>
                            </div>
                    </td>
                </tr>
                <tr>
                    <td>Tuesday</td>
                    <td colspan = "12">
                        <div class="row row-cols-6" style = "margin-left: 0;">
                            <?php $pixel = 868; $subject_TuF = array(); //เริ่มต้นที่ 7 โมง 868/7 = 124px
                                foreach($TuF as $TuF){
                                array_push($subject_TuF, $TuF); 
                                $pi_sub = 0;
                                $C1 = strval($TuF['study_start']); //แปลงเวลาเริ่มเรียนเป็น str
                                $Part1 = substr($C1, 0, 1); //อักษรเวลาตัวเเรก สมมุติ 8:00 ก็คือ เลข 8
                                $Part2 = substr($C1, 1, 1); //ตัว :
                                $Part3 = substr($C1, 2, 1); //เลข 0
                                $Part4 = substr($C1, 3, 1); //เลข 0
                                if ($Part1 == 1){ //จุดคำนวณ pixel //ถ้าเวลาเริ่มเรียนเป็น 10 โมงขึ้นไป
                                    $pi_sub = (((int)($Part1)) * 1240) + (((int)($Part2)) * 124) + ((((int)($Part4))/3) * 62);
                                }
                                else{ //เวลาเรียน 7-9 โมง ที่ต้องเเยกเพราะว่า 10 โมงขึ้นไปจะมีตัวเลขตัวเลข 1 เข้ามาเพิ่ม
                                    $pi_sub = (((int)($Part1)) * 124) + ((((int)($Part3))/3) * 62);
                                }
                                $Remain = $pi_sub - $pixel; //คำนวณหาช่องว่างที่ต้องมีก่อน ถ้า remain เป็น 0 ก็ไม่มีช่องว่างคั่น
                                $pixel += $Remain;
                                while($Remain != 0){
                                    if($Remain >= 124){
                                        echo "<div class='col' style = 'width: 124px; height: 120px; text-align: center; padding:30;'></div>";
                                        $Remain -= 124;
                                    }
                                    else if ($Remain >= 62){
                                        echo "<div class='col' style = 'width: 62px; height: 120px; text-align: center; padding:30;'></div>";
                                        $Remain -= 62;
                                    }
                                }
                                $C2 = strval($TuF['study_finish']);  //เหมือนกับข้างบน เเต่เป็นเวลาที่เรียนเสร็จ
                                $Part1_stop = substr($C2, 0, 1);
                                $Part2_stop = substr($C2, 1, 1); 
                                $Part3_stop = substr($C2, 2, 1);
                                $Part4_stop = substr($C2, 3, 1);
                                $Study_time = 0;  //เวลาเรียน
                                $stop = 0; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                if ($Part1_stop == 1){
                                    $stop = (((int)($Part1_stop)) * 1240) + (((int)($Part2_stop)) * 124) + ((((int)($Part4_stop))/3) * 62);
                                }
                                else{
                                    $stop = (((int)($Part1_stop)) * 124) + ((((int)($Part3_stop))/3) * 62);
                                }
                                $Study_time = $stop - $pi_sub; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                $pixel += $Study_time;
                                ?>
                                <div class="col" style = "border-left: 1px solid #999; border-right: 1px solid #999; width: <?=$Study_time ?>px; height: 120px; text-align: center; padding:15; background-color: #FF99FF"><?=$TuF['coursename']?><br><?=$TuF['course_ID'],' (',$TuF['section'],')'?><br><?=$TuF['lec_room'],', '?><?=$TuF['study_start'],'-',$TuF['study_finish']?><br></div>
                                <?php } ?>
                            </div>
                    </td>
                </tr>
                <tr>
                    <td>Wednesday</td>
                    <td colspan = "12"></td>
                </tr>
                <tr>
                    <td>Thursday</td>
                    <td colspan = "12">
                        <div class="row row-cols-6" style = "margin-left: 0;">
                            <?php $pixel = 868; $subject_Th = array(); //เริ่มต้นที่ 7 โมง 868/7 = 124px
                                foreach($Th as $Th){
                                array_push($subject_Th, $Th); 
                                $pi_sub = 0;
                                $C1 = strval($Th['study_start']); //แปลงเวลาเริ่มเรียนเป็น str
                                $Part1 = substr($C1, 0, 1); //อักษรเวลาตัวเเรก สมมุติ 8:00 ก็คือ เลข 8
                                $Part2 = substr($C1, 1, 1); //ตัว :
                                $Part3 = substr($C1, 2, 1); //เลข 0
                                $Part4 = substr($C1, 3, 1); //เลข 0
                                if ($Part1 == 1){ //จุดคำนวณ pixel //ถ้าเวลาเริ่มเรียนเป็น 10 โมงขึ้นไป
                                    $pi_sub = (((int)($Part1)) * 1240) + (((int)($Part2)) * 124) + ((((int)($Part4))/3) * 62);
                                }
                                else{ //เวลาเรียน 7-9 โมง ที่ต้องเเยกเพราะว่า 10 โมงขึ้นไปจะมีตัวเลขตัวเลข 1 เข้ามาเพิ่ม
                                    $pi_sub = (((int)($Part1)) * 124) + ((((int)($Part3))/3) * 62);
                                }
                                $Remain = $pi_sub - $pixel; //คำนวณหาช่องว่างที่ต้องมีก่อน ถ้า remain เป็น 0 ก็ไม่มีช่องว่างคั่น
                                $pixel += $Remain;
                                while($Remain != 0){
                                    if($Remain >= 124){
                                        echo "<div class='col' style = 'width: 124px; height: 120px; text-align: center; padding:30;'></div>";
                                        $Remain -= 124;
                                    }
                                    else if ($Remain >= 62){
                                        echo "<div class='col' style = 'width: 62px; height: 120px; text-align: center; padding:30;'></div>";
                                        $Remain -= 62;
                                    }
                                }
                                $C2 = strval($Th['study_finish']);  //เหมือนกับข้างบน เเต่เป็นเวลาที่เรียนเสร็จ
                                $Part1_stop = substr($C2, 0, 1);
                                $Part2_stop = substr($C2, 1, 1); 
                                $Part3_stop = substr($C2, 2, 1);
                                $Part4_stop = substr($C2, 3, 1);
                                $Study_time = 0;  //เวลาเรียน
                                $stop = 0; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                if ($Part1_stop == 1){
                                    $stop = (((int)($Part1_stop)) * 1240) + (((int)($Part2_stop)) * 124) + ((((int)($Part4_stop))/3) * 62);
                                }
                                else{
                                    $stop = (((int)($Part1_stop)) * 124) + ((((int)($Part3_stop))/3) * 62);
                                }
                                $Study_time = $stop - $pi_sub; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                $pixel += $Study_time;
                                ?>
                                <div class="col" style = "border-left: 1px solid #999; border-right: 1px solid #999; width: <?=$Study_time ?>px; height: 120px; text-align: center; padding:15; background-color: FF8933"><?=$Th['coursename']?><br><?=$Th['course_ID'],' (',$Th['section'],')'?><br><?=$Th['lec_room'],', '?><?=$Th['study_start'],'-',$Th['study_finish']?><br></div>
                                <?php } ?>
                            </div>
                    </td>
                </tr>
                <tr>
                    <td>Friday</td>
                    <td colspan = "12">
                            <div class="row row-cols-6" style = "margin-left: 0;">
                            <?php $pixel = 868; $subject_F = array(); //เริ่มต้นที่ 7 โมง 868/7 = 124px
                                foreach($F as $F){
                                array_push($subject_Th, $F); 
                                $pi_sub = 0;
                                $C1 = strval($F['study_start']); //แปลงเวลาเริ่มเรียนเป็น str
                                $Part1 = substr($C1, 0, 1); //อักษรเวลาตัวเเรก สมมุติ 8:00 ก็คือ เลข 8
                                $Part2 = substr($C1, 1, 1); //ตัว :
                                $Part3 = substr($C1, 2, 1); //เลข 0
                                $Part4 = substr($C1, 3, 1); //เลข 0
                                if ($Part1 == 1){ //จุดคำนวณ pixel //ถ้าเวลาเริ่มเรียนเป็น 10 โมงขึ้นไป
                                    $pi_sub = (((int)($Part1)) * 1240) + (((int)($Part2)) * 124) + ((((int)($Part4))/3) * 62);
                                }
                                else{ //เวลาเรียน 7-9 โมง ที่ต้องเเยกเพราะว่า 10 โมงขึ้นไปจะมีตัวเลขตัวเลข 1 เข้ามาเพิ่ม
                                    $pi_sub = (((int)($Part1)) * 124) + ((((int)($Part3))/3) * 62);
                                }
                                $Remain = $pi_sub - $pixel; //คำนวณหาช่องว่างที่ต้องมีก่อน ถ้า remain เป็น 0 ก็ไม่มีช่องว่างคั่น
                                $pixel += $Remain;
                                while($Remain != 0){
                                    if($Remain >= 124){
                                        echo "<div class='col' style = 'width: 124px; height: 120px; text-align: center; padding:30;'></div>";
                                        $Remain -= 124;
                                    }
                                    else if ($Remain >= 62){
                                        echo "<div class='col' style = 'width: 62px; height: 120px; text-align: center; padding:30;'></div>";
                                        $Remain -= 62;
                                    }
                                }
                                $C2 = strval($F['study_finish']);  //เหมือนกับข้างบน เเต่เป็นเวลาที่เรียนเสร็จ
                                $Part1_stop = substr($C2, 0, 1);
                                $Part2_stop = substr($C2, 1, 1); 
                                $Part3_stop = substr($C2, 2, 1);
                                $Part4_stop = substr($C2, 3, 1);
                                $Study_time = 0;  //เวลาเรียน
                                $stop = 0; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                if ($Part1_stop == 1){
                                    $stop = (((int)($Part1_stop)) * 1240) + (((int)($Part2_stop)) * 124) + ((((int)($Part4_stop))/3) * 62);
                                }
                                else{
                                    $stop = (((int)($Part1_stop)) * 124) + ((((int)($Part3_stop))/3) * 62);
                                }
                                $Study_time = $stop - $pi_sub; //คำนวน pixel ที่ต้องใช้ในคาบเรียน
                                $pixel += $Study_time;
                                ?>
                                <div class="col" style = "border-left: 1px solid #999; border-right: 1px solid #999; width: <?=$Study_time ?>px; height: 120px; text-align: center; padding:15; background-color: 33A7FF"><?=$F['coursename']?><br><?=$F['course_ID'],' (',$F['section'],')'?><br><?=$F['lec_room'],', '?><?=$F['study_start'],'-',$F['study_finish']?><br></div>
                                <?php } ?>
                            </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
