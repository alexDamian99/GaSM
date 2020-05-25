loadStatisticsData();


class MapValueFactory{
    static CreateMapValue(){
        return new MapValue();
    } 
}

class MapValue {
    constructor(numberDecongestions = 0, numberWrongCateg = 0) {
        this.numberDecongestions = numberDecongestions;
        this.numberWrongCateg = numberWrongCateg;
    }
}

class MapWithDefault extends Map {
    get(key) {
        if (!this.has(key)) {
            super.set(key, this.defaultSet());
            return super.get(key);
        }
        return super.get(key);
    }

    set(key, value) {
        console.log(`${key} setting value ${value}`);
        if (!this.has(key)) {
            console.log(`${key} not found. setting ${this.defaultSet()}`);
            return super.set(key, this.defaultSet());
        }
        return super.set(key, value);
    }

    constructor(defaultSetFunc, defaultGetFunc, entries) {
        super(entries);
        if (typeof defaultGetFunc != 'undefined') {
            this.defaultGet = defaultGetFunc;
        } else {
            this.defaultGet = super.get;
        }
        if (typeof defaultSetFunc != 'undefined') {
            this.defaultSet = defaultSetFunc;
        } else {
            this.defaultSet = super.set;
        }
    }
}


function Get(yourUrl){
    var Httpreq = new XMLHttpRequest(); // a new request
    Httpreq.open("GET",yourUrl,false);
    Httpreq.send(null);
    return Httpreq.responseText;          
}

async function GetLocationJson(lon, lat) {
    return JSON.parse(Get('https://nominatim.openstreetmap.org/reverse?format=json&lon=' + lon + '&lat=' + lat));
}


function TimePeriodStats(res, arrayForDataTableMonth, arrayForDataTableYear, arrayForDataTableDay) {

    let months = new MapWithDefault(MapValueFactory.CreateMapValue, MapValueFactory.CreateMapValue);
    let days = new MapWithDefault(MapValueFactory.CreateMapValue, MapValueFactory.CreateMapValue);
    let years = new MapWithDefault(MapValueFactory.CreateMapValue, MapValueFactory.CreateMapValue);
    let now = new Date();
    let thisMonth = parseInt(now.getMonth()) + 1;
    let thisYear = now.getFullYear();
    let thisDay = now.getDate();

    for (let i = 12; i > 0; i--) {
        let entry = thisYear.toString() + "/" + thisMonth.toString();
        months.get(entry);
        thisMonth -= 1;
        if (thisMonth == 0) {
            thisMonth = 12;
            thisYear -= 1;
        }
    }

    thisYear = now.getFullYear();
    for (let i = 6; i > 0; i--) {
        let entry = thisYear.toString();
        years.get(entry);
        thisYear -= 1;
    }

    thisDay = parseInt(now.getDate());
    for (let i = 8; i > 0; i--) {
        let entry = thisDay.toString();
        days.get(entry);
        if (thisDay == 0) {
            thisDay = 30;
        }
        thisDay -= 1;
    }

    for (let report of res) {
        let reportDate = new Date(report.date);
        let monthNow = parseInt(reportDate.getMonth()) + 1
        month = reportDate.getFullYear().toString() + "/" + monthNow.toString();
        let thisDay = parseInt(now.getDate());
        day = thisDay.toString();
        let year = reportDate.getFullYear().toString();


        switch (report.type){
            case 1:
            {
                months.get(month).numberDecongestions += 1;
                days.get(day).numberDecongestions += 1;
                years.get(year).numberDecongestions += 1;
                
            }
            case 2:
            {
                months.get(month).numberWrongCateg += 1;
                days.get(day).numberWrongCateg += 1;
                years.get(year).numberWrongCateg += 1;
            }
        }
    }

    now = new Date();
    thisMonth = parseInt(now.getMonth()) + 1;
    thisYear = now.getFullYear();
    for (let i = 12; i > 0; i--) {
        let entry = thisYear.toString() + "/" + thisMonth.toString();

        arrayForDataTableMonth.push([entry, months.get(entry).numberDecongestions, months.get(entry).numberWrongCateg]);

        thisMonth -= 1;
        if (thisMonth == 0) {
            thisMonth = 12;
            thisYear -= 1;
        }
    }

    thisYear = now.getFullYear();
    for (let i = 6; i > 0; i--) {
        let entry = thisYear.toString();
        arrayForDataTableYear.push([entry, years.get(entry).numberDecongestions, years.get(entry).numberWrongCateg]);
        thisYear -= 1;
    }

    thisDay = parseInt(now.getDate());
    for (let i = 8; i > 0; i--) {
        let entry = thisDay.toString();
        arrayForDataTableDay.push([entry, days.get(entry).numberDecongestions, days.get(entry).numberWrongCateg]);

        if (thisDay == 0) {
            thisDay = 30;
        }
        thisDay -= 1;
    }

    arrayForDataTableMonth.reverse();
    arrayForDataTableYear.reverse();
    arrayForDataTableDay.reverse();
}

