
  $(document).ready(function () {
            showGraphpie();
        });

       function showGraphpie()
        {


            $.post("chart.php",
                function (data)
                {
                    console.log(data);
                     var item = [];
                    var cost = [];
                  
                    for (var i in data) {
                        item.push(data[i].Expenseitem);
                        cost.push(data[i].ExpenseCost);
                    }
var ctx = document.getElementById('doughnut').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
    labels: item,

        datasets: [{
            label: 'Money Spend in RS',
            data: cost,
            backgroundColor: [
                'rgba(41, 155, 99, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(120, 46, 139,1)',
                'rgb(85, 246, 206)',
                '	rgb(85, 166, 246)'

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
});}

//


