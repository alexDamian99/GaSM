loadStatisticsData();


function loadStatisticsData() {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            let res = JSON.parse(xhr.responseText);

            let arrayForDataTableMonth = [
                ['2019/05', 165, 938],
                ['2019/06', 135, 1120],
                ['2019/07', 157, 1167],
                ['2019/08', 139, 1110],
                ['2019/09', 136, 691],
                ['2019/06', 135, 1120],
                ['2019/07', 157, 1167],
                ['2019/08', 139, 1110],
                ['2019/09', 136, 691],
                ['2019/06', 135, 1120],
                ['2019/06', 135, 1120],
                ['2019/07', 157, 1167]
            ];
            let arrayForDataTableDay = [
                ['2019/05', 165, 938],
                ['2019/06', 135, 1120],
                ['2019/07', 157, 1167],
                ['2019/08', 139, 1110],
                ['2019/09', 136, 691],
                ['2019/06', 135, 1120],
                ['2019/07', 157, 1167],
                ['2019/08', 139, 1110],
                ['2019/09', 136, 691],
                ['2019/06', 135, 1120],
                ['2019/06', 135, 1120],
                ['2019/07', 157, 1167]
            ];
            let arrayForDataTableYear = [
                ['2019/05', 165, 938],
                ['2019/06', 135, 1120],
                ['2019/07', 157, 1167],
                ['2019/08', 139, 1110],
                ['2019/09', 136, 691],
                ['2019/06', 135, 1120],
                ['2019/07', 157, 1167],
                ['2019/08', 139, 1110],
                ['2019/09', 136, 691],
                ['2019/06', 135, 1120],
                ['2019/06', 135, 1120],
                ['2019/07', 157, 1167]
            ];;

            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(
                drawVisualization.bind(
                    null,
                    arrayForDataTableMonth,
                    "chart_div_month",
                    "Monthly Garbage Collection",
                    "Month"
                )
            );
            google.charts.setOnLoadCallback(
                drawVisualization.bind(
                    null,
                    arrayForDataTableYear,
                    "chart_div_year",
                    "Yearly Garbage Collection",
                    "Year"
                )
            );
            google.charts.setOnLoadCallback(
                drawVisualization.bind(
                    null,
                    arrayForDataTableDay,
                    "chart_div_day",
                    "Daily Garbage Collection",
                    "Day"
                )
            );
        }
    };

    xhr.open('GET', '/gasm/public/statistics_data');
    xhr.send();
}

/** 
 * @param {String} arrayForDataTable An array of arrays. First element is the period value (ex: "2019/05" if the period is "Month")
 */

function drawVisualization(arrayForDataTable, id, _title, period) {
    let options = {
        title: _title,
        vAxis: {
            title: 'Count'
        },
        hAxis: {
            title: period
        },
        seriesType: 'bars',
        series: {
            5: {
                type: 'line'
            }
        }
    };

    let data = google.visualization.arrayToDataTable([
        [period, 'Decongestion', 'Wrong category thrash'],
        ...arrayForDataTable
    ]);

    let chart = new google.visualization.ComboChart(document.getElementById(id));
    chart.draw(data, options);
}