async function LocationStats(res, arrayForDataTableSuburbs, arrayForDataTableCities){
    let cities = new MapWithDefault(MapValueFactory.CreateMapValue, MapValueFactory.CreateMapValue);
    let suburbs = new MapWithDefault(MapValueFactory.CreateMapValue, MapValueFactory.CreateMapValue);
    
    for (let report of res) {
        let lon, lat, json;
        lon = report.location.split(",")[0];
        lat = report.location.split(",")[1];
        json = await GetLocationJson(lon, lat);
        console.log(json);
        // function(json){
        if (typeof json.address.city === "undefined"){
            json.address.city = "unknown";
        };
        if (typeof json.address.suburb === "undefined"){
            json.address.suburb = "unknown";
        };
        switch (report.type){
            case 1:
            {
                cities.get(json.address.city).numberDecongestions += 1;
                suburbs.get(json.address.suburb).numberDecongestions += 1;
            }
            case 2:
            {
                cities.get(json.address.city).numberWrongCateg += 1;
                suburbs.get(json.address.suburb).numberWrongCateg += 1;
            }
        }
    }
    let citiesSorted = new Map([...cities].sort((a, b) => {
        return sum(a.numberDecongestions, a.numberWrongCateg) - sum(b.numberDecongestions, b.numberWrongCateg);
    }
    ));
    let suburbsSorted = new Map([...suburbs].sort((a, b) => {
        return sum(a.numberDecongestions, a.numberWrongCateg) - sum(b.numberDecongestions, b.numberWrongCateg);
    }
    ));

    let counter = 0;
    for (let entry of citiesSorted){
        arrayForDataTableCities.push([entry[0], entry[1].numberDecongestions, entry[1].numberWrongCateg]);
        counter++;
        if(counter === 7){
            break;
        }
    } 
    counter = 0;
    for (let entry of suburbsSorted){
        arrayForDataTableSuburbs.push([entry[0], entry[1].numberDecongestions, entry[1].numberWrongCateg]);
        counter++;
        if(counter === 7){
            break;
        }
    }
}


async function loadStatisticsData() {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = async function () {
        if (xhr.readyState === 4) {
            let res = JSON.parse(xhr.responseText);
            let arrayForDataTableMonth = [
                // ['2019/05', 165, 938],
            ];
            let arrayForDataTableYear = [
                // ['2019/05', 165, 938],
            ];;
            let arrayForDataTableDay = [
                // ['2019/05', 165, 938]
            ];
            let arrayForDataTableSuburbs = [
                // ['Podu Ros', 165, 938]
            ];
            let arrayForDataTableCities = [
                // ['Iasi', 165, 938]
            ];
            TimePeriodStats(res, arrayForDataTableMonth, arrayForDataTableYear, arrayForDataTableDay);
            await LocationStats(res, arrayForDataTableSuburbs, arrayForDataTableCities);
            console.log(arrayForDataTableSuburbs);
            console.log(arrayForDataTableCities);

            google.charts.load('current', {
                'packages': ['corechart']
            }).then(function () {

                let chart_month;
                let chart_year;
                let chart_day;
                let chart_cities;
                let chart_suburbs;

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
                );

                chart_day = drawVisualization(
                    arrayForDataTableDay,
                    "chart_div_day",
                    "Daily Garbage Collection",
                    "Day"
                );

                chart_day = drawVisualization(
                    arrayForDataTableDay,
                    "chart_div_day",
                    "Daily Garbage Collection",
                    "Day"
                );

                chart_cities = drawVisualization(
                    arrayForDataTableCities,
                    "chart_div_cities",
                    "Top Cities for Garbage reports",
                    "Cities"
                );

                chart_suburbs = drawVisualization(
                    arrayForDataTableSuburbs,
                    "chart_div_suburbs",
                    "Top Suburbs for Garbage reports",
                    "Suburbs"
                );

                download_pdf.addEventListener('click', function () {
                    var doc = new jsPDF();
                    let width = 180;
                    let height = 160;

                    doc.addImage(chart_month.getImageURI(), 0, 20, width, height);
                    doc.addPage();
                    doc.addImage(chart_year.getImageURI(), 0, 20, width, height);
                    doc.addPage();
                    doc.addImage(chart_day.getImageURI(), 0, 20, width, height);
                    doc.addPage();
                    doc.addImage(chart_cities.getImageURI(), 0, 20, width, height);
                    doc.addPage();
                    doc.addImage(chart_suburbs.getImageURI(), 0, 20, width, height);

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
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            let res = JSON.parse(xhr.responseText);

            var csv = 'Type,Latitude,Longitude,Date\n';
            for (report of res) {
                csv += [report.type, report.location.toString(), report.date].join(',');
                csv += "\n";
            }
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

