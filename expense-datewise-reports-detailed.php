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
          <center><h2>Datewise Expense Report</h2></center>
				<hr><br>
					<div class="panel-body">

						<div class="col-md-12">
					
<?php
$fdate=$_POST['fromdate'];
 $tdate=$_POST['todate'];
$rtype=$_POST['requesttype'];
?>
<h5 align="center" style="color:blue">Datewise Expense Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
<hr />
                                    <table id="datatable" class="table table-bordered table-hover table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead style="  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;">
                                        <tr>
                                            <tr>
              <th>S.NO</th>
              <th>Date</th>
              <th>Expense Item</th>
              <th>Expense cost</th>
             
                </tr>
                                        </tr>
                                        </thead>
 <?php
$userid=$_SESSION['detsuid'];

$ret=mysqli_query($con,"SELECT ExpenseItem , ExpenseCost ,ExpenseDate FROM `tblexpense`  where (ExpenseDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid') ");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {


  
     
  
?>
            
                <tr>
                  <td><?php echo $cnt;?></td>
    
                  <td><?php  echo $row['ExpenseDate'];?></td>
                  <td><?php   echo $row['ExpenseItem'];?></td>
<td>RS : <?php  echo $row['ExpenseCost'];?></td>

                
                <?php
             
$cnt=$cnt+1;
}
$ret1=mysqli_query($con,"SELECT SUM(ExpenseCost) as totaldaily FROM `tblexpense`  where (ExpenseDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid') group by ExpenseDate ");
$cnt=1;
while ($row1=mysqli_fetch_array($ret1)) {

  
?>
  <?php   $ttlsl=$row1['totaldaily'];
    $totalsexp+=$ttlsl;
  ?>
           
           
           </tr>
 
   
 <?php }?>
 <tr>
  <th colspan="3" style="text-align:center">Grand Total</th>     
  <td>RS :<?php   echo $totalsexp;?></td>
 </tr>     


                                    </table>




						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->

		</div><!-- /.row -->
	</div><!--/.main-->
	
</div>
<?php include('footer.php');?>
<?php }  ?>