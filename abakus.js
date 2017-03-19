
window.onload = function () {
	
	//Hankida kõikide bead klassi elementide objektid, salvestada nad muutujasse (tekib massiiv)
	var beads = document.getElementsByClassName("bead");
	
	//Kasutada for tsüklit üle kõigi massiivi elementide itereerimiseks
    for (var i = 0; i < beads.length; i++) {
        beads[i].onclick = function () {
            positsiooniMuutmine(this);
        }
    }

    function positsiooniMuutmine(bead1) {
		
		//Iga elemendi puhul lugeda tema stiilist tema float stiilireegli väärtus
		var el = window.getComputedStyle(bead1);
		var position = el.getPropertyValue("float")
		
		//Kontrollida eelnevas punktis saadud väärtust if lauses.
		//Kui väärtus on left, siis määrata elemendi uueks cssFloat väärtuseks right ja vastupidi.
        if (position == "left"){
            bead1.style.cssFloat = "right";
        } else {
            bead1.style.cssFloat = "left";
        }
    }
};