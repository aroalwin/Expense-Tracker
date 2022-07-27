<?php
session_start();
error_reporting(0);
include('db.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $userid=$_SESSION['detsuid'];
    $fullname=$_POST['fullname'];
  $mobno=$_POST['contactnumber'];
  $salary=$_POST['salary'];

     $query=mysqli_query($con, "update tbluser set FullName ='$fullname', MobileNumber='$mobno',Salary='$salary' where ID='$userid'");
    if ($query) {
    $msg="User profile has been updated.";
	$sta="success";
  }
  else
    {
      $msg="Something Went Wrong. Please try again.";
	  $sta="error";
    }
  }

  include('header.php');
  ?>

		
		
			<div class="main">	
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
				<br>
          <center>  <h5 class="ml2">Profile Update</h5></center>
				<hr><br>
					<div class="panel-body">
					
						<div class="col-md-12">
							 <?php
$userid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"select * from tbluser where ID='$userid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
							<form role="form" method="post" action="">
								<div class="form-group">
									<label>Full Name</label>
									<input class="form-control" type="text" value="<?php  echo $row['FullName'];?>" name="fullname" required="true">
								</div>
								<div class="form-group">
									<label>Email</label>
<input type="email" class="form-control" name="email" value="<?php  echo $row['Email'];?>" required="true" readonly="true">
								</div>
								
								<div class="form-group">
									<label>Mobile Number</label>
									<input class="form-control" type="text" value="<?php  echo $row['MobileNumber'];?>" required="true" name="contactnumber" maxlength="10">
								</div>

								<div class="form-group">
									<label>Month Salary</label>
									<input class="form-control" type="text" value="<?php  echo $row['Salary'];?>" required="true" name="salary" maxlength="10">
								</div>
								<div class="form-group">
									<label>Registration Date</label>
									<input class="form-control" name="regdate" type="text" value="<?php  echo $row['RegDate'];?>" readonly="true">
								</div>
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Update</button>
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
	</script>
<?php }  ?>