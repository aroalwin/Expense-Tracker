  <?php  
session_start();
error_reporting(0);
include('db.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

//code deletion
if(isset($_GET['delid']))
{
$rowid=intval($_GET['delid']);
$query=mysqli_query($con,"delete from tblexpense where ID='$rowid'");
if($query){
echo "<script>alert('Record successfully deleted');</script>";
echo "<script>window.location.href='manage-expense.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}

}

include('header.php');
?>
		<div class="main">	
		

		
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
          <br>
          <center><h2>Manage Expense</h2></center>
				<hr><br>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12" >
							
							<div class="table-responsive ">
            <table class="table table-bordered table-hover table-striped " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead style="  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;">
                <tr>
                  <th>S.NO</th>
                  <th>Expense Item</th>
                  <th>Expense Cost</th>
                  <th>Expense Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
              $userid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"select * from tblexpense where UserId='$userid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

  $ret1=mysqli_query($con,"SELECT SUM(ExpenseCost)as totaldaily FROM tblexpense where UserId='$userid'");

while ($roww=mysqli_fetch_array($ret1)) {



?>
              <tbody></tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $row['ExpenseItem'];?></td>
                  <td>RS : <?php  echo$row['ExpenseCost'];?></td>
                  <td><?php  echo $row['ExpenseDate'];?></td>
                  <td><a href="manage-expense.php?delid=<?php echo $row['ID'];?>" class="btn btn-danger">Delete</a>
                </tr>
          
               <?php
           
                $total=$roww['totaldaily']; 
$cnt=$cnt+1;

}
}
?>

 <tr>
  <th colspan="2" style="text-align:center">Grand Total</th>     
  <td>RS : <?php echo $total;?></td>
 </tr>  
   
              </tbody>
            </table>
          </div>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
      <div class="col sm-4">
      <div class="charts" >
      <div class="chart">
                    <h2>Expense Item</h2>
                    <canvas id="lineeChart"></canvas>
                </div>
                <div class="chart ">
                    <h2>Expense Items</h2>
               
                    <canvas id="doughnut"></canvas>
                </div>
            </div>
        </div>
        </div>
		</div><!-- /.row -->
	</div><!--/.main-->
</div>
	<?php include('footer.php');?>

<?php }  ?>