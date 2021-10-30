<html>
<title>Registration CMU Website</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<head>
<style>
    body{
        background-image: url('login7.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
</head>

<body>
  <form method = "POST" action = "process.php" >
    <style>
      form { 
      margin: 0;
      padding:0;
      text-align: left;
      position: absolute;
      top: 50%;
      left:55%;
      transform: translateX(-50%) translateY(-50%); 
      width:380px;
      }

    </style>
    <div> 
    <font color="	#FFFFFF"></p><h5 style = "text-align: left;">Login to Registration Website<h5></p></font></div>
    <div class="mb-3">
      <font color="#FFFFFF"><label for="username" class="form-label">Username</label></font>
      <input style="width:300px;" type="text" class="form-control" id="username" name = "username" aria-describedby="UsernameFeedback" required>
      <div id="UsernameFeedback" class="invalid-feedback">
        </div>
    <div class="mb-3">
      <font color="#FFFFFF"><label for="password" class="form-label">Password</label></font>
      <input style="width:300px;" type="password" class="form-control" id="password" name = "password" aria-describedby="PasswordFeedback" required>
      <div id="PasswordFeedback" class="invalid-feedback">
        </div>
    </div>
    <div class = "form-group">
        <div>
            <input style ="background-color:grey; border-color:grey;" type="submit" name ="btn_login" class = "btn btn-success" style = "width: 30%" value="Login" >
        </div>
    </div>
  </form>
</body>
</html>