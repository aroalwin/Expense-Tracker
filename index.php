<?php
session_start();
error_reporting(0);
include('db.php');
//login
if(isset($_POST['login']))
  {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbluser where  Email='$email' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['detsuid']=$ret['ID'];
	 
     header('location:dashboard.php');
    }
    else{
		$msgr="addToast('Login Failed','Invalid Email Or Password','error');";
    }
  }

  //register
  if(isset($_POST['submit']))
  {
    $fname=$_POST['name'];
    $mobno=$_POST['phone'];
	$salary=$_POST['salary'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    $ret=mysqli_query($con, "select Email from tbluser where Email='$email' ");
    $result=mysqli_fetch_array($ret);
    if($result>0){
$msgr="addToast('Email Error','This email  associated with another account','warning');";
   
    }
    else{
    $query=mysqli_query($con, "insert into tbluser(FullName, MobileNumber, Email,  Password,Salary) value('$fname', '$mobno', '$email', '$password','$salary' )");
    if ($query) {
		$msgr="addToast('Success,'Account Registered Successfully','success');";
  }
  else
    {
		$msgr="addToast('Error','Something Went Wrong. Please try again','error');";
   
    }
}
}
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>

	<script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/login.css" />
	<link href="js/toast/toast.style.css" rel="stylesheet">
	<script src="js/toast/toast.script.js"></script>
    <title>Expense Tracker Login</title>

  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="post"class="sign-in-form">
<h2 class="title"> EXPENSE TRACKER SYSTEM</h2>
            <h2 >Sign in</h2>
			
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="email"placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password"placeholder="Password" />
            </div>
            <input type="submit"name="login" value="Login" class="btn solid" />
          
          </form>
          <form action="#" method="post" class="sign-up-form" >
          <h2 class="title"> EXPENSE TRACKER SYSTEM</h2>
            <h2 >Sign Up</h2>
	
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="name" placeholder="Full Name" required />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required/>
            </div>
			<div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="phone" placeholder="Phone No"  name="phone" maxlength="10" pattern="[0-9]{10}"required/>
            </div>
			<div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="number" placeholder="RS : Salary"  name="salary"required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input placeholder="Password" name="password" id="password" type="password" required/>
            </div>
		
            <input type="submit" class="btn" name="submit" value="submit" />
          
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3> Are You New User ?</h3>
            <p>
           Kindly Register Here
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/login.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Are You Existing User?</h3>
            <p>
             Welcome Back Dear User Login Here
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/reg.svg" class="image" alt="" />
        </div>
      </div>
    </div>


	<script>
			<?php if($msgr){
    echo $msgr;
  }  ?> 
            function addToast(mess,desc,status){
                $.Toast(mess, desc, status, {
                    has_icon:true,
                    has_close_btn:true,
					stack: true,
                    fullscreen:true,
                    timeout:3000,
                    sticky:false,
                    has_progress:true,
                    rtl:false,
					width: 50,
				

                });
            }
        </script>


<script>
	const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});
</script>
</body>
</html>
