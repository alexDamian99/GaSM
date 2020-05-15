loadStatisticsData();


function loadStatisticsData() {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            let res = JSON.parse(xhr.responseText);

            let arrayForDataTable
            
            ;
            
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart.bind(null, arrayForDataTable));
            google.charts.setOnLoadCallback(drawVisualization.bind(null, arrayForDataTable));
        }
    };

    xhr.open('GET', '/gasm/public/statistics_data');
    xhr.send();
}

function drawChart(arrayForDataTable) {
    let data = google.visualization.arrayToDataTable([
        ['Material type', 'Quantity'],
        ['Paper', 11],
        ['Glass', 2],
        ['Plastic', 2],
        ['Metal', 2],
        ['Household waste', 7]
    ]);
    let options = {
        title: 'Percentage of categorized quantities'
    };
    let chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
}

function drawVisualization(arrayForDataTable) {
    let options = {
        title: 'Monthly Garbage Collection by category',
        vAxis: {
            title: 'Count'
        },
        hAxis: {
            title: 'Month'
        },
        seriesType: 'bars',
        series: {
            2: {
                type: 'line'
            }
        }
    };

    let data = google.visualization.arrayToDataTable([
        ['Month', 'Decongestion', 'Wrong category thrash'],
        ['2019/05', 165, 938],
        ['2019/06', 135, 1120],
        ['2019/07', 157, 1167],
        ['2019/08', 139, 1110],
        ['2019/09', 136, 691]
    ]);

    let chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}