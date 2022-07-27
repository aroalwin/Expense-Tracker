<?php
session_start();
include('db.php');
error_reporting(0);
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$userid=$_SESSION['detsuid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$query=mysqli_query($con,"select ID from tbluser where ID='$userid' and   Password='$cpassword'");
$row=mysqli_fetch_array($query);
if($row>0){
$ret=mysqli_query($con,"update tbluser set Password='$newpassword' where ID='$userid'");
$msg= "Your password successully changed";
$sta="success" ;
} else {

$msg="Your current password is wrong";
$sta="warning";
}



}

 include('header.php'); 
  ?>

	<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
} 

</script>

		
		
			<div class="main">
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
				<br>
          <center><h2>Change Password</h2></center>
				<hr><br>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							 <?php
$userid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"select * from tbluser where ID='$userid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
							<form role="form" method="post" action="" name="changepassword" onsubmit="return checkpass();">
								<div class="form-group">
									<label>Current Password</label>
									<input type="password" name="currentpassword" class=" form-control" required= "true" value="">
								</div>
								<div class="form-group">
									<label>New Password</label>
									<input type="password" name="newpassword" class="form-control" value="" required="true">
								</div>
								
								<div class="form-group">
									<label>Confirm Password</label>
									<input type="password" name="confirmpassword" class="form-control" value="" required="true">
								</div>
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Change</button>
								</div>
								
								
								</div>
								<?php } ?>
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			
		</div><!-- /.row -->
	</div><!--/.main-->
	</div>	
	<?php include('footer.php');?>

	<script>
		
		addToast('Sucess','<?php echo $msg?> ','<?php echo $sta?>');

function addToast(mess,desc,status){
	$.Toast(mess, desc, status, {
		has_icon:true,
		has_close_btn:true,
		stack: true,
		fullscreen:true,
		timeout:3000,
		sticky:false,
		
		rtl:false,
		width: 50,
	

	});
}
</script>
<?php }  ?>