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
  .listen('playCardEvent', (e) => {
	  switch(e["type"]) {
		case "Event" :
			showCardEvent(e["card"])
			break;
		case "Quizz":
			showCardQuizz(e["card"], parseInt(e["whereGoodAnswerIs"]))
			break;
		case "Action":
			showCardAction(e["card"])
	  }
  })
  .listen('playDefiEvent', (e) => {
	$("#carte").hide();
	$("#ActionDiv").show();//On  affiche l'ecran
	$("#ActionDiv").html(hitSpacebar + "<br />" + remaingSpacebarHits1 + CarteAction[e["card"]].value + remaingSpacebarHits2);
	if (parseInt(e["whoPress"]) == player_number) {
		playDefi(e["card"]);
	}
  })
  .listen('playingDefiEvent', (e) => {
	$("#ActionDiv").html("<p>" + hitSpacebar + "<br />" + remaingSpacebarHits1 + e["value"] + remaingSpacebarHits2);
  })
  .listen('spiedEvent', (e) => {
	  spied(e["span"]);
  })
  .listen('playedEventEvent', (e) => {
	playCardEvent(e["card"]);
  })
  .listen('playedQuizzEvent', (e) => {
	playCardQuizz(parseInt(e['whereGoodAnswerIs']), parseInt(e['answer_id']));
  })
  .listen('playedDefiEvent', (e) => {
	  playedDefi();
  })
  .listen('playedActionEvent', (e) => {
	  playedAction(e["card"]);
  })
  .listen('printRenameEvent', (e) => {
	  print_rename(e["id"], e["value"]);
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
	var profil = document.createElement("li");

/************************************************************************************************ */
/************************************************************************************************ */
/************************************************************************************************ */
// MODIF ICI

	$(profil).html("<p><span id='span_j_"+ (pionNumber + 1)+"' onclick='rename("+(pionNumber + 1)+")'>Joueuse "+ (pionNumber + 1) +"</span><br /><span id='span" + (pionNumber + 1) +"'></span>\
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
	for (var k = 0; k < Jeu.nb_player; k++)
		CreatePion(k);
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
			console.log(Jeu.nb_player);
			//Jeu.nb_player = $("#nb_player").val();
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
	console.log('trowy')
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

function Play(de)
{
	de = parseInt(de);
	if(pions[Jeu.i % Jeu.nb_player].id + de < (plateau.length - 1))
	{
		MovePion(plateau[pions[Jeu.i % Jeu.nb_player].id + de], pions[Jeu.i % Jeu.nb_player]);
		for (var i = 0; i < Jeu.carteTour.length; i++)//On enlève des tours au cartes tours
		{
			Jeu.carteTour[i][0]--;
			if(Jeu.carteTour[i][0] == 0)
			{
				$(Jeu.carteTour[i][1]).remove();
				Jeu.carteTour.splice(i, 1);
				i--;
			} else {
				$(Jeu.carteTour[i][1]).html(remainingTurns + Jeu.carteTour[i][0]);
			}
		}
		setTimeout(PlayCard, 1000 * de, plateau[pions[Jeu.i % Jeu.nb_player].id + de].id - 1);
	}
	else
		{
		MovePion(plateau[plateau.length - 1], pions[Jeu.i % Jeu.nb_player]);
		Win();
	}
}

function nextTurn() {
	showDice();
	console.log(Jeu.i, Jeu.nb_player, player_number)
	if (Jeu.i % Jeu.nb_player == player_number) {
		console.log('throw')
		ThrowDice();
	}
}

function MovePion(to, pion)
{
	if(to != undefined)//Si on va sur une case sur le plateau
	{
		if(pion.id != to.id){//Tant que nous ne sommes pas sur la case voulue
			pion.id += (to.id - pion.id) / Math.abs(to.id - pion.id);//On se déplace d'une case
			pion.animate('top', plateau[pion.id].top, { onChange: canvas.renderAll.bind(canvas) });//donc on prends le top de la case d'à côté
			pion.animate('left', plateau[pion.id].left, { onChange: canvas.renderAll.bind(canvas) });//Et son left
			setTimeout(MovePion, 1000, to, pion);//Puis on verifie que ce n'est pas la case surlaquelle on voulait aller
		} else
			return to.id; //Si c'est bien la case, on renvoie son numéro
	} else {
		if (pion.id <= 55 && pion.id >= 48) {
			MovePion(plateau[plateau.length - 1], pions[Jeu.i % Jeu.nb_player]);
			Win();
		}
		else
			MovePion(plateau[0], pion);//Si on recule trop, on recommence au début
	}
}

function PlayCard(cardId)
{
	$("#cache").show();
	if (Jeu.i % Jeu.nb_player == player_number) {
		switch(Cases[cardId].carte)
		{
			case "Action" :
				PlayAction();
				break;
			case "Event" :
				PlayEvent();
				break;
			case "Quizz" :
				PlayQuizz();
				break;
		}
	}
}

function PlayAction()
{
	var cardNumber = Math.floor(Math.random() * (CarteAction.length - 1));//On prends une carte random dans le tableau
	$.post("https://lolitadventure.fr/playCard", {
		'_token' : $('meta[name="csrf-token"]').attr("content"),
		card : cardNumber,
		room : room,
		type : "Action"
	});
	console.log(CarteAction[cardNumber].type);
	switch(CarteAction[cardNumber].type)//Selon le type de la carte on a différentes réactions
	{
		case "defi":
			$("#carte").on("click", function() {
				$("#carte").off("click");//On désactive le fait que l'on puisse cliquer (Je sais c'est bizarre mais ça permet de pas avoir 3000 fct bindées)
				var rand = 0;
				do {
					rand = Math.floor(Math.random() * (Jeu.nb_player - 1));
				} while ((rand == player_number && number_players > 1) || number_players == 1); //on choisit qql pour appuyer sur action
				$.post("https://lolitadventure.fr/playDefi", {
					'_token' : $('meta[name="csrf-token"]').attr("content"),
					card : cardNumber,
					room : room,
					whoPress : rand
				});
			});
			break;
		case "tour":
		case "minuteur":
			$("#carte").on("click", function() {
				$("#carte").off("click");//On désactive le fait que l'on puisse cliquer (Je sais c'est bizarre mais ça permet de pas avoir 3000 fct bindées)
				$.post("https://lolitadventure.fr/playedAction", {
					'_token' : $('meta[name="csrf-token"]').attr("content"),
					card : cardNumber,
					room : room,
				});
			})
			break;
	}
}

function showCardAction(cardNumber) {
	$("#carte").attr('src', document.getElementById(CarteAction[cardNumber].url).src);//On transforme notre img en cette carte
	$("#carte").attr('alt', CarteAction[cardNumber].texte);//(et le alt aussi pour les malentendants)
	$("#carte").show();//Puis on la montre
	$("#QuizzDiv").hide();//Bug bizarre corrigé
	$(".carte").show();
}

function playDefi(cardNumber) {
	//change #ActionDiv to be pink or smthing
	CarteAction[cardNumber].nombreinitial = CarteAction[cardNumber].value;
	$("#ActionDiv").on("click", function(){
		LessAction(CarteAction[cardNumber]);//A chaque fois qu'on click, on doit faire l'action en moins
	});
	$(document).on("keyup", function(event){ //sinon on peut spacebar
		var key = event.key || event.keyCode;
		if(key === ' ' || key === 'Space' || key === 32 || event.code == "Space")
			LessAction(CarteAction[cardNumber]);//Sachant que l'on off le spacebar dans LessAction
	});
}

function playedAction(cardNumber) {
	$("#carte").hide();
	nextTurn();
	let jeu =  Jeu.i % Jeu.nb_player
	if (jeu == 0)
		jeu = Jeu.nb_player;
	ActionMinuteur(cardNumber, "#span" + jeu);//On lié une ation minuteur au profil (donc la span) de la joueuse
}

function ActionMinuteur(cardNumber, span)
{
	var span2;
	if($(span).html().length == 0)//si on a pas deja cette span
	{
		//on lui rajoute un hover, une merch sympa pour rappeler aux joueuses quels
		//défis elles ont.
		$(span).on("hover", function(){
			var defiImg = document.createElement("img");
			defiImg.id = "defiImg";
			defiImg.style.zIndex = 100;
			defiImg.src = document.getElementById(CarteAction[cardNumber].url).src;
			defiImg.classList.add("carteDefi");
			$("body").append(defiImg);
		}, function(){
			$("#defiImg").remove();
		});

		if(CarteAction[cardNumber].type == "minuteur")
		{
			//on rajoute un compteur qui sera afficher dans la span
			t(CarteAction[cardNumber].value, span);
		} else {
			$(span).html(remainingTurns + CarteAction[cardNumber].value+ "<br />");
			Jeu.carteTour.push([CarteAction[cardNumber].value, span]);
		}

		if (CarteAction[cardNumber].espionnage != 0)
		{//on rajoute la fonction espionnage
			Jeu.espionnee.span = (Jeu.i % Jeu.nb_player) - 1;
			if (Jeu.espionnee.span == -1)
				Jeu.espionnee.span = 0;
			if (Jeu.i % Jeu.nb_player != player_number) {
				$(span).on("click", function(){//Si l'espionnage s'effectue on recule de deux cases
					$.post("https://lolitadventure.fr/spied", {
						'_token' : $('meta[name="csrf-token"]').attr("content"),
						span : Jeu.espionnee.span,
						room : room,
					});
				});
			}
		}
	} else {//sinon on va creer une nouvelle span
		span2 = document.createElement("span");
		span2.id = "span" + (Jeu.i + Jeu.nb_player);//remplacer par nb
		$(span).after(span2);
		ActionMinuteur(cardNumber, span2);
	}
}

function spied(span) {
	MovePion(plateau[pions[span].id - 2], pions[span]);
}

function LessAction(card){
	if(card.value > 1)//Si on dois encore faire l'action
	{
		card.value--;//On enlève et on rafraichit
		$.post("https://lolitadventure.fr/playingDefi", {
			'_token' : $('meta[name="csrf-token"]').attr("content"),
			value : card.value,
			room : room,
		});
	}
	else
	{
		card.value = card.nombreinitial;
		$("#ActionDiv").off("click");//Et on debind tous les espions
		$(document).off("keyup");
		$.post("https://lolitadventure.fr/playedDefi", {
			'_token' : $('meta[name="csrf-token"]').attr("content"),
			room : room,
		});
	}
}

function playedDefi() {
	$("#ActionDiv").hide(); //Sinon c'est terminé et on cache l'écran
	$("#cache").hide();
	setTimeout(nextTurn, 250);
}

function PlayEvent(){//ici on montre juste la carte, attends que le joueur appuie dessus et applique l'effet
	var cardNumber = parseInt(Math.random() * (CarteEvent.length - 1));
	$.post("https://lolitadventure.fr/playCard", {
		'_token' : $('meta[name="csrf-token"]').attr("content"),
		card : cardNumber,
		room : room,
		type : "Event"
	});
	$("#carte").on("click", function() {
		$.post("https://lolitadventure.fr/playedEvent", {
			'_token' : $('meta[name="csrf-token"]').attr("content"),
			card : cardNumber,
			room : room,
		});
		$("#carte").off("click");
	});
}

function playCardEvent(cardNumber) {
	console.log('appel')
	var temps = MovePion(plateau[pions[Jeu.i % Jeu.nb_player].id + CarteEvent[cardNumber].value], pions[Jeu.i % Jeu.nb_player]);
	setTimeout(nextTurn, 1000 * (Math.abs(CarteEvent[cardNumber].value) + 0.5)); //On attends 1s * le nombre de case avancée
	$("#carte").hide();
	$("#cache").hide();
}

function showCardEvent(cardNumber) {
	$("#carte").attr('src', document.getElementById(CarteEvent[cardNumber].url).src);
	$("#carte").attr('alt', CarteEvent[cardNumber].texte);
	$("#carte").show();
}

function PlayQuizz(){
	var cardNumber = parseInt(Math.random() * (CarteQuizz.length - 1));
	var whereGoodAnswerIs = Math.floor(Math.random() * Math.floor(3));
	$.post("https://lolitadventure.fr/playCard", {
		'_token' : $('meta[name="csrf-token"]').attr("content"),
		card : cardNumber,
		whereGoodAnswerIs : whereGoodAnswerIs,
		room : room,
		type : "Quizz"
	});
}

function playCardQuizz(whereGoodAnswerIs, answer_id) {
	$("#QuizzDiv").hide();
	$("#cache").hide();
	if (answer_id == whereGoodAnswerIs)//Si c'est la bonne réponse
	{
		MovePion(plateau[pions[Jeu.i % Jeu.nb_player].id + 2], pions[Jeu.i % Jeu.nb_player]);//On avance de deux cases
	}
	else
	{
		MovePion(plateau[pions[Jeu.i % Jeu.nb_player].id - 2], pions[Jeu.i % Jeu.nb_player]);//Sinon on recule
	}
	setTimeout(nextTurn, 2050);//(On attends deux secondes pour le pion)
}

function showCardQuizz(cardNumber, whereGoodAnswerIs) {
	var premiereReponseFausseMise = false;
	var liclass;
	$("#question").text(CarteQuizz[cardNumber].texte);
	$("#questionCard").alt = CarteQuizz[cardNumber].texte;
	for(var i = 0; i < 3; i++)
	{
		liclass = "#rep" + i;
		if(i == whereGoodAnswerIs)
		{
			$(liclass).text(CarteQuizz[cardNumber].true);
		}
		else if(premiereReponseFausseMise == false)
		{
			$(liclass).text(CarteQuizz[cardNumber].false1);
			premiereReponseFausseMise = true;
		}
		else
			$(liclass).text(CarteQuizz[cardNumber].false2);
		if (Jeu.i % Jeu.nb_player == player_number) {
			$(liclass).on("click" ,function()
			{
				for(var i = 0; i < 3; i++)
				{
					$("#rep" + i).off("click"); //Et on debind
				}
				$.post("https://lolitadventure.fr/playedQuizz", {
					'_token' : $('meta[name="csrf-token"]').attr("content"),
					answer : this.id.slice(-1),
					whereGoodAnswerIs : whereGoodAnswerIs,
					room : room,
				});
			});
		}
	}
	$("#QuizzDiv").show();
}

function Win()
{
	$("#winDiv").show();
}

function t(duree, span){
    s = duree;
    m = 0;
	h = 0;
    if(s < 0){
		if(span.id != undefined){
			$(span).remove();
		}
		else
			$(span).html("");
		return;
	}
	else
	{
		if(s > 59)
		{
			m = Math.floor(s / 60);
			s = s - m*60;
		}
		if(m>59)
		{
			h = Math.floor(m/60);
			m = m - h * 60
		}
		if(s<10)
		{
			s = "0" + s
		}
		if(m < 10)
		{
			m ="0"+ m
		}
		$(span).html(h + " : "+ m + " : "+ s + "<br />");
	}
	duree = duree - 1;
	Jean = setTimeout(t,999, duree, span);
}

function print_rename(id, val) {
	if (val.length > 0 && val.length < 15) {
		$("#span_j_" + id).empty();
		$("#span_j_" + id).text(val);
		$("#input_j_" + id).hide();
		$("#span_j_" + id).show();
	} else {
		$("#input_j_" + id).hide();
		$("#span_j_" + id).show();
	}
}