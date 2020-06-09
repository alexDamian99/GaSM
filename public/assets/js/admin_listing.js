
function deleteElement(type, id) {
    if(type === "Users"){
        if(!confirm("Are you sure you want to delete this user? By deleting an user you will also delete his campaigns.")) {
            return;
        }
    }
    let xmlH = new XMLHttpRequest();
    xmlH.onreadystatechange = () => {
        if(xmlH.readyState == 4 && xmlH.status == 200) {
            console.log(xmlH.response);
            document.open();
            document.write(xmlH.response);
            document.close();
        }
    }
    xmlH.open("delete", `/admin/${type.toLowerCase()}/${id}`);
    xmlH.send();
}