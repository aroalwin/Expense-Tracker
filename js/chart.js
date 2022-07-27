$(document).ready(function () {
    showGraphtable();
});

function showGraphtable()
{

    $.post("chart.php",
    function (data)
    {
        
         var itemm = [];
        var costm = [];
      
        for (var i in data) {
            itemm.push(data[i].Expenseitem);
            costm.push(data[i].ExpenseCost);
        }
var ctxx = document.getElementById('lineeChart').getContext('2d');
var myChart = new Chart(ctxx, {
    type: 'line',
    data: {
        labels: itemm,
        datasets: [{
            label: 'Money Spend in RS ',
            data: costm,
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

});}