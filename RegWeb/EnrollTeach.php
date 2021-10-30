<?php include 'connect.php'; ?>
<?php
session_start();
$username = $_SESSION['username_teacher'];
if(!isset($_SESSION['username_teacher'])){
    header( "location: http://127.0.0.1/RegWeb/Login.php");
}
$teacher_info = "SELECT * FROM teacher,department,faculty where t_email = '$username' AND teacher.dt_ID = department.dept_ID AND department.fac_ID = faculty.fac_ID";
$course = "SELECT * FROM `schduling_lec` 
INNER JOIN course
ON schduling_lec.course_lecID = course.course_ID
INNER JOIN teacher 
ON course.db_ID = teacher.dt_ID
WHERE schduling_lec.section = '001' AND teacher.t_email = 't017' AND schduling_lec.semester = '1' AND schduling_lec.year = '64'";
$rlt = mysqli_query($connect,$teacher_info);
$teach = mysqli_query($connect,$course);
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
        <div class="col-md-auto" style =  "text-align: left;">
            <ul class="nav nav-tabs" style="font-size:22px; font-weight:bold;">
                <li class="nav-item">
                    <a class="nav-link active" href="http://127.0.0.1/RegWeb/EnrollTeach.php">ลงทะเบียนสอน</a>
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
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/TeacherExamTable.php">ตารางคุมสอบ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptTeachTeacher.php">ตารางสอนภาควิชา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptExamTeacher.php">ตารางสอบภาควิชา</a>
                </li>
            </ul>
            <form method = "POST" action = "AddTeacherTeach.php" >
                <h5><label for='type' class = 'col-sm-3 control-label' style = "margin-top: 20;">Select semester & year</label></h5>
                <div class = 'from-group'>
                    <div class="clo-sm-12" style="margin-top: 20;">
                        <select name="semester" class="form-contorl" required>
                            <option value="" selected="selected">- Select semester -</option>
                            <option value= '1'>1</option>
                            <option value= '2'>2</option>
                            <option value= 's'>summer</option>
                        </select>
                        <select name="year" class="form-contorl" required>
                            <option value="" selected="selected">- Select year -</option>
                            <option value= '64'>2564</option>
                            <option value= '65'>2565</option>
                        </select>
                    </div>
                </div>
                <div style="margin-top: 30;">
                    <h5><label for='type' class = 'col-sm-3 control-label'>Select CourseID</label></h5>
                    <div class = 'from-group'>
                        <div class="clo-sm-12" style="margin-top: 30;">
                            <select name="courseID" class="form-contorl">
                                <option value="" selected="selected">- Select ID -</option>
                                <?php foreach($teach as $t){ ?>
                                <h1><?=$t['course_ID']?></h1>
                                <option value='<?=$t['course_ID']?>'><?=$t['course_ID'],' - ',$t['coursename']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <h5 style = "text-align: left; font-size:20px; margin-top: 15;">section</h5>
                <input style="width:300px;" type="text" class="form-control" id="section" name = "section">
                <button style ="background-color:grey; border-color:grey; margin-top: 30;" type="search" class="btn btn-primary" >ลงทะเบียน</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>