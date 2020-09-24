import { parseJSON } from 'jquery';
import Echo from 'laravel-echo'

let e = new Echo({
    broadcaster:'socket.io',
    host:window.location.hostname
});
let nbr_person_who_finished_tuto = 0; 
e.channel('room.' + room)
  .listen('finishedTutoEvent', (e) => {
	nbr_person_who_finished_tuto++;
	if (nbr_person_who_finished_tuto == number_players) {
		showDice();
		if (player_number == 0) {
			ThrowDice();
		}
	}
  })
  .listen('throwDiceEvent', (e) => {
	animateDice(e["de"]);
  })

var Jeu = {
	nb_player: number_players,
	i: -1,
	carteQuizz: 0,
	nb_carte : 0,
	tour: new Array(),
	carteTour : new Array(),
	espionnee : new Array(),
}

var Cases = {
	0:{
		haut : 0,
		left : 0,
		carte: ""
	},
	1:{
		haut : 0,
		left : 1,
		carte: "Event"
	},
	2:{
		haut : 0,
		left : 2,
		carte: "Quizz"
	},
	3:{
		haut : 0,
		left : 3,
		carte: "Action"
	},
	4:{
		haut : 0,
		left : 4,
		carte: "Event"
	},
	5:{
		haut : 0,
		left : 5,
		carte: "Quizz"
	},
	6:{
		haut : 0,
		left : 6,
		carte: "Event"
	},
	7:{
		haut : 0,
		left : 7,
		carte: "Action"
	},
	8:{
		haut : 0,
		left : 8,
		carte: "Quizz"
	},
	9:{
		haut : 0.35,
		left : 9,
		carte: "Action"
	},
	10:{
		haut : 1,
		left : 9,
		carte: "Event"
	},
	11:{
		haut : 1.2,
		left : 8,
		carte: "Quizz"
	},
	12:{
		haut : 1.2,
		left : 7,
		carte: "Event"
	},
	13:{
		haut : 1.2,
		left : 6,
		carte: "Quizz"
	},
	14:{
		haut : 1.2,
		left : 5,
		carte: "Action"
	},
	15:{
		haut : 1.2,
		left : 4,
		carte: "Event"
	},
	16:{
		haut : 1.2,
		left : 3,
		carte: "Quizz"
	},
	17:{
		haut : 1.2,
		left : 2,
		carte: "Event"
	},
	18:{
		haut : 1.2,
		left : 1,
		carte: "Action"
	},
	19:{
		haut : 1.35,
		left : 0,
		carte: "Quizz"
	},
	20:{
		haut : 2,
		left : 0,
		carte: "Action"
	},
	21:{
		haut : 2.2,
		left : 1,
		carte: "Event"
	},
	22:{
		haut : 2.2,
		left : 2,
		carte: "Quizz"
	},
	23:{
		haut : 2.2,
		left : 3,
		carte: "Event"
	},
	24:{
		haut : 2.2,
		left : 4,
		carte: "Action"
	},
	25:{
		haut : 2.2,
		left : 5,
		carte: "Quizz"
	},
	26:{
		haut : 2.2,
		left : 6,
		carte: "Event"
	},
	27:{
		haut : 2.2,
		left : 7,
		carte: "Action"
	},
	28:{
		haut : 2.2,
		left : 8,
		carte: "Quizz"
	},
	29:{
		haut : 2.4,
		left : 9,
		carte: "Event"
	},
	30:{
		haut : 3,
		left : 9,
		carte: "Quizz"
	},
	31:{
		haut : 3.2,
		left : 8,
		carte: "Action"
	},
	32:{
		haut : 3.2,
		left : 7,
		carte: "Event"
	},
	33:{
		haut : 3.2,
		left : 6,
		carte: "Action"
	},
	34:{
		haut : 3.2,
		left : 5,
		carte: "Event"
	},
	35:{
		haut : 3.2,
		left : 4,
		carte: "Quizz"
	},
	36:{
		haut : 3.2,
		left : 3,
		carte: "Action"
	},
	37:{
		haut : 3.2,
		left : 2,
		carte: "Event"
	},
	38:{
		haut : 3.2,
		left : 1,
		carte: "Quizz"
	},
	39:{
		haut : 3.4,
		left : 0,
		carte: "Action"
	},
	40:{
		haut : 4,
		left : 0,
		carte: "Quizz"
	},
	41:{
		haut : 4.2,
		left : 1,
		carte: "Event"
	},
	42:{
		haut : 4.2,
		left : 2,
		carte: "Action"
	},
	43:{
		haut : 4.2,
		left : 3,
		carte: "Event"
	},
	44:{
		haut : 4.2,
		left : 4,
		carte: "Quizz"
	},
	45:{
		haut : 4.2,
		left : 5,
		carte: "Action"
	},
	46:{
		haut : 4.2,
		left : 6,
		carte: "Event"
	},
	47:{
		haut : 4.2,
		left : 7,
		carte: "Action"
	},
	48:{
		haut : 4.2,
		left : 8,
		carte: "Event"
	},
	49:{
		haut : 4.4,
		left : 9,
		carte: "Quizz"
	},
	50:{
		haut : 5,
		left : 9,
		carte: "Action"
	},
	51:{
		haut : 5.2,
		left : 8,
		carte: "Event"
	},
	52:{
		haut : 5.2,
		left : 7,
		carte: "Quizz"
	},
	53:{
		haut : 5.2,
		left : 6,
		carte: "Event"
	},
	54:{
		haut : 5.2,
		left : 5,
		carte: "Quizz"
	},
	55:{
		haut : 5.2,
		left : 4,
		carte: "Event"
	},
	56:{
		haut : 5.2,
		left : 3,
		carte: "Quizz"
	},//S'arrête là maintenant !!! wo56
	57:{
		haut : 5.2,
		left : 2,
		carte: "Action"
	},
	58:{
		haut : 5.2,
		left : 1,
		carte: "Event"
	},
	59:{
		haut : 5.4,
		left : 0,
		carte: "Quizz"
	},
	60:{
		haut : 6,
		left : 0,
		carte: "Event"
	},
	61:{
		haut : 6.2,
		left : 1,
		carte: "Quizz"
	},
	62:{
		haut : 6.2,
		left : 2,
		carte: "Action"
	},
	63:{
		haut : 6.2,
		left : 3,
		carte: "Event"
	},
	64:{
		haut : 6.2,
		left : 4,
		carte: "Quizz"
	},
	65:{
		haut : 6.2,
		left : 5,
		carte: "Event"
	},
	66:{
		haut : 6.2,
		left : 6,
		carte: "Action"
	},
	67:{
		haut : 6.2,
		left : 7,
		carte: "Quizz"
	},
	68:{
		haut : 6.2,
		left : 8,
		carte: "Action"
	},
	69:{
		haut : 6.2,
		left : 9,
		carte: ""
	},
};
/* chargement des cartes */
var CarteQuizz;
var CarteAction;
var CarteEvent;
var CartesArray = [0,0,0];
var succeded = 0;
window.onload = function() {
	Ajaxrequest('quizz');
};

