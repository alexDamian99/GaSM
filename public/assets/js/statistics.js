loadStatisticsData();


class MapValue {
    constructor(numberDecongestions = 0, numberWrongCateg = 0) {
        this.numberDecongestions = numberDecongestions;
        this.numberWrongCateg = numberWrongCateg;
    }
}

class MapWithDefault extends Map {
    get(key) {
        if (!this.has(key)) {
            return this.defaultGet();
        }
        return super.get(key);
    }

    set(key, value) {
        if (!this.has(key)) {
            return super.set(key, this.defaultSet());
        }
        return super.set(key, value);
    }

    constructor(defaultSetFunc, defaultGetFunc, entries) {
        super(entries);
        if (defaultGetFunc) {
            this.defaultGet = defaultGetFunc;
        } else {
            this.defaultGet = () => [0, 0];
        }
        if (defaultSetFunc) {
            this.defaultSet = defaultSetFunc;
        } else {
            this.defaultSet = () => [0, 0];
        }
    }
}


function loadStatisticsData() {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            let res = JSON.parse(xhr.responseText);
            let months = new MapWithDefault();
            let days = new MapWithDefault();
            let years = new MapWithDefault();
            let now = new Date();
            let thisMonth = parseInt(now.getMonth()) + 1;
            let thisYear = now.getFullYear();
            let thisDay = now.getDate();

            for (let i = 12; i > 0; i--) {
                let entry = thisYear.toString() + "/" + thisMonth.toString();
                months[entry] = [0, 0, 0, 0, 0];
                thisMonth -= 1;
                if (thisMonth == 0) {
                    thisMonth = 12;
                    thisYear -= 1;
                }
            }

            thisYear = now.getFullYear();
            for (let i = 6; i > 0; i--) {
                let entry = thisYear.toString();
                years[entry] = [0, 0, 0, 0, 0];
                thisYear -= 1;
            }

            thisDay = parseInt(now.getDate());
            for (let i = 8; i > 0; i--) {
                let entry = thisDay.toString();
                days[entry] = [0, 0, 0, 0, 0];
                if (thisDay == 0) {
                    thisDay = 30;
                }
                thisDay -= 1;
            }

            for (let report of res) {
                let date = new Date(report.date);
                let monthNow = parseInt(date.getMonth()) + 1
                month = date.getFullYear().toString() + "/" + monthNow.toString();
                if (months[month][report.type] == 0) {
                    months[month][report.type] = 1;
                } else {
                    months[month][report.type] += 1;
                }

                year = date.getFullYear().toString();
                if (years[year][report.type] == 0) {
                    years[year][report.type] = 1;
                } else {
                    years[year][report.type] += 1;
                }

                let thisDay = parseInt(now.getDate());
                day = thisDay.toString();
                if (days[day][report.type] == 0) {
                    days[day][report.type] = 1;
                } else {
                    days[day][report.type] += 1;
                }
            }

            

            let arrayForDataTableMonth = [
                // ['2019/05', 165, 938],
            ];

            let arrayForDataTableYear = [
                // ['2019/05', 165, 938],
            ];;


            let arrayForDataTableDay = [
                // ['2019/05', 165, 938]
            ];


            now = new Date();
            thisMonth = parseInt(now.getMonth()) + 1;
            thisYear = now.getFullYear();
            for (let i = 12; i > 0; i--) {
                let entry = thisYear.toString() + "/" + thisMonth.toString();

                arrayForDataTableMonth.push([entry, months[entry][1], months[entry][2]]);

                thisMonth -= 1;
                if (thisMonth == 0) {
                    thisMonth = 12;
                    thisYear -= 1;
                }
            }

            thisYear = now.getFullYear();
            for (let i = 6; i > 0; i--) {
                let entry = thisYear.toString();
                arrayForDataTableYear.push([entry, years[entry][1], years[entry][2]]);
                thisYear -= 1;
            }

            thisDay = parseInt(now.getDate());
            for (let i = 8; i > 0; i--) {
                let entry = thisDay.toString();
                arrayForDataTableDay.push([entry, days[entry][1], days[entry][2]]);
                if (thisDay == 0) {
                    thisDay = 30;
                }
                thisDay -= 1;
            }

            arrayForDataTableMonth.reverse();
            arrayForDataTableYear.reverse();
            arrayForDataTableDay.reverse();
            google.charts.load('current', {
                'packages': ['corechart']
            }).then(function () {

                let chart_month;
                let chart_year;
                let chart_day;

                let download_pdf = document.getElementById('download_pdf');

                chart_month = drawVisualization(
                    arrayForDataTableMonth,
                    "chart_div_month",
                    "Monthly Garbage Collection",
                    "Month"
                );

                chart_year = drawVisualization(
                    arrayForDataTableYear,
                    "chart_div_year",
                    "Yearly Garbage Collection",
                    "Year"
                )

                chart_day = drawVisualization(
                    arrayForDataTableDay,
                    "chart_div_day",
                    "Daily Garbage Collection",
                    "Day"
                )

                download_pdf.addEventListener('click', function () {
                    var doc = new jsPDF();
                    let width = 180;
                    let height = 160;

                    doc.addImage(chart_month.getImageURI(), 0, 20, width, height);
                    doc.addPage();
                    doc.addImage(chart_year.getImageURI(), 0, 20, width, height);
                    doc.addPage();
                    doc.addImage(chart_day.getImageURI(), 0, 20, width, height);

                    doc.save('statistics.pdf');
                }, false);

            });
        }
    };

    xhr.open('GET', '/statistics_data');
    xhr.send();
}


/** 
 * @param {String[]} arrayForDataTable An array of arrays. First element is the period value (ex: "2019/05" if the period is "Month")
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
    return chart;
}



function download_csv() {
    console.log("A")
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            let res = JSON.parse(xhr.responseText);
            console.log(res);

            var csv = 'Type,Latitude,Longitude,Date\n';
            for (report of res) {
                csv += [report.type, report.location.toString(), report.date].join(',');
                csv += "\n";
            }
            console.log(csv);
            var hiddenElement = document.createElement('a');
            hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
            hiddenElement.target = '_blank';
            hiddenElement.download = 'statistics.csv';
            hiddenElement.click();
        }
    };

    xhr.open('GET', '/statistics_data');
    xhr.send();
}
