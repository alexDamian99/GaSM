google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawVisualization);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Material type', 'Quantity'],
        ['Paper', 11],
        ['Glass', 2],
        ['Plastic', 2],
        ['Metal', 2],
        ['Household waste', 7]
    ]);
    var options = {
        title: 'Percentage of categorized quantities'
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
}

function drawVisualization() {
    var options = {
        title: 'Monthly Garbage Collection by category',
        vAxis: { title: 'Ton' },
        hAxis: { title: 'Month' },
        seriesType: 'bars',
        series: { 5: { type: 'line' } }
    };

    var data = google.visualization.arrayToDataTable([
        ['Month', 'Paper', 'Glass', 'Plastic', 'Metal', 'Household waste', 'Average'],
        ['2019/05', 165, 938, 522, 998, 450, 614.6],
        ['2019/06', 135, 1120, 599, 1268, 288, 682],
        ['2019/07', 157, 1167, 587, 807, 397, 623],
        ['2019/08', 139, 1110, 615, 968, 215, 609.4],
        ['2019/09', 136, 691, 629, 1026, 366, 569.6]
    ]);

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}