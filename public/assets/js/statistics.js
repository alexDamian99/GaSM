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
            console.log(res);
            let now = new Date();
            let thisMonth = parseInt(now.getMonth()) + 1;
            let thisYear = now.getFullYear();

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
            }

            thisDay = parseInt(now.getDay())+1;
            for (let i = 8; i > 0; i--) {
                let entry = thisDay.toString();
                days[entry] = [0, 0, 0, 0, 0];
                thisDay -= 1;
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

            thisDay = parseInt(now.getDay())+1;
            for (let i = 8; i > 0; i--) {
                let entry = thisDay.toString();
                arrayForDataTableDay.push([entry, days[entry][1], days[entry][2]]);
                thisDay -= 1;
            }

            arrayForDataTableMonth.reverse();
            arrayForDataTableYear.reverse();
            arrayForDataTableDay.reverse();

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