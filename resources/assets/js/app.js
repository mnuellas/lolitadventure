
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
import Echo from 'laravel-echo'

let e = new Echo({
    broadcaster:'socket.io',
    host:window.location.hostname
})
var player_number = 1;
e.channel('room.' + room)
    .listen('RoomJoinedEvent', (e) => {
        setTimeout(() => {
            if (number_personn == "" || number_personn == null) { 
                document.getElementById("number_person").innerHTML = "1"
                number_personn = 1;
            }
            else {
                number_personn = (parseInt(number_personn) + 1);
                document.getElementById("number_person").innerHTML = "" + number_personn;
            }
            player_number++;
            $.post("https://lolitadventure.fr/someonejoined", {
                '_token' : token,
                room : room,
              });
        }, 500);
    })
    .listen('someoneJoined', (e) => {
        number_personn = e["number_personn"];
        document.getElementById("number_person").innerHTML = "" + e["number_personn"];
    })
    .listen('EverybodyHereEvent', (e) => {
        $.post("https://lolitadventure.fr/okredirectUs", {
            '_token' : token,
            room : room,
            number_personn : number_personn,
            player_number : player_number,
            room_info : e["room_info"]
          }, function(data) {
              window.location.replace("https://lolitadventure.fr/playRoom");
          });
        
    })