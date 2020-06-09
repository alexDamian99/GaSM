function extend(elementId, arrowId) {
    var x = document.getElementById(elementId);
    var y = document.getElementById(arrowId);
    if (x.className == 'active-form') {
        x.className = '';
        x.style.display = 'none';
        y.className = 'arrow down';
    } else {
        x.className += 'active-form';
        x.style.display = 'block';
        y.className = 'arrow up';
    }
}

function newLike(elem) {
    var report_id = elem.getAttribute('data-id');

    if (elem.classList.contains('not-clicked')) {
        action = 'like';
    } else if (elem.classList.contains('clicked')) {
        action = 'unlike';
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // change button color
            if (action == 'like') {
                elem.classList.remove('not-clicked');
                elem.classList.add('clicked');
            } else if (action == 'unlike') {
                elem.classList.remove('clicked');
                elem.classList.add('not-clicked');
            }

            // display the number of likes and dislikes
            var res = this.responseText.split(' ');
            elem.innerHTML = res[0];

            // can't like and dislike same report at the same time
            var elemSibling = elem.nextElementSibling;
            if (elemSibling.classList.contains('clicked'))
                elemSibling.innerHTML = elemSibling.innerHTML - 1;
            elemSibling.classList.remove('clicked');
            elemSibling.classList.add('not-clicked');
        }
    };
    xmlhttp.open('POST', 'report/newAction/' + report_id + '/' + action, true);
    xmlhttp.send();
}

function newDislike(elem) {
    var report_id = elem.getAttribute('data-id');

    if (elem.classList.contains('not-clicked')) {
        action = 'dislike';
    } else if (elem.classList.contains('clicked')) {
        action = 'undislike';
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // change button color
            if (action == 'dislike') {
                elem.classList.remove('not-clicked');
                elem.classList.add('clicked');
            } else if (action == 'undislike') {
                elem.classList.remove('clicked');
                elem.classList.add('not-clicked');
            }

            // display the number of likes and dislikes
            var res = this.responseText.split(' ');
            elem.innerHTML = res[1];

            // can't like and dislike same report at the same time
            var elemSibling = elem.previousElementSibling;
            if (elemSibling.classList.contains('clicked'))
                elemSibling.innerHTML = elemSibling.innerHTML - 1;
            elemSibling.classList.remove('clicked');
            elemSibling.classList.add('not-clicked');
        }
    };
    xmlhttp.open('POST', 'report/newAction/' + report_id + '/' + action, true);
    xmlhttp.send();
}

function deleteElement(report_id) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.open();
            document.write(xmlhttp.response);
            document.close();
        }
    }
    xmlhttp.open('DELETE', 'report/deleteReport/' + report_id, true);
    xmlhttp.send();
}

function addNewRecyclePoint() {
    let type = document.getElementById("type-recycle").value;
    let location = document.getElementById("location-input-recycling").value;

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.open();
            document.write(xmlhttp.response);
            document.close();
        }
    }
    xmlhttp.open('POST', 'report/addNewRecyclePoint/' + type + '/' + location, true);
    xmlhttp.send();
}

function addNewReport() {
    let type = document.getElementById("type-report").value;
    let location = document.getElementById("location-input-report").value;

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.open();
            document.write(xmlhttp.response);
            document.close();
        }
    }
    xmlhttp.open('POST', 'report/addNewReport/' + type + '/' + location, true);
    xmlhttp.send();
}