function showIdInput() {
    var radio = document.getElementById("radioCompany");
    var label = document.getElementById("company-id");
    if (radio.checked == true) {
        label.style.display = "flex";
    } else {
        label.style.display = "none";
    }
}

function checkPassStrength(password) {
    if (password.length == 0) {
        document.getElementById("pass-strength").innerHTML = "";
        return;
    } else {
        var weakRegex = new RegExp("^(?=.*[a-z])(?=.*[0-9])(?=.{6,})");
        var goodRegex1 = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})");
        var goodRegex2 = new RegExp("^(?=.*[a-z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{6,})");
        var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

        var rez = "Very weak";
        if (weakRegex.test(password))
            rez = "Weak";
        if (goodRegex1.test(password) || goodRegex2.test(password))
            rez = "Good";
        if (strongRegex.test(password))
            rez = "Strong";

        var doc = document.getElementById("pass-strength"); // get element where to write response
        doc.innerHTML = rez; // write response
        // add class based on response
        if (rez == "Very weak") doc.className = "very-weak";
        else if (rez == "Weak") doc.className = "weak";
        else if (rez == "Good") doc.className = "good";
        else if (rez == "Strong") doc.className = "strong";

        var info = "Password must be at least 6 characters long.";
        var info2 = "Password must contain at least a lower case letter.";
        var info3 = "Password must contain at least a number.";
        var info4 = "Password should contain at least an upper case letter.";
        var info5 = "Password should contain at least a special character.";

        doc.classList.add("tooltip"); // add class for tooltip
        var span = doc.appendChild(document.createElement('span')); // create tooltip pop-up
        span.className = 'tooltiptext'; // add class 
        var text = document.createTextNode(info + '\n' + info2 + '\n' + info3 + '\n' + info4 + '\n' + info5); // add inner text
        span.appendChild(text); // apend tooltip text
    }
}

function checkUsername(username) {
    var check = document.getElementById("check-username");
    if (username.length == 0) {
        check.className = "check";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == true)
                    check.className = "check fa fa-check green";
                else
                    check.className = "check fa fa-times red";
            }
        };
        xmlhttp.open("GET", "register/checkUsername/" + username, true);
        xmlhttp.send();
    }
}

function checkEmail(email) {
    var check = document.getElementById("check-email");
    if (email.length == 0) {
        check.className = "check";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == true)
                    check.className = "check fa fa-check green";
                else
                    check.className = "check fa fa-times red";
            }
        };
        xmlhttp.open("GET", "register/checkEmail/" + email, true);
        xmlhttp.send();
    }
}