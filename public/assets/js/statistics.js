loadStatisticsData();


function loadStatisticsData() {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            let res = JSON.parse(xhr.responseText);

            let arrayForDataTableMonth;
            let arrayForDataTableDay;
            let arrayForDataTableYear;

            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(
                drawVisualization.bind(
                    null,
                    arrayForDataTableMonth,
                    "chart_div_month",
                    "Monthly Garbage Collection"
                )
            );
            google.charts.setOnLoadCallback(
                drawVisualization.bind(
                    null,
                    arrayForDataTableYear,
                    "chart_div_year",
                    "Yearly Garbage Collection"
                )
            );
            google.charts.setOnLoadCallback(
                drawVisualization.bind(
                    null,
                    arrayForDataTableDay,
                    "chart_div_day",
                    "Daily Garbage Collection"
                )
            );
        }
    };

    xhr.open('GET', '/gasm/public/statistics_data');
    xhr.send();
}

function drawVisualization(arrayForDataTable, id, _title, period) {
    let options = {
        title: _title,
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

    let chart = new google.visualization.ComboChart(document.getElementById(id));
    chart.draw(data, options);
}