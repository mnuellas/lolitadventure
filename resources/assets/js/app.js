
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

e.channel('lolitadventure_database_chan-room')
    .listen('RoomJoinedEvent', (e) => {
        console.log(e);
})

console.log('je m"aime')