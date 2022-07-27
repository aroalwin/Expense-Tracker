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
  <?php
$userid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"select * from tbluser where ID='$userid'");

while ($row=mysqli_fetch_array($ret)) {
  $nam=$row['FullName'];
   
?>
            <div class="cards">
                <div class="card">
                    <div class="card-content">
                        <div class="number">RS : <?php echo $row['Salary'];?></div>
                        <div class="card-name">Month Salary</div>
                    </div>
                    <div class="icon-box">
                    <i class="fas fa-money-bill"></i>
                    </div>
                </div>
              
                <?php $ret1=mysqli_query($con,"SELECT SUM(ExpenseCost)as totaispend FROM tblexpense where UserId='$userid'");

while ($roww=mysqli_fetch_array($ret1)) {
        $exp=$row['Salary']-$roww['totaispend'];
        ?>
                <div class="card">
                    <div class="card-content">
                        <div class="number">Rs : <?php echo $roww['totaispend']?></div>
                        <div class="card-name">Amount Spends</div>
                    </div>
                    <div class="icon-box">
                    <i class="fas fa-chart-line-down"></i>
                    </div>
                </div>
   
    
                <div class="card">
                    <div class="card-content">
                        <div class="number">RS : <?php echo $exp?></div>
                        <div class="card-name">Balance Available</div>
                    </div>
                    <div class="icon-box">
                    <i class="fas fa-wallet"></i>
                    </div>
                </div>
                <?php  }?>
                
                <div class="card">
                    <div class="card-content">
                   
                        <div class="number" id="clocktime"></div>     
                        <div class="card-name">Time</div>
                    </div>
                    <div class="icon-box">
                    <i class="fas fa-clock"></i>
                                    </div>
                </div>
                
            </div>
            <div class="charts">
                <div class="chart">
                    <h2>Expense Item</h2>
                    <canvas id="lineeChart"></canvas>
                </div>
                <div class="chart doughnut-chart">
                    <h2>Expense Items</h2>
                    <canvas id="doughnut"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
      

function clock() {
  setInterval(function () {
      
 document.getElementById("clocktime").innerHTML = new Date().toLocaleTimeString();
        
    }, 1000);
}

clock();


    </script>
    <?php
include('footer.php');
}


?>

     <script>
		

   addToast('Login Success','Welcome Back :<?php echo $nam?> ','success');

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

    <?php  } ?>