function Ajaxrequest(request){
 $.ajax({
		type: 'GET', //THIS NEEDS TO BE GET
		url: '/' + request,
		success: function (data) {
				 CartesArray[succeded] = data["carte"];
				 succeded++;
		}
	});
}

$(document).ajaxSuccess(function(){
  switch (succeded) {
    case 1:
      //CarteQuizz est ready
      Ajaxrequest('event');
      break;
    case 2:
      //CarteEvent est ready
      Ajaxrequest('action');
      break;
    case 3:
      CarteQuizz = CartesArray[0];
      CarteEvent = CartesArray[1];
      CarteAction = CartesArray[2];
	  $("#loader").remove();//On enlève la barre de chargement
	  succeded++;
      Init();
    }
});

/*Fin chargement carte */
var pions = [];
//Pour pan le canvas dans la section
var canvasSection = document.getElementById("canvasSection");
//creation du canvas
var canvas = new fabric.Canvas('c', {
	height: canvasSection.clientHeight,
	width: canvasSection.clientWidth
});
var plateau = [];
$("#ActionDiv").hide();
$("#QuizzDiv").hide();
$("#cache").hide()

function CreatePlateau()
{
	var k = 0;
	for(var i = 0; i < 10; i++){
		var rect = new fabric.Rect({
			top : i * canvas.height / 10,
			left: 0,
			height: canvas.height / 10,
			width : canvas.width / 10,
			opacity : 0,
			stroke : 'black',
			selectable : false,
			hoverCursor : "default",
			id: k
		});
		canvas.add(rect);
		k++;
		plateau.push(rect);
	}
	for(var i = 0; i < 9; i++){
		var rect = new fabric.Rect({
			top : 9 * canvas.height / 10,
			left: i * canvas.width / 10 + (canvas.width / 10),
			height: canvas.height / 10,
			width : canvas.width / 10,
			opacity : 0,
			stroke : 'black',
			selectable : false,
			hoverCursor : "default",
			id: k
		});
		canvas.add(rect);
		k++;
		plateau.push(rect);
	}
	for(var i = 0; i < 9; i++){
		var rect = new fabric.Rect({
			top :canvas.height - ((i + 2) * canvas.height / 10),
			left: 9 * canvas.width / 10,
			height: canvas.height / 10,
			width : canvas.width / 10,
			opacity : 0,
			stroke : 'black',
			selectable : false,
			hoverCursor : "default",
			id: k
		});
		canvas.add(rect);
		k++;
		plateau.push(rect);
	}
	for(var i = 0; i < 7; i++){
		var rect = new fabric.Rect({
			top : 0,
			left: canvas.width - (i + 3) * canvas.width / 10 + (canvas.width / 10),
			height: canvas.height / 10,
			width : canvas.width / 10,
			opacity : 0,
			stroke : 'black',
			selectable : false,
			hoverCursor : "default",
			id: k
		});
		canvas.add(rect);
		k++;
		plateau.push(rect);
	}
	for(var i = 0; i < 7; i++){
		var rect = new fabric.Rect({
			top : i * canvas.height / 10 + canvas.height / 10,
			left: 2 * canvas.width / 10,
			height: canvas.height / 10,
			width : canvas.width / 10,
			opacity : 0,
			stroke : 'black',
			selectable : false,
			hoverCursor : "default",
			id: k
		});
		canvas.add(rect);
		k++;
		plateau.push(rect);
	}
	for(var i = 1; i < 6; i++){
		var rect = new fabric.Rect({
			top : 7 * canvas.height / 10,
			left: i * canvas.width / 10 + ( 2 * canvas.width / 10),
			height: canvas.height / 10,
			width : canvas.width / 10,
			opacity : 0,
			stroke : 'black',
			selectable : false,
			hoverCursor : "default",
			id: k
		});
		canvas.add(rect);
		k++;
		plateau.push(rect);
	}
	for(var i = 0; i < 5; i++){
		var rect = new fabric.Rect({
			top :canvas.height - ((i + 4) * canvas.height / 10),
			left: 7 * canvas.width / 10,
			height: canvas.height / 10,
			width : canvas.width / 10,
			opacity : 0,
			stroke : 'black',
			selectable : false,
			hoverCursor : "default",
			id: k
		});
		canvas.add(rect);
		k++;
		plateau.push(rect);
	}
	for(var i = 1; i < 4; i++){
		var rect = new fabric.Rect({
			top : 2 * canvas.height / 10,
			left: canvas.width - (i + 4) * canvas.width / 10 + (canvas.width / 10),
			height: canvas.height / 10,
			width : canvas.width / 10,
			opacity : 0,
			stroke : 'black',
			selectable : false,
			hoverCursor : "default",
			id: k
		});
		canvas.add(rect);
		k++;
		plateau.push(rect);
	}
	for(var i = 0; i < 1; i++){
		var rect = new fabric.Rect({
			top : (i * canvas.height / 10) + (3 * canvas.height / 10),
			left: 4 * canvas.width / 10,
			height: canvas.height / 10,
			width : canvas.width / 10,
			opacity : 0,
			opacity : 0,
			stroke : 'black',
			selectable : false,
			hoverCursor : "default",
			id: k
		});
		canvas.add(rect);
		k++;
		plateau.push(rect);
	}

}

