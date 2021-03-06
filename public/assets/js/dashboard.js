window.addEventListener("load", () => {
    document.getElementById("exportType").addEventListener("submit", (e) => {
        e.preventDefault();

        let xmlH = new XMLHttpRequest();
        let data = new FormData(document.getElementById("exportType"));
        xmlH.onreadystatechange = () => {
            if(xmlH.readyState == 4) {
                if( xmlH.status == 200) {
                    alert("Succesfully modified export types!");
                } else {
                    alert("Failed to modify export types!");
                }
            }
        }
        xmlH.open("POST", "statistics");
        xmlH.send(data);
    });
});

function verifyUser(userName) {
    let xmlH = new XMLHttpRequest();
    let data = new FormData();
    data.append('username', userName);
    xmlH.onreadystatechange = () => {
        if(xmlH.readyState == 4) {
            if( xmlH.status == 200) {
                alert("Succesfully verified user!");
            } else {
                alert("Failed to verify user!");
            }
        }
    }
    xmlH.open("POST", "edit_profile/verify");
    xmlH.send(data);
}