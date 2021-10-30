<?php include 'connect.php'; ?>
<?php
session_start();
$username = $_SESSION['username_admin'];
if(!isset($_SESSION['username_admin'])){
    header( "location: http://127.0.0.1/RegWeb/Login.php");
}
$admin_info = "SELECT * FROM admin,department,faculty where ad_email = '$username' AND admin.dept_ID = department.dept_ID AND department.fac_ID = faculty.fac_ID";
$dept_name = "SELECT * FROM department";
$dept = mysqli_query($connect,$dept_name);
$rlt = mysqli_query($connect,$admin_info);
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
                <h3><span class="badge bg-secondary"><img src="picture/user_icon.png" width = "30" height = "30" style = "margin: 5px; ">ข้อมูลเจ้าหน้าที่ภาควิชา</span><h3>
                <img src=<?="picture/",$username,'.jpg'?> width = "140" height = "180">
                <table style = "text-align: left; margin: 20; font-size:20px;">
                <?php foreach($rlt as $data){ ?>
                <tr>
                    <td><strong>ชื่อ-สกุล: </strong></td>
                    <td><?=$data['ad_fname'],' ',$data['ad_lname']?></td>
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
                        <a class="nav-link" href="http://127.0.0.1/RegWeb/AdminInfo.php">จัดการข้อมูลกระบวนวิชาที่เปิดสอน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1/RegWeb/ModifyCourseAdmin.php">เเก้ไขกระบวนวิชา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1/RegWeb/DeleteCourseAdmin.php">ลบข้อมูลวิชา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1/RegWeb/ModifyExamRoom.php">จัดการข้อมูลห้องสอบ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1/RegWeb/DeptTeachAdmin.php">ตารางเรียนภาควิชา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="http://127.0.0.1/RegWeb/DeptExamAdmin.php">ตารางสอบภาควิชา</a>
                    </li>
                </ul>
                <style>
                .mix, .mix td {
                    border: 1px solid #999;
                }
                .mix td {
                    height: 90px;
                    width: 150px;
                }
                </style>
                <table class = "mix" style = "margin-top: 30; text-align: center; margin-bottom: 100;">
                <tr>
                    <td>วัน/เดือน/ปี</td>
                    <td>กระบวนวิชา</td>
                    <td>ตอนเรียน</td>
                    <td>เวลา</td>
                    <td>สถานที่สอบ</td>
                    <td>จำนวน นศ.</td>
                    <td>กรรมการคุมสอบ</td>
                </tr>
                <tr>
                    <?php
                        $d_exam = "SELECT * 
                        FROM schduling_exam
                        INNER JOIN course
                        ON schduling_exam.course_ID = course.course_ID
                        INNER JOIN exam_time
                        ON schduling_exam.ex_date = exam_time.comp_exam
                        INNER JOIN admin
                        ON course.db_ID = admin.dept_ID
                        INNER JOIN schduling_lec
                        ON schduling_exam.comp_examschdule = schduling_lec.comp_schduling
                        WHERE admin.ad_email = '$username'
                        ORDER BY schduling_exam.ex_date";
                        $dept_c = mysqli_query($connect,$d_exam);
                    ?>
                    <?php foreach($dept_c as $dept_c){ ?>
                        <td><?=$dept_c['ex_date']?></td>
                        <td><?=$dept_c['course_ID']?></td>
                        <td><?=$dept_c['section']?></td>
                        <td><?=$dept_c['exam_start'],'-',$dept_c['exam_finish']?></td>
                        <td><?=$dept_c['ex_room']?></td>
                        <td><?=$dept_c['ex_capacity']?></td>
                        <td><?=$dept_c['t_ID1']?><br><?=$dept_c['t_ID2']?></td>
                        <tr></tr>
                    <?php } ?>
                    </td>
                </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>