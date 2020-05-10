function insertText(text) {
    let reason = document.createElement("p");
    let infoBar = document.getElementById("info");
    reason.appendChild(document.createTextNode(text));
    infoBar.appendChild(reason);
}

window.addEventListener("load", () => {
    document.getElementById("campaign-details").addEventListener("submit", (e) => {
        e.preventDefault();
        let form = document.getElementById("campaign-details");
        let data = new FormData(form);
        let xmlH = new XMLHttpRequest();
        xmlH.onreadystatechange = () => {
            if(xmlH.readyState == 4 && xmlH.status == 200) {
                let responseData = JSON.parse(xmlH.response);
                let infoBar = document.getElementById("info");

                infoBar.innerHTML = "";
                infoBar.classList.remove("info-success");
                infoBar.classList.remove("info-fail");

                if(responseData.status === true) { //daca am introdus evenimentul in baza de date
                    infoBar.classList.add("info-success");
                    insertText("Success");
                }
                else {
                    infoBar.classList.add("info-fail");
                    insertText("Failed to create the campaign");
                    let found = responseData.errors.find(el => el.includes("Duplicate"));
                    if(found !== undefined) {
                        insertText("The title of the campaign is already taken");
                    }
                    else {
                        insertText(responseData.errors);
                    }
                }
            }
        };
        
        xmlH.open("post", "insert");
        xmlH.send(data);
    });
});