function Init() {
	console.log('init')
	$("#cache").show();
	$("#carte").hide();
	CreatePlateau();
  Tutorial(0);
}

//magie noire pour mettre le fond, please n'y touche pas
//merci de changer le nom du plateau dans migration
fabric.Image.fromURL(plateauURL, function(img)
 {
	// scale image down, and flip it, before adding it onto canvas
	//img.scaleToHeight(canvas.get('height'));
	img.scaleX = canvas.width / img.width;
	img.scaleY = canvas.height / img.height;
	canvas.setBackgroundImage(img);
	canvas.requestRenderAll();
});

function CreatePion(pionNumber) {
	fabric.Image.fromURL('https://lolitadventure.fr/images/sets/pion_plateau/' + pionURL + "/pion" + (pionNumber + 1) + ".png", function(pion) {
		pion.scaleToHeight(80);
		pion.set({
			left : -25,
			selectable : false,
			hoverCursor : "default",
			pionNumber : pionNumber + 1,
			id : 0
		});
		pions.push(pion);
		canvas.add(pion);
	});
	//creation profil le truc sur le coté
	profil = document.createElement("li");

/************************************************************************************************ */
/************************************************************************************************ */
/************************************************************************************************ */
// MODIF ICI

	$(profil).html("<p><span id='span_j_"+(pionNumber + 1)+"' onclick='rename("+(pionNumber + 1)+")'>Joueuse "+ (pionNumber + 1) +"</span><br /><span id='span" + (pionNumber + 1) +"'></span>\
	</p><input type='text' class='input_name' id='input_j_"+(pionNumber + 1)+"' value='Joueuse "+ (pionNumber + 1) +"' style='height:26px;border:1px dotted grey; background-color:pink;border-radius:10px 10px;font-size:16px;'><img src='https://lolitadventure.fr/images/sets/pion_profil/" + pionURL + "/pion" + (pionNumber + 1) + ".png'>");
	$("#ulProfil").append(profil);
// FIN MODIF ICI
/************************************************************************************************ */
/************************************************************************************************ */
/************************************************************************************************ */


	// on display none l'input
	$('.input_name').css('display', 'none');
}

