
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

e.channel('room.' + room)
    .listen('RoomJoinedEvent', (e) => {
        var number_personn = document.getElementById("number_person").innerHTML;
        if (number_personn == "" || number_personn == null) { 
            document.getElementById("number_person").innerHTML = "1"
            number_personn = 1;
        }
        else {
            number_personn = (parseInt(number_personn) + 1);
            document.getElementById("number_person").innerHTML = "" + number_personn;
        }
        setTimeout(() =>{
            $.post("https://lolitadventure.fr/someonejoined", {
                '_token' : token,
                room : room,
                number_personn : number_personn
              });
        }, 500);
    })
    .listen('someoneJoined', (e) => {
        document.getElementById("number_person").innerHTML = "" + e["number_personn"];
    })