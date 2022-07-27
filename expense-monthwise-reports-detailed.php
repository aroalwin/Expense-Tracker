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

						<div class="col-md-12">
					
<?php
$fdate=$_POST['fromdate'];
 $tdate=$_POST['todate'];
$rtype=$_POST['requesttype'];
?>
<h5 align="center" style="color:blue">Monthwise Expense Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
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
              <th>Month-Year</th>
              <th>Expense Amount</th>
                </tr>
                                        </tr>
                                        </thead>
 <?php

$userid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"SELECT month(ExpenseDate) as rptmonth,year(ExpenseDate) as rptyear,SUM(ExpenseCost) as totalmonth FROM tblexpense  where (ExpenseDate BETWEEN '$fdate+01' and '$tdate+30') && (UserId='$userid') group by month(ExpenseDate),year(ExpenseDate)");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                  <td><?php  echo $row['rptmonth']."-".$row['rptyear'];?></td>
                  <td>RS : <?php  echo $ttlsl=$row['totalmonth'];?></td>
           
           
                </tr>
                <?php
                $totalsexp+=$ttlsl; 
$cnt=$cnt+1;
}?>

 <tr>
  <th colspan="2" style="text-align:center">Grand Total</th>     
  <td>RS : <?php echo $totalsexp;?></td>
 </tr>     

                                    </table>




						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<div class="charts" >
      <div class="chart">
                    <h2>Expense Item</h2>
                    <canvas id="lineeChart"></canvas>
                </div>
                <div class="chart ">
                    <h2>Expense Items</h2>
               
                    <canvas id="doughnutm"></canvas>
                </div>
            </div>
		</div><!-- /.row -->
	</div><!--/.main-->
</div>
	<?php include('footer.php');?>

<?php } ?>

<?php  


$result = $ret;

$data = array();
foreach ($result as $row) {
	$data[] = $row;

$finaldata=	json_encode($data);
}
?>
<script>
	
	$(document).ready(function () {
            showGraphpiem(<?php echo $finaldata?>);
        });

       function showGraphpiem(fdata)
        {

            
               
                     var month = [];
                    var cost = [];

					
                  
                    for (var i in fdata) {
                        month.push(fdata[i].rptmonth);
                        cost.push(fdata[i].totalmonth);
                    }
					var ctxxx = document.getElementById('lineeChart').getContext('2d');
var myChart = new Chart(ctxxx, {
    type: 'line',
    data: {
        labels: month,
        datasets: [{
            label: 'Money Spend in RS ',
            data: cost,
            backgroundColor: [
                'rgba(85,85,85, 1)'

            ],
            borderColor: 'rgb(41, 155, 99)',

            borderWidth: 1
        }]
    },
    options: {
        responsive: true
    }
});
					
var ctx = document.getElementById('doughnutm').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
    labels: month,

        datasets: [{
            label: 'Money Spend in RS',
            data: cost,
            backgroundColor: [
                'rgba(41, 155, 99, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(120, 46, 139,1)'

            ],
            borderColor: [
                'rgba(41, 155, 99, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(120, 46, 139,1)'

            ],
            borderWidth: 1
        }]
    
    },
    options: {
        responsive: true
    }
});
            //
}

//



</script>