function myFunction() {
    var x = document.getElementById("mobile-navbar");
    if (x.className === "responsive-navbar") {
        x.className = "";
    } else {
        x.className += "responsive-navbar";
    }
}