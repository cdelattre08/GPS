var newdate;
var newheure;
var newlat;
var newlng;
var newvitesse;
var newvitessemoyen;
var newbateaui;
//variable globale pour l'envoie d'information en php POST

function rad2deg(arg) {  
    return (360 * arg / (2 * Math.PI));
}

function sinh(arg) {
    return (Math.exp(arg) - Math.exp(-arg)) / 2;
}

function sec(arg) {
    return 1 / Math.cos(arg);
}

function getRandomInt(max) { //fonction qui permet de prendre un nombre aleaoi entre 0 est max
    return Math.floor(Math.random() * Math.floor(max));
}

function getRandomIntInclusive(min, max) { //fonction qui permet de prendre un nombre aleaoi entre min est max
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

setInterval(pickLocation, 15000); //permet le load auto de picklocation

function pickLocation() {

    fetch('API/API_randid.php').then((resp) => resp.json()).then(function (data) {
        var x = -Math.PI / 2;
        var y = Math.PI / 2; // [-PI;PI]
        var lat = false;
        var lng = false;

        x = Math.random() * 2 * Math.PI - Math.PI;
        y = Math.random() * 2 - 1;

        lng = rad2deg(x).toFixed(1);
        latrad = Math.PI / 2 - Math.acos(y);

        lat = rad2deg(latrad).toFixed(1);



        var temps = new Date(); 
        var secondes = getRandomInt(80000);
        temps.setTime(secondes * 1000);
        //Permet de generer une heure aleatoire 
        var date = new Date();
        var tempdate = getRandomIntInclusive(3, 15000);
        date.setDate(tempdate + 1);
        //Permet de generer une date aleatoire 
        bateauid = data;
        //recuper id du bateau 
        var vitesse = getRandomIntInclusive(5, 30);
        //permet de pendre une vitesse aleatoire entre 5 est 30
        vitessemoyen = vitesse + 5 / 2; 

        heure = (temps.getHours() - 1) + ":" + temps.getMinutes() + ":" + temps.getSeconds(); //heure

        daate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate(); //date

        newdate = daate;
        newheure = heure;
        newlat = lat;
        newlng = lng;
        newvitesse = vitesse;
        newvitessemoyen = vitessemoyen;
        newbateaui = bateauid;
        //on envoie les info dans les variablre glo

        var objDiv = document.getElementById("div_coord");

        objDiv.innerHTML += "<p><font color=red>" + lat + "</font>&nbsp;<font color=blue>" + lng + "</font>&nbsp;<font color=green>" + heure + "</font>&nbsp;<font color=black>" + vitesse + "</font>&nbsp;<font color=blue>" + vitessemoyen + "</font>&nbsp;<font color=red>" + bateauid + "</font>&nbsp;<font color=green>" + daate + "</font>  </p>";
        objDiv.scrollTop = objDiv.scrollHeight;
        
        var newlocation = {
            dte: newdate,
            hre: newheure,
            lat: newlat,
            lng: newlng,
            vit: newvitesse,
            vitm: newvitessemoyen,
            bid: newbateaui

        };
        

        var tab = new FormData();

        tab.append("json", JSON.stringify(newlocation));

        fetch("API/reponse_API.php", {
            method: "POST",
            body: tab
        })
            .then(function (res) {
                return res.json();
            })
            .then(function (tab) {
                console.log(tab)
            })
    });

}