function skipTuto() {
  $("#welcomeDiv").hide();
	pions.sort(function(a, b){return a.pionNumber - b.pionNumber})
	finishedTuto();
}

function Tutorial(i)
{
	if (i == 0)
    $("#welcomeDiv").show();
	if (i == Object.keys(Tuto).length) {
		$("#welcomeDiv").hide();
		pions.sort(function(a, b){return a.pionNumber - b.pionNumber})
		finishedTuto();
	}
	$("#welcomeDiv").html(Tuto[i]);
	if (i == 1)
    	document.getElementById('skipTuto').onclick = function(){skipTuto()};
	$("#clickMe").on("click", function()
	{
		if (i == 1)
		{
			Jeu.nb_player = $("#nb_player").val();
			if (Jeu.nb_player <= 0 || Jeu.nb_player > 15) {
				Tutorial(i);//On va essayer de throw une erreur
			}
			else {
				for (var k = 0; k < Jeu.nb_player; k++)
					CreatePion(k);
				Tutorial(++i);
			}
		} else {
			$("#clickMe").off("click");
			Tutorial(++i);
		}
	});
}

function finishedTuto() {
	$.post("https://lolitadventure.fr/finishedTuto", {
        '_token' : $('meta[name="csrf-token"]').attr("content"),
        room : room,
    });
}

function ThrowDice()
{
	$("#de").on("click", function() {
		$("#de").off("click");
		var deName = Math.floor(Math.random() * (7 - 1) + 1);
		$.post("https://lolitadventure.fr/throwDice", {
			'_token' : $('meta[name="csrf-token"]').attr("content"),
			de : deName,
			room : room,
			player_number : player_number
		});
	});
}

function showDice() {
	Jeu.i++;
	//var spanny = $("#tour").text();
	// récup du nom de la joueuse ( a tester en détail)
	let j_id = $("#input_j_" + ((Jeu.i % Jeu.nb_player) + 1)).val();
	$("#tour").empty();
	$("#tour").text(" " + j_id);

	//	$("#tour").text(spanny.replace(Jeu.i % Jeu.nb_player, (Jeu.i % Jeu.nb_player) + 1));
	if(Jeu.i % Jeu.nb_player == 0)
	$("#tour").text(" " + $("#input_j_1").val());
	//	$("#tour").text(spanny.replace(Jeu.nb_player, "1"));
	$("#cache").show();
	$("#de").show();
}

function animateDice(deName) {
	$("#de").attr("src", "De/de" + deName + '.png');
	$("#de").transition({rotate: '180deg', duration: 500});
	setTimeout(function(){
		$("#de").transition({rotate: '0deg', duration: 500});
		$("#de").fadeOut(1000);
		setTimeout(function(){
			Play(deName);
		}, 1500);
		$("#cache").hide();
	}, 1000);
}