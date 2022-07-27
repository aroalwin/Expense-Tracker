<?php
session_start();
error_reporting(0);
include('db.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

  include('header.php');

  ?>

		
				
		<div class="main">
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
				
					<br>
          <center><h2>Monthwise Expense Report</h2></center>
				<hr><br>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
					


							<form role="form" method="post" action="expense-monthwise-reports-detailed.php" name="bwdatesreport">
								<div class="form-group">
									<label>From Month</label>
									<input class="form-control" type="month"  id="fromdate" name="fromdate" required="true">
								</div>
								<div class="form-group">
									<label>To Month (or) Same Month</label>
									<input class="form-control" type="month"  id="todate" name="todate" required="true">
								</div>
								
							
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Submit</button>
								</div>
								
								
								</div>
								
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			
		</div><!-- /.row -->
	</div><!--/.main-->
	</div>
	<?php include('footer.php');}?>

