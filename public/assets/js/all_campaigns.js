function createCampaign(campaign, path) {
    let wrapper = document.createElement("div");
    wrapper.classList = "campaigns__headers__head";
    let image = document.createElement('img');
    image.setAttribute("src", path + "/assets/images/uploads/" + campaign.image_name);
    image.setAttribute("alt", campaign.title);

    let anchor = document.createElement("a");
    anchor.setAttribute("href", path + "/campaigns/id/" + campaign.id);
    let p = document.createElement("p");
    p.classList = "campaigns__headers__head__title";
    p.innerText = campaign.title;
    anchor.appendChild(p);
    wrapper.appendChild(image);
    wrapper.appendChild(anchor);
    return wrapper;
}

window.addEventListener("load", () => {
    document.getElementById("next").addEventListener("click", (e) => {
        console.log("Clicked");
        e.preventDefault();
        let pageNumber = document.getElementsByClassName('page-active')[0].getAttribute("data-page");
        

        let xmlH = new XMLHttpRequest();
        xmlH.onreadystatechange = () => {
            if(xmlH.readyState == 4 && xmlH.status == 200) {
                campaigns = JSON.parse(xmlH.responseText);
                console.log(campaigns);
                let campaginsContainer = document.getElementById("campaignsContainer");
                campaignsContainer.innerText = "";
                campaigns[0].forEach(element => {
                    campaignsContainer.appendChild(createCampaign(element, campaigns[1]));
                });
            }
        };

        xmlH.open("get", "campaigns/pg/" + ++pageNumber);
        xmlH.send();
    });
});

