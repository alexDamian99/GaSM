function showEvents() {
    var x = document.getElementById("profile_container__feed__events");
    x.style.display = "block";

    var y = document.getElementById("profile_container__feed__reports");
    y.style.display = "none";

}

function showReports() {
    var x = document.getElementById("profile_container__feed__reports");
    x.style.display = "block";


    var y = document.getElementById("profile_container__feed__events");
    y.style.display = "none";
}